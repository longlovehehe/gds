<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:27
         compiled from "..\static\script\modules\report\review.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:236385762236bb6ef89-32484157%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a8356b5f931f3a94f8b8be06fd66b2dadd05acb' => 
    array (
      0 => '..\\static\\script\\modules\\report\\review.tpl.js',
      1 => 1463137025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236385762236bb6ef89-32484157',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236bba9916_03197944',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236bba9916_03197944')) {function content_5762236bba9916_03197944($_smarty_tpl) {?>$(function(){
  
        $("input.xdsoft_input").on("blur",function(){
              if($("#remote_input").val()==""){
                    $("input[name=ep_id]").val("");
                }else{
                    $("div.xdsoft_autocomplete_dropdown div").each(function(){
                            if($("#remote_input").val()==decodeURIComponent($(this).attr("data-value"))){
                                $("input[name=ep_id]").val($(this).attr("data-number"));
                           }

                    });
                }
        });
});

function get_already_open(obj){
        $.ajax({
            url:"?m=report&a=pies_open_users",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_already_open",
                table_type:"already_open_table",
                index:"1",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_calls(obj){
        $.ajax({
            url:"?m=report&a=pies_calls",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_calls",
                table_type:"already_open_table",
                index:"2",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_terminal(obj){
        $.ajax({
            url:"?m=report&a=pies_terminal",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_terminal",
                table_type:"already_open_table",
                index:"3",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_gprs(obj){
        $.ajax({
            url:"?m=report&a=pies_gprs",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_gprs",
                table_type:"already_open_table",
                index:"4",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_topamp(obj){
        $.ajax({
            url:"?m=report&a=pies_topamp",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_topamp",
                table_type:"already_open_table",
                index:"5",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
<?php }} ?>