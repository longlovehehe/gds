<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:17:24
         compiled from "..\template\_layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2746957624474700f80-42556737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eb160518febf4832b5d3ffc6f84370aea0ec85b' => 
    array (
      0 => '..\\template\\_layout.tpl',
      1 => 1465969890,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2746957624474700f80-42556737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'style' => 0,
    'account' => 0,
    'mininav' => 0,
    'item' => 0,
    'request' => 0,
    'content' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576244749e34b8_60939694',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576244749e34b8_60939694')) {function content_576244749e34b8_60939694($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if IE 7 ]><html class="ie7 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if IE 8 ]><html class="ie8 lang_<?php echo $_COOKIE['lang'];?>
 can_select"><![endif]--><!--[if IE 9 ]><html class="ie9 lang_<?php echo $_COOKIE['lang'];?>
 can_select"> <![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html class="lang_<?php echo $_COOKIE['lang'];?>
 can_select"><!--<![endif]--><head><meta charset="UTF-8"><meta http-equiv="pragma" content="max-age=2592000"><meta http-equiv="cache-control" content="max-age=2592000"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="renderer" content="webkit"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" /><title><?php echo L("数据统计");?>
</title><?php echo style($_smarty_tpl->tpl_vars['style']->value);?>
<link href="./style/datepicker/foundation.min.css" rel="stylesheet" type="text/css"><link href="./style/datepicker/foundation-datepicker.css" rel="stylesheet" type="text/css"><script src="script/libs.before.js"></script><script src="script/autoselect.js"></script><script src="script/form.js"></script><script src="./script/plugins/datepicker/foundation-datepicker.js"></script><script src="./script/plugins/datepicker/locales/foundation-datepicker.zh-CN.js"></script><script type="text/javascript">$(document).ready(function () {$().orion({speed: 500, animation: "zoom"});});$(function () {var scorllTop = 10;$('#lanPos').css('top', "9999px");$('ul li').hover(function () {scorllTop = $(this).position().top + 78;$('#lanPos').css('top', scorllTop);});$("li a.onelevel1").on("click", function () {if ($(this).parent().next().attr("class").indexOf("none") > 0) {$(this).parent().next().removeClass("none");} else {$(this).parent().next().addClass("none");}});});</script><?php echo scriptmodule('before');?>
<link  href="style/ie6.layout.adapter.css" rel="stylesheet" type="text/css" /><link  href="style/basic.css" rel="stylesheet" type="text/css" /><!--[if lte IE 8]><?php echo scriptnocompile('libs/html5');?>
<![endif]--></head><body class="<?php echo $_GET['m'];?>
" scroll="yes"><input type="hidden" name="lang" value="<?php echo $_COOKIE['lang'];?>
"/><span class="request none">[<?php echo mb_convert_encoding(htmlspecialchars(json_encode($_REQUEST), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
]</span><div class="lang" style="float:right;"><a class="lang" data="cn_ZH">中文版 </a><span class='sep'>|</span><a class="lang" data="en_US">English</a><span class='sep'>|</span><a class="lang" data="zh_TW">繁體中文</a></div><div class="quicktoolbar animated none"><input autocomplete="off"  value="<?php echo $_GET['u_number'];?>
" type="text" placeholder="输入需要搜索的企业用户帐号" /><a class="search" data="?m=enterprise&a=allusers&u_number="></a></div><div class="header"><header><h1 class="title <?php if ($_COOKIE['lang']=='en_US'){?>_GQT_icon_logo_1x120_en_png<?php }else{ ?>_GQT_icon_logo_1x120_png<?php }?>"><a><?php echo L("运营管理平台--数据统计");?>
</a></h1><div class="login_tips" style="overflow: hidden;float: right;padding-right: 20px;" ><div class="account" ><a class="link "><?php echo $_smarty_tpl->tpl_vars['account']->value;?>
</a>&nbsp;&nbsp;<a class="link" target="_blank" <?php if ($_SESSION['eown']!=null){?>href="?m=help"<?php }else{ ?><?php if ($_COOKIE['lang']=='zh_TW'){?>href="help_zh.html"<?php }elseif($_COOKIE['lang']=='en_US'){?>href="help_en.html"<?php }else{ ?>href="help.html"<?php }?><?php }?>><?php echo L("帮助");?>
</a></div></div></header></div><hr style="border-bottom:3px solid #B23E3E;border-top:0px solid #FF5F3E;" /><section class="content" style="overflow: hidden;"><div class="minipage" style="overflow: hidden;" ><div style="width:160px;height:500px;float:left;"><ul class="nav"><?php if ($_SESSION['eown']==null){?><li><a class="onelevel" href="?m=report&a=index" ><?php echo L("选择查询");?>
  》</a></li><ul class="twolevel none"><li><a class="charts_nav ajaxsub open index" href="javascript:void(0);" goto="index"><?php echo L("开户数据");?>
</a></li><li><a class="charts_nav ajaxsub open liveness livenessdata" href="javascript:void(0);" goto="livenessdata"><?php echo L("活跃度");?>
</a></li><li><a class="charts_nav ajaxsub open bissness bissnessdata"href="javascript:void(0);" goto="bissnessdata"><?php echo L("业务数据");?>
</a></li><li><a class="charts_nav ajaxsub terminal terminaldata"href="javascript:void(0);" goto="terminaldata"><?php echo L("终端");?>
</a></li><li><a class="charts_nav ajaxsub gprs_charts gprsdata"href="javascript:void(0);" goto="gprsdata"><?php echo L("流量卡");?>
</a></li></ul><li><a class="onelevel" href="?m=report&a=review"><?php echo L("整体回顾");?>
  》</a></li><ul class="twolevel none"><li><a class="charts_nav review" href="?m=report&a=review"><?php echo L("回顾");?>
</a></li></ul><?php }else{ ?><li><a class="onelevel" href="?m=enterprise&a=charts"><?php echo L("企业统计");?>
  》</a></li><ul class="twolevel"><li><a class="charts_nav charts" href="?m=enterprise&a=charts"><?php echo L("企业统计");?>
</a></li></ul><?php }?><div id="lanPos"></div></ul></div><div style=""></div><?php if ($_smarty_tpl->tpl_vars['mininav']->value!=null){?><nav class="mininav" style='background: transparent;'><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mininav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><a title='<?php echo L(((string)$_smarty_tpl->tpl_vars['item']->value['name']));?>
' class="ctips" <?php if ($_smarty_tpl->tpl_vars['item']->value['next']!=''){?>href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"<?php }else{ ?>style="color:#111;text-decoration:none;"<?php }?>><?php ob_start();?><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['name'],20);?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</a><?php echo $_smarty_tpl->tpl_vars['item']->value['next'];?>
<?php } ?></nav><?php }?><div class="pagecontent mini_<?php echo $_smarty_tpl->tpl_vars['request']->value['modules'];?>
_<?php echo $_smarty_tpl->tpl_vars['request']->value['action'];?>
 " style="overflow: hidden;padding-bottom:50px;padding-top: 30px;width:750px;" ><?php echo L(((string)$_smarty_tpl->tpl_vars['content']->value));?>
</div><div style="width:200px;float:right;"></div><div class="OnlineService_Bg"><div class="OnlineService_Box"><div class="OnlineService_Top"><a href="#"><?php echo L("返回顶部");?>
</a></div></div></div></div></section><footer class="none"><hr /><p class='hidden1'>Copyright (C) http://www.zed-3.com.cn/, All Rights Reserved</p><p class='hidden1'><?php echo L("捷思锐科技版权所有 京ICP备09032422号");?>
</p></footer><script src="?m=lang"></script><?php echo scriptafter($_smarty_tpl->tpl_vars['script']->value);?>
<script src="script/com.js"></script><div id="fade" class="black_overlay"></div></body></html>
<?php }} ?>