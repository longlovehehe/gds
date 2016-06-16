<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:26
         compiled from "..\template\modules\report\bissnessdata\speaking_time.tpl" */ ?>
<?php /*%%SmartyHeaderCode:283015762236a30e173-05055718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d10364110b411278695ddfc7d102f51557b3d3b' => 
    array (
      0 => '..\\template\\modules\\report\\bissnessdata\\speaking_time.tpl',
      1 => 1464838518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '283015762236a30e173-05055718',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total' => 0,
    'change_time' => 0,
    'json' => 0,
    'res' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'arr' => 0,
    'item' => 0,
    'key' => 0,
    'arr_list' => 0,
    'i' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236a6177b2_62760438',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236a6177b2_62760438')) {function content_5762236a6177b2_62760438($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("累计对讲时长");?>
：<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
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
        <div class="right_nav">&nbsp;</div>
        <div class="_speaking_time right_nav table_speaking_time"></div>
        <div class="_speaking_time right_nav picture_speaking_time active"></div>
        
    </div>
</div>
    <div class="get_day_info_speaking_time">
        <div id="_speaking_time" style="height: 400px;width:755px;overflow-x: auto;"></div>
        <input type="hidden" name="json11" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script> 
        var chart1;
        var chart2;
        makeCharts("light", "#E5E5E5",eval($("input[name=json11]").val()));
        
        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;

            }
            // column chart
            chart1 = AmCharts.makeChart("_speaking_time", {
                type: "serial",
                theme:theme,
                dataProvider: data,//折线数据
                categoryField: "date1",
                startDuration: 1.5,
               chartCursor:{
                   zoomable: false,
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
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    integersOnly:true,
                }],
                AxisBase:{

                },
              chartScrollbar: {
                autoGridCount:false,
              },
                graphs: [
                {
                    type: "line",
                    title: "<?php echo L("对讲时长");?>
",
                    valueField: "param1",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"#A83A3A",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "[[title]]：<b>[[value]]</b>"
                }],
                legend: {
                    position:"top",
                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    switchType:"v",
                    valueText:"",
                },
            });

        }
        chart1.addListener("clickGraphItem",speaking_time_table);
        /**
         * 点击事件显示详细信息
         */
        function speaking_time_table(obj){
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
<div class="speaking_time_table none">
   <script type="text/javascript"> 
    function fixupFirstRow(tab) {
        var div=tab.parent(); 

        if(div.attr("class")=="freezediv"){
            tab.children().children().eq(0).css("zIndex","999");
            tab.children().children().eq(0).css("position","absolute");
            div.scroll(function(){ 
                var tr = tab.children().children().eq(0); 
                tr.css("top" , div.scrollTop-20); 
                
            }); 
        }
    }
    $(function(){
     var tab=$("#freezedivTable11"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_speaking_time").attr("class").indexOf("active") > 0){
            $("#_speaking_time").removeClass("none");
            $("div.picture_speaking_time").addClass("charts_picture_hover");
            $("div.speaking_time_table").addClass("none");
            $("div.table_speaking_time").addClass("charts_table");
        }else{
            $("#_speaking_time").addClass("none");
            $("div.speaking_time_table").removeClass("none");
            $("div.table_speaking_time").addClass("charts_table_hover");
            $("div.picture_speaking_time").addClass("charts_picture");
        }
    $("div.table_speaking_time").bind("click",function(){
        $("div.table_speaking_time").addClass("charts_table_hover");
        $("div.picture_speaking_time").addClass("charts_picture");
        $("div.picture_speaking_time").removeClass("charts_picture_hover");
        $("div.speaking_time_table").removeClass("none");
        $("#_speaking_time").addClass("none");
    });
$("div.picture_speaking_time").bind("click",function(){
    $("div.picture_speaking_time").addClass("charts_picture_hover");
    $("div.table_speaking_time").addClass("charts_table");
    $("div.table_speaking_time").removeClass("charts_table_hover");
    $("div.speaking_time_table").addClass("none");
    $("#_speaking_time").removeClass("none");
});
$("div.day_speaking_time a").bind("click",function(){
    $("div.day_speaking_time a").css("color","#A83A39");
    $("div.week_speaking_time a").css("color","#121212");
    $("div.month_speaking_time a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"day",
            data_type:"_speaking_time",
            table_type:"speaking_time_table",
            index:"11",
             title:{
                        name1:"<?php echo L("对讲时长");?>
",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_speaking_time").html(res);
            }
        });
});
$("div.week_speaking_time a").bind("click",function(){
    $("div.week_speaking_time a").css("color","#A83A39");
    $("div.day_speaking_time a").css("color","#121212");
    $("div.month_speaking_time a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"week",
            data_type:"_speaking_time",
            table_type:"speaking_time_table",
            index:"11",
            title:{
                        name1:"<?php echo L("对讲时长");?>
",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_speaking_time").html(res);
            }
        });
});
$("div.month_speaking_time a").bind("click",function(){
    $("div.month_speaking_time a").css("color","#A83A39");
    $("div.day_speaking_time a").css("color","#121212");
    $("div.week_speaking_time a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"month",
            data_type:"_speaking_time",
            table_type:"speaking_time_table",
            index:"11",
            title:{
                        name1:"<?php echo L("对讲时长");?>
",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_speaking_time").html(res);
            }
        });
});
//$("div.day_speaking_time a").css("color","#A83A39");
$("div._speaking_time").bind("click",function(){
    $("div._speaking_time").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable11" class="base full">
        <tr class='head' name="title" style="width:730px;">
            
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px;"><?php echo L("对讲时长");?>
</th>
        </tr>
        <tr  class='head' name="title">
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px"><?php echo L("对讲时长");?>
</th>
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
        $("div.day_speaking_time a").css("color","#A83A39");
    }

    $("tr[name=title]").css('z-index','-999');
    <?php if (!$_smarty_tpl->tpl_vars['list']->value){?>
        $("#_speaking_time").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>