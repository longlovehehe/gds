<?php
/*错误级别、时区设置*/
    header("Content-type:text/html;charset=utf-8");
    error_reporting(E_ERROR);
    ini_set('display_errors', '1');
    date_default_timezone_set('PRC');
    ini_set('date.timezone', 'Asia/Shanghai');
    
    $host = $_SERVER['HTTP_HOST'];  /*获取请求服务器的地址*/
  
    
    //成功返回0，失败返回-1
//    session_start($_REQUEST['session_id']);
            $pdo = new dbd();
            //获取企业信息，判断并存session
            $data=  json_decode($_REQUEST['session_id'],true);
            session_id($data['session_id']);
	if(isset($data['type'])){
		$res = $pdo->checkLogin_emp($data['username'],$data['md5']);
	}else{
		$res = $pdo->checkLogin($data['username'],$data['md5']);
	}
            
            if($res == -1){
                $callback = $_GET['callback'];
                echo $callback.'('. json_encode($res) .')';
                die;
            }elseif($res == -2){
                $callback = $_GET['callback'];
                echo $callback.'('.  json_encode($res) .')';
                die;
            }else{
//                header("Location: .$_SERVER['HTTP_HOST']."?m=report&a=index");
		if(isset($data['type'])){
			$header="http://".$_SERVER['HTTP_HOST']."/OP/gds/html/www/?m=enterprise&a=charts";
		}else{

			$header="http://".$_SERVER['HTTP_HOST']."/OP/gds/html/www/?m=report&a=index";
		}
		
		$callback = $_GET['callback'];
		echo $callback.'('.json_encode($header).')';
		die;
            }





//数据库类
class dbd {

    public $pdo;
    public static $PDOInstance;
    public $config;
    public $data;
    public $filed = '*';
    public $table;
    public $limit;
    public $order;
    public $where;
    public $left;

    const LOGIN = 7;
    const USER = 1;
    const GROUP = 2;
    const USERGROUP = 3;
    const LOG = 6;
    const WARING = 1;
    const ERROR = 2;
    const INFO = 0;

    public function __construct() {
        if (!self::$PDOInstance) {
                $this->config = json_decode(file_get_contents("../private/config/db.json"), true);
                $config = $this->config;
                $host = $config["data_base"]["db_host"];
                $dbname = $config["data_base"]["db_name"];
                $port = $config["data_base"]["db_port"];
                $username = $config["data_base"]["db_user"];
                $password = $config["data_base"]["db_pwd"];

                if ($config["data_base"]["db_host"] != 'localhost') {
                        $hosturl = "host=$host;";
                }
                try
                {
                        self::$PDOInstance = new PDO("pgsql:"
                                . $hosturl
                                . "port=$port;"
                                . "dbname=$dbname;"
                                , $username
                                , $password
                                , array(
                                        PDO::ATTR_PERSISTENT => true,
                                )
                        );
                } catch (Exception $ex) {
                        $path = $this->makelog("数据库初始化失败，已强制断开链接。<br />抓取到的异常栈如下：<br /><pre>" . print_r($ex, true) . "</pre>", 'db');

                        header("Content-type: text/html; charset=utf-8");
                        if ($config["SYSTEM"]["DEBUG"]) {
                                echo "数据库初始化失败，已强制断开链接。<br />详细信息请访问{$path}文件日志";
                        } else {
                                echo "数据库初始化失败，请联系系统管理员。";
                        }
                        die();
                }
                try {
                        self::$PDOInstance->query("SET client_encoding='UTF-8';");
                        self::$PDOInstance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                        self::$PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 } catch (Exception $exc) {
                    $this->pdo=NULL;
                    $doc = <<<DOC
                    <!DOCTYPE html>
                    <html>
                        <head>
                                <meta charset="UTF-8">
                                <script src="layer/jquery-1.11.1.min.js"></script>
                                <script src="layer/layer.js"></script>
                        <head>
                    <body>
DOC;

                print $doc;
                $info='服务器变更请刷新';
                print("<script>layer.msg('".$info."', {icon: 2,time: 30000},function(){location.reload();});</script>");
                print('</body></html>');
                exit();
                }
            }
        
            $this->pdo = self::$PDOInstance;
        }

    //写入日志方法
    public function log($content, $type = 0, $level = 0, $data = array()) {
        $time = date("Y-m-d H:i:s", time());
        $user = $_SESSION['eown']['em_id'];

        if (!empty($data)) {
            $this->makelog(implode('|', $data), 'error');
        }
        
        $table = 'T_EventLog_' . $_SESSION['eown']['em_ent_id'];
        $sql = 'INSERT INTO "' . $table . '" ("el_type","el_level","el_time","el_content","el_user") VALUES (:type,:level,:time,:content,:user);';

        $sth = $this->pdo->prepare($sql);

        if (strlen($content) > 1000) {
            $content = substr($content, 0, 800) . '（日志内容过长被截取）...';
        }

        $sth->bindValue(':type', $type);
        $sth->bindValue(':level', $level, PDO::PARAM_INT);
        $sth->bindValue(':time', $time, PDO::PARAM_INT);
        $sth->bindValue(':content', $content);
        $sth->bindValue(':user', $user);
        try
        {
            $sth->execute();
        } catch (Exception $ex) {
            $msg["msg"] = "日志记录无法记录，已中断程序" . $ex->getMessage();
            $msg["status"] = -1;
            echo json_encode($msg);
            exit();
        }
    }

    //日志数据处理及存储日志文件目录的生成
    public function makelog($msg, $prefix = "") {
        if ($prefix != "") {
            $prefix .= "_";
        }

        $dir = "/usr/local/omp/runtime/log/" . Date("Ym") . "/";
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $path = $dir . $prefix . date("Ymd") . ".log";
        $handle = fopen($path, "a");
        fwrite($handle, date("Y-m-d H:i:s", time()) . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $msg . "\n");
        fclose($handle);
        return str_replace('../', '', $path);
    }
    
    //验证并保存session
    //验证登陆
    public function checkLogin($om_id,$md5) {
        $e_bss_number = $ecid;
        session_start();
        $session_id = session_id();
	unset($_SESSION['eown']);
	unset($_SESSION['ep']);
        $sql4 = 'SELECT * FROM "T_OperationManager" WHERE om_id = :username ';
            $sql3 = 'SELECT * FROM "T_LoginCheck" WHERE c_om_id = :c_om_id';
            $sth3 = $this->pdo->prepare($sql3);
            $sth3->bindValue(':c_om_id', $om_id, PDO::PARAM_STR);
            $sth3->execute();
            $result3 = $sth3->fetch(PDO::FETCH_ASSOC);

            $sth4 = $this->pdo->prepare($sql4);
            $sth4->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth4->execute();
            $result4 = $sth4->fetch(PDO::FETCH_ASSOC);
            if ($result4) {
                if(md5($result4['om_id'].$result4['om_pswd'])!=$md5){
                    return -2;
                } else {
                            $_SESSION['om_id'] = $result4["username"];
                            $result4['om_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                            $_SESSION['own'] = $result4;
                            $_SESSION['time']=time();
                            $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",  time());

                            $data['om_lastlogin_time'] = date('Y-m-d H:i:s');
                            $data['om_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                            $sessionid = session_id();
                            $c_om_id = $om_id;
                            if ($result3 == false) {
                                    $sql1 = 'INSERT INTO "T_LoginCheck" ("c_om_id","c_sessionid") VALUES(:c_om_id,:c_sessionid)';
                                    $sth1 = $this->pdo->prepare($sql1);
                                    $sth1->bindValue(":c_om_id", $c_om_id, PDO::PARAM_STR);
                                    $sth1->bindValue(":c_sessionid", $sessionid, PDO::PARAM_STR);
                                    $sth1->execute();
                            } else {
                                    $sql2 = 'UPDATE "T_LoginCheck" SET c_sessionid=:c_sessionid WHERE  c_om_id=:c_om_id';
                                    $sth2 = $this->pdo->prepare($sql2);
                                    $sth2->bindValue(':c_om_id', $c_om_id);
                                    $sth2->bindValue(':c_sessionid', $sessionid);
                                    $sth2->execute();
                            }
                            $sql_upd = 'UPDATE "T_OperationManager"SET om_lastlogin_ip = :user_ip,om_lastlogin_time = :lastlogintime WHERE om_id = :username';
                            $sth = $this->pdo->prepare($sql_upd);
                            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
                            $sth->bindValue(':user_ip', $data['om_lastlogin_ip'], PDO::PARAM_STR);
                            $sth->bindValue(':lastlogintime', $data['om_lastlogin_time'], PDO::PARAM_STR);
                            $data = $sth->execute();
                            //$this->log(DL('登录成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7);
                            return 0;
                    }
            } else {
                    return -1;
            }
    }
	
	//验证登陆
public function checkLogin_emp($em_id,$md5) {
	unset($_SESSION['own']);
        $sql = 'SELECT * FROM "T_EnterpriseManager" WHERE em_id = :username AND em_ent_id=:em_ent_id';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':username', $em_id, PDO::PARAM_STR);
        $sth->bindValue(':em_ent_id', $em_id, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $sql1 = 'SELECT * FROM "T_Enterprise" WHERE e_name =:username';
        $sth1 = $this->pdo->prepare($sql1);
        $sth1->bindValue(':username', $em_id, PDO::PARAM_STR);
        $sth1->execute();

        $result1 = $sth1->fetch(PDO::FETCH_ASSOC);
        if ($result) {
                if (md5($result['em_id'].$result['em_pswd'])!=$md5) {
                        //$this->log($this->data["username"] . '密码错误', 7, 2);
                        return -2;
                } else {
                        $_SESSION['em_id'] = $result["username"];
                        $_SESSION['em_lastlogin_ip'] = $result['em_lastlogin_ip'];
                        $result['em_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                        $_SESSION['eown'] = $result;
                        $_SESSION['eown']['em_session_id'] = session_id();
                        $result['em_session_id']=session_id();
                        $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",  time());
                       $ep_sql="SELECT * FROM \"T_Enterprise\" WHERE e_id=:e_id";
			$sth = $this->pdo->prepare($ep_sql);
			$sth->bindValue(':e_id', $result2['em_ent_id'], PDO::PARAM_STR);
			$sth->execute();
			$data = $sth->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['ep'] = $data;
                        $_SESSION['eown']['em_area'] = $data['e_area'];
//                        $data['em_lastlogin_time'] = date('Y-m-d H:i:s');
//                        $data['em_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];

                        $sql_upd = 'UPDATE "T_EnterpriseManager" SET em_lastlogin_ip = :user_ip,em_lastlogin_time = :lastlogintime,em_session_id = :session_id WHERE em_id = :username';
                        $sth = $this->pdo->prepare($sql_upd);
                        $sth->bindValue(':username', $em_id, PDO::PARAM_STR);
                        $sth->bindValue(':user_ip', $result['em_lastlogin_ip'], PDO::PARAM_STR);
                        $sth->bindValue(':lastlogintime', date('Y-m-d H:i:s'), PDO::PARAM_STR);
                        $sth->bindValue(':session_id', $result['em_session_id'], PDO::PARAM_STR);
                        $data = $sth->execute();
//                        $this->log(DL('登录成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7);
                        return 0;
                }
        } else if($result1) {
            $e_id=$result1['e_id'];
            $sql2 = 'SELECT * FROM "T_EnterpriseManager" WHERE em_id = :username ';
            $sth2 = $this->pdo->prepare($sql2);
            $sth2->bindValue(':username', $e_id, PDO::PARAM_STR);
            $sth2->execute();
            $result2 = $sth2->fetch(PDO::FETCH_ASSOC);
            
            if($result2){
                 if (md5($result['em_id'].$result['em_pswd'])!=$md5) {
                        //$this->log($this->data["username"] . '密码错误', 7, 2);
                        return -2;
                } else {
                        $_SESSION['em_id'] = $result2["em_id"];
                        $_SESSION['em_lastlogin_ip'] = $result['em_lastlogin_ip'];
                        $result2['em_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                        $_SESSION['eown'] = $result2;
                        $_SESSION['eown']['em_session_id'] = session_id();
                        $result2['em_session_id']=session_id();
                        $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",  time());

//                        $ep = new enterprise(array('e_id' => $result2['em_ent_id']));
			$ep_sql="SELECT * FROM \"T_Enterprise\" WHERE e_id=:e_id";
			$sth = $this->pdo->prepare($ep_sql);
			$sth->bindValue(':e_id', $result2['em_ent_id'], PDO::PARAM_STR);
			$sth->execute();
			$data = $sth->fetch(PDO::FETCH_ASSOC);
			
                        $_SESSION['ep'] = $data;
                        $_SESSION['eown']['om_area'] = $data['e_area'];
                        $data['em_lastlogin_time'] = date('Y-m-d H:i:s');
                        $data['em_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];

                        $sql_upd = 'UPDATE "T_EnterpriseManager" SET em_lastlogin_ip = :user_ip,em_lastlogin_time = :lastlogintime,em_session_id = :session_id WHERE em_id = :username';
                        $sth = $this->pdo->prepare($sql_upd);
                        $sth->bindValue(':username', $e_id, PDO::PARAM_STR);
                        $sth->bindValue(':user_ip', $data['em_lastlogin_ip'], PDO::PARAM_STR);
                        $sth->bindValue(':lastlogintime', $data['em_lastlogin_time'], PDO::PARAM_STR);
                        $sth->bindValue(':session_id', $result2['em_session_id'], PDO::PARAM_STR);
                        $data = $sth->execute();
//                        $this->log(DL('登录成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7);
                        return 0;
                }
            }
        }else{
                return -1;
        }

}
}
?>