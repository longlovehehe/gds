<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:01
         compiled from "..\static\script\modules\report\index.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:3059557622351e7e445-09295403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54553eab08795d0679bbdc94b2e707e73a3d9506' => 
    array (
      0 => '..\\static\\script\\modules\\report\\index.tpl.js',
      1 => 1464838517,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3059557622351e7e445-09295403',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57622352133f47_09608102',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57622352133f47_09608102')) {function content_57622352133f47_09608102($_smarty_tpl) {?>$("div.charts2").removeClass("none");
$("div.charts3").removeClass("none")

$("select.select-condition").on("change",function(event){
            var condition=$(this).val();
            if(condition==1){
                $("div.positionHelper").remove();
                $.ajax({
                        url:"?m=report&a=con_server",
                        dataType:"html",
                        async:false,
                        success:function(html){
                            $("div.condition-seacher").html(html);
                        }
                });
            }else if(condition==0){
               $("div.positionHelper").remove();
               $.ajax({
                        url:"?m=report&a=getagep",
                        dataType:"html",
                        async:false,
                        success:function(data){
                            $('#flyout').menu({ content: data, flyOut: true });
                        }
                });
            }
        });
        var count=0;
        $("#flyout").on("click",function(){
            ++count;
        });
$("a.ajaxsub").on("click",function(){
	$("input[name=page]").val("0");
    $("a.charts_nav").removeClass("hover");
    $(this).addClass("hover");
    var url = $(this).attr("goto");
    var data = $("#form").serialize();
    
    switch (url){
        case 'index':
            $("div.content").addClass("none");
            $("div.fg-menu-container.ui-widget.ui-widget-content.ui-corner-all.fg-menu-flyout").css("left","-250px");
            changeSelect();
            $("div.select-portal").addClass("none");
            $("div.charts").removeClass("none");
            get_already_open($("div.charts"));
            $("div.charts2").removeClass("none");
            get_commercial_users($("div.charts2"));
            $("div.charts3").removeClass("none");
            get_live_ratio($("div.charts3"));
          break;
        case 'livenessdata':
            $("div.content").addClass("none");
            $("div.fg-menu-container.ui-widget.ui-widget-content.ui-corner-all.fg-menu-flyout").css("left","-250px");
            changeSelect();
            $("div.select-portal").addClass("none");
            $("div.charts7").removeClass("none");
            get_live_num($("div.charts7"));
            $("div.charts8").removeClass("none");
            get_live_sum($("div.charts8"));
            $("div.charts9").removeClass("none");
            get_liveness($("div.charts9"));
            
          break;
        case 'bissnessdata':
            $("div.content").addClass("none");
            $("div.fg-menu-container.ui-widget.ui-widget-content.ui-corner-all.fg-menu-flyout").css("left","-131px");
            changeSelectServer();
            $("div.select-portal").removeClass("none");
            $("div.charts10").removeClass("none");
            get_intercom_recording($("div.charts10"));
            $("div.charts11").removeClass("none");
            get_speaking_time($("div.charts11"));
            $("div.charts12").removeClass("none");
            get_call_record($("div.charts12"));
            $("div.charts13").removeClass("none");
            get_call_time($("div.charts13"));
            $("div.charts14").removeClass("none");
            get_video_record($("div.charts14"));
            $("div.charts15").removeClass("none");
            get_video_time($("div.charts15"));
          break;
        case 'terminaldata':
            $("div.content").addClass("none");
            $("div.fg-menu-container.ui-widget.ui-widget-content.ui-corner-all.fg-menu-flyout").css("left","-250px");
            changeSelect();
            $("div.select-portal").addClass("none");
            $("div.charts16").removeClass("none");
            get_term_type($("div.charts16"));
            $("div.charts17").removeClass("none");
            get_term_agents($("div.charts17"));
          break;
        case 'gprsdata':
            $("div.content").addClass("none");
            $("div.fg-menu-container.ui-widget.ui-widget-content.ui-corner-all.fg-menu-flyout").css("left","-250px");
            changeSelect();
            $("div.select-portal").addClass("none");
            $("div.charts18").removeClass("none");
            get_gprs_type($("div.charts18"));
            $("div.charts19").removeClass("none");
            get_gprs_agents($("div.charts19"));
          break;
    }
});

/**
 * 更新获取已开户用户数
 * @param {type} obj
 * @returns {undefined}
 */
function get_already_open(obj){
        $.ajax({
            url:"?m=report&a=report_item",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_already_open",
                table_type:"already_open_table",
                title:{
                        name1:"<?php echo L('开户用户');?>
",
                        name2:"<?php echo L('商用');?>
",
                        name3:"<?php echo L('测试');?>
",
                        name4:"<?php echo L('启用');?>
",
                        name5:"<?php echo L('停用');?>
",
                        name6:'Phone',
                        name7:'Console',
                        name8:'GVS',
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#BAE4F8',
                        color4:'#6F73F3',
                        color5:'#B0B4B4',
                        color6:'#FFE250',
                        color7:'#56BA8A',
                        color8:'#E465C8'
                    },
                index:"",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
/**
 * 更新获取商用用户数
 * @param {type} obj
 * @returns {undefined}
 */
function get_commercial_users(obj){
        $.ajax({
            url:"?m=report&a=get_commercial_users",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_commercial",
                table_type:"commercial_users_table",
                title:{
                        name1:"<?php echo L('新增用户');?>
",
                        name2:"<?php echo L('删除用户');?>
",
                        name3:"<?php echo L('净增长');?>
",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
                index:"2",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_live_ratio(obj){
    $.ajax({
            url:"?m=report&a=get_live_ratio",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_live",
                table_type:"live_ratio_table",
                title:{
                        name1:"<?php echo L('存活用户数');?>
",
                        name2:"<?php echo L('遗失用户数');?>
",
                        name3:"<?php echo L('累计用户数');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                index:"3",
                total:"<?php echo L('累计用户数');?>
",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_live_num(obj){
    $.ajax({
            url:"?m=report&a=get_live_num",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_livenum",
                table_type:"live_num_table",
                title:{
                        name1:"<?php echo L('在线人数');?>
",
                        name2:"<?php echo L('离线人数');?>
",
                        name3:"<?php echo L('总数');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"<?php echo L('总数');?>
",
                index:"7",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_live_sum(obj,online_days){
    var online_days=online_days?online_days:3;
  $("#date_type").val('day');
    $.ajax({
            url:"?m=report&a=get_live_sum",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_livesum",
                table_type:"live_sum_table",
                online_days:online_days,
                title:{
                        name1:"<?php echo L('在线人数');?>
",
                        color1:'#A83A3A'
                    },
                index:"8",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_liveness(obj){
    $.ajax({
            url:"?m=report&a=get_liveness",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_liveness",
                table_type:"liveness_table",
                title:{
                    name1:"<?php echo L('活跃度');?>
",
                    color1:'#A83A3A'
                },
                unit:"1",
                index:"9",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}

function get_intercom_recording(obj){
    $.ajax({
            url:"?m=report&a=get_intercom_recording",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_intercom_recording",
                table_type:"intercom_recording_table",
                title:{
                    name1:"<?php echo L('对讲次数');?>
",
                    color1:'#F7B249'
                },
                index:"10",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_speaking_time(obj){
    $.ajax({
            url:"?m=report&a=get_speaking_time",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_speaking_time",
                table_type:"speaking_time_table",
                title:{
                    name1:"<?php echo L('对讲时长');?>
",
                    color1:'#F7B249'
                },
                index:"11",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_call_record(obj){
    $.ajax({
            url:"?m=report&a=get_call_record",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_call_record",
                table_type:"call_record_table",
                title:{
                        name1:"<?php echo L('主叫');?>
",
                        name2:"<?php echo L('被叫');?>
",
                        name3:"<?php echo L('总数');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L('总数');?>
",
                index:"12",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_call_time(obj){
    $.ajax({
            url:"?m=report&a=get_call_time",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_call_time",
                table_type:"call_time_table",
                title:{
                        name1:"<?php echo L('主叫');?>
",
                        name2:"<?php echo L('被叫');?>
",
                        name3:"<?php echo L('总时长');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L('总时长');?>
",
                index:"13",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_video_record(obj){
    $.ajax({
            url:"?m=report&a=get_video_record",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_video_record",
                table_type:"video_record_table",
                title:{
                        name1:"<?php echo L('主叫');?>
",
                        name2:"<?php echo L('被叫');?>
",
                        name3:"<?php echo L('总数');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L('总数');?>
",
                index:"14",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_video_time(obj){
    $.ajax({
            url:"?m=report&a=get_video_time",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                checkp:$('select[name=checkp]').val(),
                date_type:"day",
                data_type:"_video_time",
                table_type:"video_time_table",
                title:{
                        name1:"<?php echo L('主叫');?>
",
                        name2:"<?php echo L('被叫');?>
",
                        name3:"<?php echo L('总时长');?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L('总时长');?>
",
                index:"15",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}

function get_term_type(obj){
    $.ajax({
            url:"?m=report&a=get_term_type",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"year",
                //date_type:"month",
                //date_type:"week",
                //date_type:"day",
                data_type:"_term_type",
                table_type:"term_type_table",
                title:{
                      name1:"<?php echo L('商用');?>
",
                      name2:"<?php echo L('测试');?>
",
                      name3:"<?php echo L('总数');?>
",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<?php echo L('总数');?>
",
                index:"16",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
function get_term_agents(obj){
    $.ajax({
            url:"?m=report&a=get_term_agents",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_term_type",
                table_type:"term_type_table",
                title:{
                      name1:"<?php echo L('商用');?>
",
                      name2:"<?php echo L('测试');?>
",
                      name3:"<?php echo L('总数');?>
",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<?php echo L('总数');?>
",
                index:"17",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
function get_gprs_type(obj){
    $.ajax({
            url:"?m=report&a=get_gprs_type",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                //date_type:"month",
                date_type:"year",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                title:{
                      name1:"<?php echo L('商用');?>
",
                      name2:"<?php echo L('测试');?>
",
                      name3:"<?php echo L('总数');?>
",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<?php echo L('总数');?>
",
                index:"18",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val(),
                this_start:$("input[name=this_start]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
function get_gprs_agents(obj){
    $.ajax({
            url:"?m=report&a=get_gprs_agents",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                title:{
                      name1:"<?php echo L('商用');?>
",
                      name2:"<?php echo L('测试');?>
",
                      name3:"<?php echo L('总数');?>
",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<?php echo L('总数');?>
",
                index:"19",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val(),
                this_start:$("input[name=this_start]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}

function changeSelect(){
    $("div.positionHelper").remove();
//    console.log($("select[name=checkp]").val());
    if($("select[name=checkp]").val()==1){
        $("#remote_input").val("OMP");
        $("input[name=ep_id]").val();
        $.ajax({
                        url:"?m=report&a=con_oae",
                        dataType:"html",
                        async:false,
//                        data:{start},
                        success:function(html){
                            $("div.condition-seacher").html(html);
                        }
                });
    }else{
        if(count>0){
            $.ajax({
                 url:"?m=report&a=getagep",
                 dataType:"html",
                 async:false,
                 success:function(data){
                     $('#flyout').menu({ content: data, flyOut: true });
                 }
         });
        }
    }
}

function changeSelectServer(){
    $("div.positionHelper").remove();
    if($("select[name=checkp]").val()==1){
        $("div.positionHelper").remove();
        $("#remote_input").val("");
        $.ajax({
                url:"?m=report&a=con_server",
                dataType:"html",
                async:false,
                success:function(html){
                    $("div.condition-seacher").html(html);
                }
        });
    }else{
        $("div.positionHelper").remove();
        if(count>0){
            $.ajax({
                 url:"?m=report&a=getagep",
                 dataType:"html",
                 async:false,
                 success:function(data){
                     $('#flyout').menu({ content: data, flyOut: true });
                 }
            });
        }
    }
     
}<?php }} ?>