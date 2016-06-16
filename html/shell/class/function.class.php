<?php

/**
 * 返回格式化处于过的时间字符串，格式：年-月-日 小时：分钟：秒
 * @package OMP_Common_Function_is
 * @param String $str
 * @return String 格式化时间
 */
function isDate($str) {
	return date('Y-m-d H:i:s', strtotime($str));
}

/**
 * 通过开始/结束时间，获取判断这两个时间区间的SQL
 * @package OMP_Common_Function
 * @param type $start
 * @param type $end
 * @return type
 */
function getDateRange($start, $end) {
	$start = isDate($start);
	$end = isDate($end);
	$where = <<<SQL
                BETWEEN to_timestamp('{$start}', 'yyyy-mm-dd HH24:MI:SS') AND to_timestamp('{$end}', 'yyyy-mm-dd HH24:MI:SS')
SQL;
	return $where;
}

/**
 * 判断参数1是否为手机格式。判断规则：1开始的字符串
 * @package OMP_Common_Function_is
 * @param type $phone
 * @return type
 */
function isPhone($phone) {
	$isPhone = "/^1/";
	return preg_match($isPhone, $phone);
}

/**
 * 通过给定的路径，创建多层文件夹
 * @package OMP_Common_Function
 * @param type $dirName
 * @param type $rights
 */
function mkdir_r($dirName, $rights = 0777) {
	$dirs = explode('/', $dirName);
	$dir = '';
	foreach ($dirs as $part) {
		$dir .= $part . '/';
		if (!is_dir($dir) && strlen($dir) > 0) {
			mkdir($dir, $rights);
		}
	}
}

/**
 * 多语言修正器
 * @package OMP_Common_Function
 * @global type $res
 * @param type $node
 * @param type $flag
 * @return string
 */
function L($node, $flag = TRUE) {
	$res = coms::$res;
	$result = '';
	if ($res[$node] == '') {
		return $node;
	} else {
		return $res[$node];
	}
	if ($flag) {
		return $result;
	}
	echo $result;
}

/**
 * 默认语言修正器
 * @package OMP_Common_Function
 * @global type $diff_res
 * @param type $node
 * @param type $flag
 * @return string
 */
function DL($node, $flag = TRUE) {
	$diff_res = coms::$diff_res;
	$result = '';
	if ($diff_res[$node] == '') {
		return $node;
	} else {
		return $diff_res[$node];
	}
	if ($flag) {
		return $result;
	}
	echo $result;
}

/**
 * 产生一个大于1的指定最大值的随机数
 * @package OMP_Common_Function
 * @param type $max
 * @return type
 */
function modrand($max) {
	return rand(1, $max);
}

/**
 * 管理员则返回内容，非管理员则不返回
 * @package OMP_Common_Function
 * @param type $str
 * @return string
 */
function isadmin($str) {
	if ($_SESSION['own']['om_id'] == 'admin') {
		return $str;
	}
	return "";
}

/**
 * @package OMP_Common_Function
 * @param type $str
 * @return string
 */
function isallarea($str) {
	if ($_SESSION['own']['om_area'] == '["#"]') {
		return $str;
	}
	return "";
}

/**
 * @package OMP_Common_Function
 * @param type $str
 * @return string
 */
function notadmin($str) {
	if ($_SESSION['own']['om_id'] != 'admin') {
		return $str;
	}
	return "";
}

/**
 * @package OMP_Common_Function_mod
 * @param type $level
 * @return string
 */
function level($level) {
	switch ($level) {
		case 'admin':
			return L("超级管理员");
		default:
			return L("普通管理员");
	}
}

/**
 * @package OMP_Common_Function
 * @param type $m
 * @return type
 */
function scriptmodule($m) {
	return <<<EOC
<script src="?m=loader&a=s&do=$m"></script>
EOC;
}

/**
 * @package OMP_Common_Function
 * @param type $src
 * @return type
 */
function scriptafter($src) {
	return <<<EOC
<script src="?m=loader&a=s&do=after&p={$src}"></script>
EOC;
}

/**
 * @package OMP_Common_Function
 * @param type $src
 * @return type
 */
function script($src) {
	return <<<EOC
<script src="?m=loader&a=s&p={$src}"></script>
EOC;
}

/**
 * @package OMP_Common_Function
 * @param type $src
 * @return type
 */
function scriptnocompile($src) {
	return <<<EOC
<script src="?m=loader&nocompile=true&a=s&p={$src}"></script>
EOC;
}

/**
 * @package OMP_Common_Function
 * @param type $src
 * @return type
 */
function style($src) {
	return <<<EOC
<link href="?m=loader&a=c&p={$src}" rel="stylesheet" type="text/css" />
EOC;
}

/**
 * 获取字符串长度，字符串，长度，如果超过长度显示的...
 */
function mbsubstr($str, $length = 10, $view = '...') {

	$s = mb_substr($str, 0, $length);
	if (mb_strlen($str) > $length) {
		$s .= $view;
	}
	return $s;
}

/**
 * 截取翻译
 */
function trsanlang($str) {
	$arr_str = explode("|", $str);
	foreach ($arr_str as $key => $value) {
		$arr_str1 = explode(",", $value);

		$str1 .= $arr_str1[0] . "," . L($arr_str1[1]) . "|";
	}

	$str1 = trim($str1, "|");
	return $str1;
}

function start_session($expire = 0) {
	if ($expire == 0) {
		$expire = ini_get('session.gc_maxlifetime');
	} else {
		ini_set('session.gc_maxlifetime', $expire);
	}
	if (empty($_COOKIE['PHPSESSID'])) {
		session_set_cookie_params($expire);
		session_start();
	} else {
		session_start();
		setcookie('PHPSESSID', session_id(), time() + $expire);
	}
}

/**
 * 001 002 003 自增长
 * @param type $num
 * @param type $step
 * @return type
 */
function autoInc($num, $step = 1) {
	$count = count(str_split($num));
	$num_new = intval($num) + $step;
	if ($num_new > pow(10, $count - 1)) {
		return $num_new;
	} else {
		return str_pad($num_new, $count, '0', STR_PAD_LEFT);
	}
}

/**
 * 二维数组取出重复
 */
function array_unique_fb($array2D) {
	foreach ($array2D as $k => $v) {
		$v = join(",", $v);  //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
		$temp[$k] = $v;
	}
	$temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
	foreach ($temp as $k => $v) {
		$array = explode(",", $v);  //再将拆开的数组重新组装
		$temp2[$k]["id"] = $array[0];
		$temp2[$k]["name"] = $array[1];
	}
	return $temp2;
}

/**
 * 将键是连续的一维的索引数组转为关联数组
 * @Author   longfei.wang
 * @DateTime 2015-12-11T15:45:23+0800
 * @param    [array]                   $arr [数组]
 * @return   [array]                        [返回 键不连续的关联数组]
 */
function indextoassoc($arr) {
	$array = array();
	$i = 1;
	foreach ($arr as $key => $value) {
		$array[$i] = $value;
		$i++;
		$i++;
	}
	return $array;
}

function set_title($number) {
	if (strlen($number) == 12) {
		return "color:#A43838";
	} else if (strlen($number) == 6) {
		return "";
	} else if ($number == "0") {
		return "color:#A43838;font-weight:bold;";
	} else {
		return "";
	}
}
