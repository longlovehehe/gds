<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:17:23
         compiled from "..\static\style\modules\report\show.tpl.css" */ ?>
<?php /*%%SmartyHeaderCode:1324557624473003957-66018791%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a27f4572e16b8680c9d2dd5904c5a4bbba636c7' => 
    array (
      0 => '..\\static\\style\\modules\\report\\show.tpl.css',
      1 => 1466057626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1324557624473003957-66018791',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576244730077d6_67680928',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576244730077d6_67680928')) {function content_576244730077d6_67680928($_smarty_tpl) {?>div.block label{
	min-width: 80px !important;
	padding-right: 20px;
}
table.base.full tr.charts{
	/*cursor: pointer;*/
	/*border: 1px solid #FFF;*/
}
table.base.full tr.charts:hover{
	border: 1px solid #8B2929 !important;
	border-right: 1px solid transparent !important;
}
div.charts-title{
	font-weight: bold;
}

table.base.full tr.charts.visted{
	border: 1px solid #8B2929 !important;
	border-right: 1px solid transparent !important;
}

table.base th {
    font-size: 12px;
    font-weight: bold;
    height: 50px;
    text-align: left;
    vertical-align: middle !important;
}

tr.charts{
    height:30px;
    text-align: left;
    line-height: 30px;
    padding:5px 0px 5px 0px; 
    vertical-align: middle !important;
}

tr.charts td.rich{
	width:90px;
}

table.base tr:nth-child(2n){
    background: #eeeeee !important;
}
table.base tr:nth-child(2n+1){
    background: #FFFFFF !important;
}
table.base.full{
	border:1px solid transparent;
}

div.tablehead{
	border-bottom:1px solid #fff;
	background: #DCE0E0;
	height: 45px;
}
div.tablecharts{
	/*border:1px solid #ccc;*/
	background: #DCE0E0;
	/*border:1px solid #FFF;*/
	height: 35px;
}


div.tablehead div.table-th{
	color:#535353;
	width: 81px;
	padding: 0px 5px 0px 5px;
	padding-top: 5px;
	/*padding-bottom: 10px;*/
	float: left;
}
div.tablehead div.table-th p{
	font-weight: bold;
	text-align: left;
	margin-bottom:0px !important;
}
div.tablecharts div.table-th{
	color:#B23E3E;
	font-weight: bold;
	width: 81px;
	padding: 0px 5px 0px 5px;
	padding-top: 10px;
	/*padding-bottom: 10px;*/
	float: left;
}

div.tablecharts:hover{
	font-size: 14px;
	/*border: 1px solid #8B2929 !important;*/
	cursor: pointer;
}
div.select-info{
	font-size: 14px;
	font-weight: bold;
	color:#B23E3E;
	padding: 10px;
}<?php }} ?>