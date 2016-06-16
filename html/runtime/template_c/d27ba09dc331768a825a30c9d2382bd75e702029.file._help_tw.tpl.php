<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 13:41:43
         compiled from "..\template\_help_tw.tpl" */ ?>
<?php /*%%SmartyHeaderCode:478657623c177551f2-32595432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd27ba09dc331768a825a30c9d2382bd75e702029' => 
    array (
      0 => '..\\template\\_help_tw.tpl',
      1 => 1465972981,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '478657623c177551f2-32595432',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57623c1783b9b0_80012288',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57623c1783b9b0_80012288')) {function content_57623c1783b9b0_80012288($_smarty_tpl) {?><html class="lang_cn_ZH can_select">
<head>
<meta charset="UTF-8">
<meta content="max-age=2592000" http-equiv="pragma">
<meta content="max-age=2592000" http-equiv="cache-control">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="webkit" name="renderer">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link type="image/x-icon" mce_href="favicon.ico" href="favicon.ico" rel="icon">
<title></title>
<style type="text/css">
	h1.title{
		background: rgba(0, 0, 0, 0) url("images/GQT_icon_logo_1x120.png") no-repeat scroll left 10px / 120px auto;
	    height: 60px;
	    margin: 0 auto;
	    padding-top: 10px;
	}	
	h1.title > a {
	    color: #848589;
	    font-family: "微软雅黑";
	    font-weight: 700;
	}
	a:link {
	text-decoration: none;
	}
	a:visited {
	text-decoration: none;
	}
	a:hover {
	text-decoration: none;
	}
	a:active {
	text-decoration: none;
	}
</style>
</head>
<body class="report" scroll="yes" style="background-color: #FFFFFF;font-family:verdana;">
<div style="float:right;">
	<a class="lang" data="cn_ZH"  href="?m=help&lang=cn_ZH">中文版 </a>
	<span class='sep'>|</span>
	<a class="lang" data="en_US" href="?m=help&lang=en_US">English</a>
	<span class='sep'>|</span>
	<a class="lang" data="zh_TW"  href="?m=help&lang=zh_TW">繁體中文</a>
</div>
	<div class="header" align="center">
		<header>
			<h1 class="title _GQT_icon_logo_1x120_png"  style="width:600px; float:left; margin-left:25%; ">
			<a>運營管理平臺--資料統計</a>
			</h1>
			<div class="login_tips" style="overflow: hidden;float: right;padding-right: 20px;">
			</div>
		</header>
	</div>
	<div style="clear:both"></div>
	<hr style="border-bottom:3px solid #B23E3E;border-top:0px solid #FF5F3E;">
	<table width="80%" height="300" border="0" cellspacing="5" cellpadding="0" align="center" style="font-size:14px;">
		<tr id="01" style="background-color:#B0C4DE">
			<td align="left" colspan="2" height="24px;">企业数据统计W</td>
		</tr>
		<tr>
			<td>上线总人次</td>
			<td>所选时间段内，查询目标内用户上线人次之和； 每人每天最多上线1人次</td>
		</tr>
		<tr>
			<td>上线总时长</td>
			<td>所选时间段内，查询目标内用户上线时间之和； 用户未登出，且一直保持App在后台工作，则一直记录未上线</td>
		</tr>
		<tr>
			<td>语音通话</td>
			<td>所选时间段内，查询目标内用户的语音业务时长之和（包含语音通话+告警），包含主被叫</td>
		</tr>
		<tr>
			<td>视频通话</td>
			<td>所选时间段内，查询目标内用户的视频业务时长之和（包含视频通话，视频上传，视频查看），包含主被叫</td>
		</tr>
		<tr>
			<td>对讲通话</td>
			<td>所选时间段内，查询目标内用户的对讲通话时长之和</td>
		</tr>
		<tr>
			<td>短信</td>
			<td>所选时间段内，查询目标内用户的短消息条数之和</td>
		</tr>
		<tr>
			<td>图片</td>
			<td>所选时间段内，查询目标内用户的图片拍传条数之和</td>
		</tr>
	</table>
</body>
</html><?php }} ?>