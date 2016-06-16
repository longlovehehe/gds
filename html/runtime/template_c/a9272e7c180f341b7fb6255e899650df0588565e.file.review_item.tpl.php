<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:27
         compiled from "..\template\modules\report\review_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127405762236be032a7-42473152%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9272e7c180f341b7fb6255e899650df0588565e' => 
    array (
      0 => '..\\template\\modules\\report\\review_item.tpl',
      1 => 1464674564,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127405762236be032a7-42473152',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_list' => 0,
    'call_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236c053483_66908672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236c053483_66908672')) {function content_5762236c053483_66908672($_smarty_tpl) {?><style type="text/css">
    #remark tr td{
        border:1px solid #CCCCCC;
        text-align: center;
    }
    #remark tr th{
        border:1px solid #CCCCCC;
        text-align: center;
        vertical-align: middle;
    }
</style>
<form class="data">
<table class="base full" id='remark'>
            <tr class="head">
                <th><?php echo L("累计用户");?>
</th>
                <th><?php echo L("累计在线");?>
</th>
                <th><?php echo L("累计对讲次数");?>
</th>
                <th><?php echo L("累计通话次数");?>
</th>
                <th><?php echo L("已用终端");?>
</th>
                <th><?php echo L("已用流量卡");?>
</th>
            </tr>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_creat_user'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_online_user'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['call_list']->value[0]['sdr_ptt_hcount'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['call_list']->value[0]['sdr_call_hcount'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_terminal_user'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_gprs_user'];?>
</td>
            </tr>
            <tr  class="head">
                <th><?php echo L("开户用户");?>
</th>
                <th><?php echo L("商用用户");?>
</th>
                <th><?php echo L("累计对讲时长");?>
</th>
                <th><?php echo L("累计通话时长");?>
</th>
                <th><?php echo L("商用终端");?>
</th>
                <th><?php echo L("商用流量卡");?>
</th>
            </tr>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_user'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_commercial_user'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['call_list']->value[0]['sdr_ptt_htime'];?>
(<?php echo L("分钟");?>
)</td>
                <td><?php echo $_smarty_tpl->tpl_vars['call_list']->value[0]['sdr_call_htime'];?>
(<?php echo L("分钟");?>
)</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_terminal_user_commercial'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['user_list']->value[0]['sdr_gprs_user_commercial'];?>
</td>
            </tr>
            <tr></tr>
        </table>
</form><?php }} ?>