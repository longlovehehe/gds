<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:17:24
         compiled from "..\template\modules\report\show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10980576244744edb09-12708604%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daccfbad21b77cd9929e7990bf6f0bbf19b10e63' => 
    array (
      0 => '..\\template\\modules\\report\\show.tpl',
      1 => 1466055810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10980576244744edb09-12708604',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'page' => 0,
    'usergroup' => 0,
    'group' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576244746f1586_76288937',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576244746f1586_76288937')) {function content_576244746f1586_76288937($_smarty_tpl) {?><link type="text/css" href="style/autocomplete.css" media="screen" rel="stylesheet" /><script src="./script/report/amcharts.js"></script><script src="./script/report/pie.js"></script><script src="./script/plugins/tableExport/jquery.table2excel.js"></script><script src="./script/autocomplete.js"></script><style>.ui-datepicker-calendar {display: none;}</style><div class="toptoolbar"></div><div class="toolbar"><form action="?m=enterprise&a=users_item&e_id=<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" id="form" method="post" ><input autocomplete="off"  name="modules" value="enterprise" type="hidden" /><input autocomplete="off"  name="action" value="charts_item" type="hidden" /><input autocomplete="off"  name="e_id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['e_id'];?>
" type="hidden" /><input autocomplete="off"  name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" type="hidden" /><div class="condition-seacher block" style="margin-right: 10px;"><label><?php echo L("查询目标");?>
：</label><select name='checkp' class="select-condition" style="border:1px solid #CCCCCC;height:32px; margin-left: 1px;width: 80px;"><option value="0">EMP</option><option value="1"><?php echo L("部门");?>
</option><option value="2"><?php echo L("个人");?>
</option></select><input type="text" class="form-control emp" value="EMP" style="width:191px;height:20px;border: 1px solid #bfbfbf;" placeholder="<?php echo L("输入名称");?>
" readonly><select class="form-control usergroup none" name="u_ug_id" style="width:223px;height:32px;border:1px solid #bfbfbf;"><?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usergroup']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['ug_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value['ug_name'];?>
</option><?php } ?></select><input type="text" class="form-control oneuser none" id="remote_input" name="u_name" style="width:191px;height:20px;border: 1px solid #bfbfbf;" placeholder="<?php echo L("输入名称");?>
" /></div><div class="select_time block"><label><?php echo L("查询日期");?>
：</label><select name='checkdate' class="select-condition" style="border:1px solid #CCCCCC;height:32px; margin-left: 1px;width: 80px;"><option value="0"><?php echo L("年");?>
</option><option value="1"><?php echo L("月");?>
</option><option value="2"><?php echo L("周");?>
</option><option value="3"><?php echo L("日");?>
</option></select><span class="add-on"><i class="icon-calendar"></i></span><input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport year inputnothing" name="year" type="text" value="<?php echo date('Y',strtotime("-1 day"));?>
" readonly /><input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport month inputnothing none" name="month" type="text" value="<?php echo date('Y-m',strtotime("-1 day"));?>
" readonly /><input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport week inputnothing none" name="week" type="text" value="<?php echo date('Y-m-d',time()-86400*date("N",time()));?>
" readonly /><input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport day inputnothing none" name="day" type="text" value="<?php echo date('Y-m-d',strtotime("-1 day"));?>
" readonly /></div><div style="clear:both;"></div><div class="buttons right"><a form="form" class="button submit"><?php echo L("查询");?>
</a></div></form></div><hr class="hr" /><div class="tablehead"><div class="table-th"></div><div class="table-th"><p><?php echo L("上线总人次");?>
<br>(<?php echo L("人次");?>
)</p></div><div class="table-th"><p><?php echo L("上线总时长");?>
<br>(<?php echo L("时/分/秒");?>
)</p></div><div class="table-th" width="92px"><p><?php echo L("语音通话");?>
<br>(<?php echo L("时/分/秒");?>
)</p></div><div class="table-th" width="92px"><p><?php echo L("视频通话");?>
<br>(<?php echo L("时/分/秒");?>
)</p></div><div class="table-th" width="92px"><p><?php echo L("对讲通话");?>
<br>(<?php echo L("时/分/秒");?>
)</p></div><div class="table-th" width="92px"><p><?php echo L("短信");?>
<br>(<?php echo L("条");?>
)</div><div class="table-th" style="width:100px;"><p><?php echo L("图片拍传");?>
<br>(<?php echo L("条");?>
)</p></div></div><div class="content"></div><div><hr /></div><div class="right"><a class="button export-excel"><?php echo L("导出数据");?>
</a></div><?php }} ?>