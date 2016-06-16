<?php /* Smarty version Smarty-3.1.11, created on 2016-06-08 14:50:18
         compiled from "..\template\viewer\404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:269695757c02a294845-77839319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7b8bdb3b59931bd4429943b2f9e85a6d57b5edd' => 
    array (
      0 => '..\\template\\viewer\\404.tpl',
      1 => 1457923928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269695757c02a294845-77839319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'msg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5757c02a319560_94009497',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5757c02a319560_94009497')) {function content_5757c02a319560_94009497($_smarty_tpl) {?><!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="renderer" content="webkit"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" /><meta name="viewport" content="width=device-width, initial-scale=1.0"><?php echo style('reset|p404');?>
<title>讯息</title></head><body class="p404"><div class="content"><div class="show pstyle<?php echo modrand("7");?>
"></div><div class="message"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? "提示讯息" : $tmp);?>
</div><div class="info">详细信息：<?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div><hr /><div class="toolbar"><a onclick="window.location.reload()">刷新</a><a href="?m=login">重新登录</a></div></div></body></html><?php }} ?>