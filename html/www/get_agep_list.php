<?php
require_once '../shell/class/db.class.php';
$path=dirname(__FILE__);
$array=  explode(DIRECTORY_SEPARATOR , $path);
array_pop($array);
$str=  implode(DIRECTORY_SEPARATOR ,$array );
define("ROOT_ADDR", $str);
$pdo=new db();
// $pdo->table("T_User")->insert(array(
//                "u_number"=>"20000020001"
//            ));
$ep_list=$pdo->table("T_Enterprise")->filed(array("e_id AS ag_number","e_name AS title"),false)->where("e_id !=999999")->select();
$ag_list=$pdo->table("T_Agents")->filed(array("ag_number","ag_name AS title"),false)->where()->select();
foreach ($ep_list as $key => $value) {
   array_push($ag_list, $value);
}


echo json_encode($ag_list,TRUE);


