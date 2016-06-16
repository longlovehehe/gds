<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:01
         compiled from "..\template\modules\report\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2518657622351621854-17985488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '257513a156252ababbdc885fa61228063cdb26a3' => 
    array (
      0 => '..\\template\\modules\\report\\index.tpl',
      1 => 1464674564,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2518657622351621854-17985488',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762235171f712_24601149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762235171f712_24601149')) {function content_5762235171f712_24601149($_smarty_tpl) {?><!--代理商企业三级联动--><script src="jQuerySelectMenu/fg.menu.js"></script><link type="text/css" href="jQuerySelectMenu/theme/ui.all.css" media="screen" rel="stylesheet" /><link type="text/css" href="style/autocomplete.css" media="screen" rel="stylesheet" /><script src="./script/report/amcharts.js"></script><script src="./script/report/serial.js"></script><script src="./script/autocomplete.js"></script><style type="text/css">#menuLog { font-size:1.4em; margin:20px; }.hidden { position:absolute; top:0; left:-9999px; width:1px; height:1px; overflow:hidden; }.fg-button { clear:left;  padding: 1px 0px 6px 0px; text-decoration:none !important; cursor:pointer; position: relative; text-align: center; zoom: 1; }.fg-button .ui-icon { position: absolute; top: 50%; margin-top: -8px; left: 50%; margin-left: -8px; }a.fg-button { }button.fg-button { width:auto; overflow:visible; } /* removes extra button width in IE */.fg-button-icon-left { padding-left: 2.1em; }.fg-button-icon-right { padding-right: 24px; }.fg-button-icon-left .ui-icon { right: auto; left: .2em; margin-left: 0; }.fg-button-icon-right .ui-icon { left: auto; right: .2em; margin-left: 0; }.fg-button-icon-solo { display:block; width:8px; text-indent: -9999px; }	 /* solo icon buttons must have block properties for the text-indent to work */.fg-button.ui-state-loading .ui-icon { background: url(./jQuerySelectMenu/spinner_bar.gif) no-repeat 0 0; }</style><script type="text/javascript">$(function () {$('#remote_input').autocomplete({valueKey: 'title',source: [{url: "?m=report&a=get_ep_ag_list",type: 'remote',getValue: function (item) {return item.title},ajax: {dataType: 'json'}}]});});</script><form id="form" action="?m=report&a=report_item" method="post" data='{ "type" : "charts"}'><input autocomplete="off"  name="modules" value="report" type="hidden" /><input autocomplete="off"  name="action" value="report_item" type="hidden" /><input autocomplete="off"  name="page" value="0" type="hidden" /><input autocomplete="off"  name="ep_id" value="" type="hidden" /><input autocomplete="off"  name="status" value="" type="hidden" /><input autocomplete="off"  name="e_or_ag_id" value="" type="hidden" /><!--选择条件--><div class="condition-seacher" style="float:left;margin-right: 10px;"><div class="left"><?php echo L("选择目标");?>
：</div><div style="float:left;" class="select-portal none"><select name='checkp' class="select-condition" style="height:26px; margin-left: 1px;"><option value="0" selected="selected"><?php echo L("平台");?>
</option><option value="1">Server</option></select></div><input type="text" class="form-control nothing" id="remote_input" value="OMP" style="width:191px;" placeholder="<?php echo L("输入名称");?>
"><span class="input-group-btn"><a tabindex="0" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flyout"><span class="ui-icon ui-icon-triangle-1-s"></span><span class="select_enterprise"></span></a><button id="open" class="btn btn-default none" type="button"><span class="caret"></span></button></span></div><div class="select_time"><span><?php echo L("选择日期");?>
：</span><span class="add-on"><i class="icon-calendar"></i></span><input autocomplete="off" style="height:24px;" class="datepickerreport start inputnothing" name="start" type="text" value="<?php echo $_REQUEST['start'];?>
" readonly /><span>-</span><span class="add-on"><i class="icon-calendar"></i></span><input autocomplete="off" style="height:24px;" class="datepickerreport end inputnothing" name="end" type="text"  value="<?php echo $_REQUEST['end'];?>
"   readonly /></div><div style="clear:both;"></div><div class="buttons right"><a form="form" class="button submit" ><?php echo L("查询");?>
</a></div></form><hr style="margin:10px 0px;"/><div class="toolbar mactoolbar terminal_data none"></div><div class="toolbar mactoolbar gprs_data none"></div><div class="ajaxcontent"><div class="content charts"></div><div class="content charts2 none"></div><div class="content charts3 none"></div><div class="content charts4 none"></div><div class="content charts5 none"></div><div class="content charts6 none"></div><div class="content charts7 none"></div><div class="content charts8 none"></div><div class="content charts9 none"></div><div class="content charts10 none"></div><div class="content charts11 none"></div><div class="content charts12 none"></div><div class="content charts13 none"></div><div class="content charts14 none"></div><div class="content charts15 none"></div><div class="content charts16 none"></div><div class="content charts17 none"></div><div class="content charts18 none"></div><div class="content charts19 none"></div></div>
<?php }} ?>