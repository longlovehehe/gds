<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:03
         compiled from "..\template\modules\report\index_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3007557622353094033-61444817%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1a9f861f12bbd87b4b0291faadc098c2d38f623' => 
    array (
      0 => '..\\template\\modules\\report\\index_item.tpl',
      1 => 1465381117,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3007557622353094033-61444817',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'createtime' => 0,
    'change_time' => 0,
    'json' => 0,
    'arr_list' => 0,
    'item' => 0,
    'num' => 0,
    'res' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'arr' => 0,
    'key' => 0,
    'i' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57622353451198_78983754',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57622353451198_78983754')) {function content_57622353451198_78983754($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'D:\\Code\\OP\\gds\\html\\private\\libs\\Smarty\\plugins\\modifier.truncate.php';
?><?php if ($_smarty_tpl->tpl_vars['createtime']->value){?>
    <div class="toolbar mactoolbar open_data">
      <div class="left">
            <span><?php echo L("创建时间");?>
:<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['createtime']->value,15,'');?>
</span>
        </div>
         <div style="clear:both;"></div>
    </div>
<?php }?>
<form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("用户明细");?>
</div>
    <div class="right">
        <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['month'];?>
"><a href="javascript:void(0);"><?php echo L("月");?>
</a></div>
        <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['week'];?>
"><a href="javascript:void(0);"><?php echo L("周");?>
</a></div>
        <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['day'];?>
"><a href="javascript:void(0);"><?php echo L("日");?>
</a></div>
        <div class=" right_nav">&nbsp;&nbsp;</div>
        <div class="_already_open right_nav table_already_open"></div>
        <div class="_already_open right_nav picture_already_open active"></div>
    </div>
</div>
    <div class="get_day_info_already_open">
        <div id="_already_open" style="height: 400px;width:750px;overflow-x: auto;"></div>
        
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var _already_open;
        var chart2;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _already_open = AmCharts.makeChart("_already_open", {
                type: "serial",
                theme:theme,
                dataProvider: data,//折线数据
                categoryField: "date1",
                startDuration: 1.5,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
               chartCursor:{
                   animationDuration:0.03,
                   zoomable: true,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },

                categoryAxis: {
                    gridPosition: "middle",
                    fillColor: "#A83A3A",
                    autoGridCount: "false",
                    gridCount:data.length,
                    labelRotation:"45",

                },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L("人");?>
)",
                    integersOnly:true,
                }],
                AxisBase:{
                tickLength:1
                },
                chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                {
                    type: "line",
                    title: "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    lineAlpha:1,
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "[[title]]:<b>[[value]]</b>"
                }, 
                <?php } ?> 
                ],
                legend: {
                    position:"top",

                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    valueText:"",
                    switchType:"v",

                },
            });
            
//饼状图

        }
        _already_open.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
            var u = "";
            <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['res']->value['title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
            var c = "<?php echo $_smarty_tpl->tpl_vars['item1']->value;?>
";
            c = c.replace('#','');
            u +=  "<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
_"+c+"__";
            <?php } ?>
            layer.open({
                type: 2,
                title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
                content: '?<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
&time='+obj.item.dataContext.date+'&u='+u
            });
            <?php }?>
        }
        </script>
        <div class="already_users_table none">
   <script type="text/javascript">
    function fixupFirstRow(tab) {
        var div=tab.parent(); 

        if(div.attr("class")=="freezediv"){
            tab.children().children().eq(0).css("position","absolute");
            div.scroll(function(){ 
                var tr = tab.children().children().eq(0); 
                tr.css("top" , div.scrollTop-20); 
            }); 
        }
    }
    $(function(){
     var tab=$("#freezedivTable"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
        if($("div.picture_already_open").attr("class").indexOf("active") > 0){
            $("#_already_open").removeClass("none");
            $("div.picture_already_open").addClass("charts_picture_hover");
            $("div.table_already_open").addClass("charts_table");
            $("div.already_users_table").addClass("none");
        }else{
            $("#_already_open").addClass("none");
            $("div.already_users_table").removeClass("none");
            $("div.picture_already_open").addClass("charts_picture");
            $("div.table_already_open").addClass("charts_table_hover");
        }
    $("div.table_already_open").bind("click",function(){
    $("div.table_already_open").addClass("charts_table_hover");
    $("div.picture_already_open").addClass("charts_picture");
    $("div.picture_already_open").removeClass("charts_picture_hover");
    $("div.already_users_table").removeClass("none");
    $("#_already_open").addClass("none");
    });
$("div.picture_already_open").bind("click",function(){
    $("div.picture_already_open").addClass("charts_picture_hover");
    $("div.table_already_open").addClass("charts_table");
    $("div.table_already_open").removeClass("charts_table_hover");
    $("div.already_users_table").addClass("none");
    $("#_already_open").removeClass("none");
});
$("div.day_already_open").bind("click",function(){
    $("div.day_already_open a").css("color","#A83A39");
    $("div.week_already_open a").css("color","#121212");
    $("div.month_already_open a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_already_open",
            table_type:"already_users_table",
            title:{
                        name1:"<?php echo L("开户用户");?>
",
                        name2:"<?php echo L("商用");?>
",
                        name3:"<?php echo L("测试");?>
",
                        name4:"<?php echo L("启用");?>
",
                        name5:"<?php echo L("停用");?>
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
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_already_open").html(res);
            }
        });
});
$("div.week_already_open").bind("click",function(){
    $("div.week_already_open a").css("color","#A83A39");
    $("div.day_already_open a").css("color","#121212");
    $("div.month_already_open a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_already_open",
            table_type:"already_users_table",
            title:{
                        name1:"<?php echo L("开户用户");?>
",
                        name2:"<?php echo L("商用");?>
",
                        name3:"<?php echo L("测试");?>
",
                        name4:"<?php echo L("启用");?>
",
                        name5:"<?php echo L("停用");?>
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
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_already_open").html(res);
            }
        });
});
$("div.month_already_open").bind("click",function(){
    $("div.month_already_open a").css("color","#A83A39");
    $("div.day_already_open a").css("color","#121212");
    $("div.week_already_open a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_already_open",
            table_type:"already_users_table",
            title:{
                        name1:"<?php echo L("开户用户");?>
",
                        name2:"<?php echo L("商用");?>
",
                        name3:"<?php echo L("测试");?>
",
                        name4:"<?php echo L("启用");?>
",
                        name5:"<?php echo L("停用");?>
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
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_already_open").html(res);
            }
        });
});
//$("div.day_already_open a").css("color","#A83A39");
$("div._already_open").bind("click",function(){
    $("div._already_open").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script> 
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable" class="base full">
        <tr class='head' style="width:730px;">
            
            <th width="160px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
            <?php } ?>
        </tr>
        <tr  class='head'>
            <th width="160px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp2=ob_get_clean();?><?php echo L($_tmp2);?>
</th>
            <?php } ?>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <tr>
                
                <td width="160px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
<?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
<?php echo L("周");?>
)<?php }?></td>
                <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
                <?php if ($_REQUEST['unit']=="1"){?>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("bparam").($_smarty_tpl->tpl_vars['key1']->value), null, 0);?>
                <?php }else{ ?>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['key1']->value), null, 0);?>
                <?php }?>
                <td width="85px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
                <?php } ?>
            </tr>
            <?php } ?>

    </table>
    <?php if (!$_smarty_tpl->tpl_vars['list']->value){?>
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
    <?php }?>
</div>
        </div>
    </div>
</form>
<script type="text/javascript">
$(function(){  
    var checked = "<?php echo $_smarty_tpl->tpl_vars['change_time']->value['checked'];?>
";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_already_open a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['list']->value){?>
        $("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:120px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script>    <?php }} ?>