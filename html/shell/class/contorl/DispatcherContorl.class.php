<?php

/**
 * 主控制分发器
 * @package Common
 * @require {@see contorl} {@see system}
 */
class DispatcherContorl extends contorl {

	public $timeOut;
	public $session;
	public $type;
	public function __construct() {
		parent::__construct();
		if(isset($_SESSION['eown'])){
			$this->timeOut=$_SESSION['eown']['em_lastlogin_time'];
			$this->session=$_SESSION['eown'];
			$this->type='emp';
		}else{
			$this->timeOut=$_SESSION['own']['om_lastlogin_time'];
			$this->session=$_SESSION['own'];
			$this->type='omp';
		}
	}

	public function lang() {
		$lang = json_encode(coms::$res);
		coms::head('script');
		print("window.lang = $lang ;");
	}

	/**
	 * 分发器公用方法
	 * @param String $flag 值：none login admin
	 */
	public function common($flag = 'none') {
		session_cache_expire(20);
		$tools = new tools();
		if (file_exists('../private/config/db.json')) {
			$tools->init();
		} else {
			$this->smarty->template_dir = "../template";
			$this->smarty->cache_dir = "../runtime/cache";
			$this->smarty->compile_dir = "../runtime/template_c";
//			$init = new InitContorl();
//
//			if (isset($_REQUEST['shell'])) {
//				$init->initShell();
//			} else {
//				$init->init_lang();
//			}
			exit();
		}
		
		switch ($flag) {
			case 'none':

				break;
			case 'emp':
				$tools->safe360();
				$this->check_timeout(time(),$this->timeOut);
				$this->otherLogin();
				$this->permissions($this->session,$this->type);
				break;
			case 'omp':
				$tools->safe360();
				$this->check_timeout(time(),$this->timeOut);
				$this->otherLogin();
				$this->permissions($this->session, $this->type);
				break;
			case 'normal':
				$tools->safe360();
				$this->check_timeout(time(),$this->timeOut);
				$this->otherLogin();
				$this->permissions($this->session, $this->type);
				break;
		}
	}

        public function check_out(){
            $this->check_timeout(time(),$this->timeOut);
        }
    /**
     * 异地登录验证
     */
    public function otherLogin() {
            session_cache_expire(20);
            session_start();
            $system = new system();
            $otherlogininfo = $system->checkOtherLogin($this->session);
//            $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",  time());
            if($this->session==null){
                header('HTTP/1.1 401 Unauthorized');
                $msg = L("请先登录平台");
                $_SESSION['own'] = NULL;
                //session_destroy();
                $this->smarty->assign('msg', $msg);
                $this->htmlrender('modules/system/login.tpl');
                exit();
            }
            if ($otherlogininfo['status']) {
                    header('HTTP/1.1 401 Unauthorized');
                    $msg = $otherlogininfo['msg'];
                    $_SESSION['own'] = NULL;
                    //session_destroy();
                    $this->smarty->assign('msg', $msg);
                    $this->htmlrender('modules/system/login.tpl');
                    exit();
            } else if ($otherlogininfo["id"]) {
                    header('HTTP/1.1 401 Unauthorized');
                    $msg = sprintf($otherlogininfo['msg'], $otherlogininfo['db_om_lastlogin_ip'], $otherlogininfo['om_lastlogin_ip']);
                    $_SESSION['own'] = NULL;
                    //session_destroy();
                    $this->smarty->assign('msg', $msg);
                    $this->htmlrender('modules/system/login.tpl');
                    exit();
            }
    }

	/**
	 * 加载器
	 */
	public function loader() {
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/contorl/LoaderContorl.class.php';
		$loaderContorl = new LoaderContorl();
		if (method_exists($loaderContorl, $action)) {
			$loaderContorl->$action();
		}
	}

	/**
	 * 帮助文档
	 * @todo 编写运营平台的帮助手册
	 */
	public function help() {
		if(isset($_REQUEST['lang'])){
			$lang=$_REQUEST['lang'];
		}else{
			$lang=$_COOKIE['lang'];
		}
		switch ($lang) {
			case "zh_TW":
				$this->htmlrender('_help_tw.tpl');
				break;
			case "en_US":
				$this->htmlrender('_help_en.tpl');
				break;
			default:
				$this->htmlrender('_help.tpl');
				break;
		}
		
	}

	public function test() {
		ignore_user_abort(true);
		set_time_limit(60 * 60 * 24);
		$db = coms::db();

		$i = 99999999;
		while ($i > 0) {
			$i--;
			$db->log(L('单表压力测试') . $i);
		};
		//coms::head('reload');
	}


	/**
	 * 未支持提示页
	 */
	public function nonsupport() {
		$this->tools->notfound(L('不支持您使用的浏览器'));
	}

	/**
	 * 登录页
	 */
	public function login() {
		$this->smarty->assign('title', '集群通 - 登录');
		$this->smarty->display('modules/system/login.tpl');
	}

	/**
	 * 配置页
	 */
	public function config() {
		$tools = new tools();
		$tools->setlangconfig($_REQUEST['lang']);
		$this->smarty->assign('title', '初始化');
		$this->smarty->assign('lang', $_REQUEST['lang']);
		$this->htmlrender('_init.tpl');
	}

	/**
	 * 注销
	 */
	public function logout() {
		session_cache_expire(20);
		session_start();
		$db = new db();
		$db->log(DL('注销成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7, 0);
		$_SESSION['own'] = NULL;
		//session_destroy();
		$this->smarty->assign('msg', L("注销成功"));
		$this->smarty->assign('href', "?m=login");
		$this->htmlrender('viewer/href.tpl');
	}
        /**
         * 登陆超时检查
         */
        public function check_timeout($time,$session_time){
            $lifetime=session_cache_expire()*60;//转化为秒
//            $lifetime=session_cache_expire();//转化为秒
            $new_time=$time;
            $old_time=strtotime($session_time)==false?0:strtotime($session_time);
            if(time()-$old_time>$lifetime){
                $this->smarty->assign('msg', L("帐号长时间未操作,请重新登录"));
                //$this->smarty->assign('href', "?m=login");
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
                $info=L('帐号长时间未操作,请重新登录');
                //print("<script>parent.confirm('见到你真的很高兴', {icon: 6});location.href='?m=login';</script>");
                print("<script>parent.layer.alert('".$info."', {title: false,icon: 2,btn:'OK',closeBtn:0},function(){parent.window.close();});</script>");
                print('</body></html>');
                //$_SESSION['own']['em_lastlogin_time']=NULL;
               // $this->render('modules/system/login.tpl');
                die;
            }else{
		if(isset($_SESSION['eown'])){
			$_SESSION['eown']['em_lastlogin_time']=date("Y-m-d H:i:s",time());
		}else{
			$_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",time());
		}	
                
            }
        }

//        public function checkTimeOut($time,$session_time){
//            $lifetime=session_cache_expire();//转化为秒
//            $new_time=$time;
//            $old_time=strtotime ($session_time);
//            //var_dump($new_time-$old_time);die;
//            if($new_time-$old_time>$lifetime){
//                return -1;
//            }
//        }
	/**
	 * 登录检查
	 */
	public function login_check() {
		$this->common();
		session_cache_expire(20);
		session_start();

		$system = new system($_REQUEST);
		$data = $system->checkLogin();

		if ($data == -1) {
			$this->smarty->assign('msg', "帐号错误");
			$this->smarty->assign('href', "?m=login");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
		if ($data == -2) {
			$this->smarty->assign('msg', "密码错误");
			$this->smarty->assign('href', "?m=login");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
		if ($data == 0) {
			$this->smarty->assign('msg', "登陆成功");
			$this->smarty->assign('href', "?m=report&a=index");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
	}

        	/**
	 * 公共模块分发
	 */
	public function system() {
		$this->common('normal');
		require_once '../shell/class/dao/system.class.php';
		require_once '../shell/class/contorl/SystemContorl.class.php';

		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		$SystemContorl = new SystemContorl($smarty, $tools);
		if (method_exists($SystemContorl, $action)) {
			$SystemContorl->$action();
		}
	}
    /**
     * 数据报表模块分发
     */
    public function report()
    {
	if($this->type=="emp"){
		header("Location: ?m=enterprise&a=charts");
	}
        $this->common ( 'normal' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( "action" ) != "" ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/report.class.php';
        require_once '../shell/class/formatdate.class.php';
        require_once '../shell/class/contorl/ReportContorl.class.php';

        $reportContorl = new ReportContorl ( $smarty , $tools );
        if ( method_exists ( $reportContorl , $action ) )
        {
            try
            {
                $reportContorl->$action ();                      
            }
            catch ( Exception $ex )
            {
                $tools->log ( '发送了' . $name . '消息。命令：' . $ex->getMessage () . "。结果：" . $ex->getCode () , 'shell_error' );
                $tools->call ( $ex->getMessage () , $ex->getCode () , true );
            }
        }
    }
    
	/**
	 * 企业模块分发
	 */
	public function enterprise() {
		if($this->type=="omp"){
			header("Location: ?m=report&a=index");
		}
		$this->common('normal');
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

//		require_once '../shell/class/contorl/EnterpriseViewContorl.class.php';
//		require_once '../shell/class/contorl/EnterpriseUsersContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseChartsContorl.class.php';
		require_once '../shell/class/dao/enterprisecharts.class.php';
//		$enterpriseViewContorl = new EnterpriseViewContorl();
//		$enterpriseUsersContorl = new EnterpriseUsersContorl();
		$enterpriseChartsContorl = new EnterpriseChartsContorl();

//		if (method_exists($enterpriseViewContorl, $action)) {
//			$enterpriseViewContorl->$action();
//		}
//
//		if (method_exists($enterpriseUsersContorl, $action)) {
//			$enterpriseUsersContorl->$action();
//		}
		if (method_exists($enterpriseChartsContorl, $action)) {
			$enterpriseChartsContorl->$action();
		}

	}

}
