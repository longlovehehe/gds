<?php /* Smarty version Smarty-3.1.11, created on 2016-06-08 14:36:58
         compiled from "..\template\viewer\href.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187635757bd0ab7af07-44802094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c240bb8f8523e85eccea78670472cf3ef40f618' => 
    array (
      0 => '..\\template\\viewer\\href.tpl',
      1 => 1457923928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187635757bd0ab7af07-44802094',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'href' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5757bd0ac36721_80404943',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5757bd0ac36721_80404943')) {function content_5757bd0ac36721_80404943($_smarty_tpl) {?><!DOCTYPE html>
<html><head><meta charset="UTF-8"><title><?php echo L("页面转向中");?>
</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon"/></head><body><p><?php echo L(((string)$_smarty_tpl->tpl_vars['msg']->value));?>
<br /><?php echo L("页面转向中，请稍候。如果系统没有响应请");?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
"><?php echo L("点击跳转");?>
</a></p><script>setTimeout(function () {window.location.href = "<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
";}, 999);</script></body></html><?php }} ?>