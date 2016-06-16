<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:26
         compiled from "..\template\modules\report\bissnessdata\video_record.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154305762236a6c35d2-29497197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4f18afaaa22d5dc244030e37fa975e909f6bf91' => 
    array (
      0 => '..\\template\\modules\\report\\bissnessdata\\video_record.tpl',
      1 => 1464838518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154305762236a6c35d2-29497197',
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
    'check_date' => 0,
    'data_type' => 0,
    'table_type' => 0,
    'index' => 0,
    'arr' => 0,
    'item' => 0,
    'key' => 0,
    'arr_list' => 0,
    'i' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236ab015d3_76909396',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236ab015d3_76909396')) {function content_5762236ab015d3_76909396($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("累计视频次数");?>
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
        <div class="_video_record right_nav table_video_record"></div>
        <div class="_video_record right_nav picture_video_record active"></div>
        
    </div>
</div>
    <div class="get_day_info_video_record">
        <div id="_video_record" style="height: 400px;width:750px;overflow-x: auto;"></div>
        <input type="hidden" name="json14" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script> 
        var chart1;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json14]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;

            }
            // column chart
            chart1 = AmCharts.makeChart("_video_record", {
               type: "serial",
                dataProvider: data,
                categoryField: "date1",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
               
                chartCursor:{
                   zoomable: false,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },
                categoryAxis: {
                    gridPosition: "middle",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                    tickLength:3,
                },
            chartScrollbar: {
                autoGridCount:false,
              },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    stackType:"none",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
              //  AxisBase:{
              //  tickLength:1
              //  },
                graphs: [
                    {
                    title: "<?php echo L("主叫");?>
",
                    valueField: "param1",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#CCE198",
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                }, 
                {
                   title: "<?php echo L("被叫");?>
",
                    valueField: "param2",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#FF8888",
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                },
                {
                     type: "line",
                    title: "<?php echo L("总数");?>
",
                    valueField: "param3",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]]：<b>[[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }
        <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
          chart1.addListener("clickGraphItem",video_record_table);
        <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
          function video_record_table(obj){
                var ep_id = $("input[name=ep_id]").val();
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
                 // var time=obj.item.dataContext.week.split("~");
            //layer.alert(obj.item.dataContext.week);
            parent.layer.open({
                type: 2,
                title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>
                content: "?m=report&a=next_info_histogram&date_type=day&ep_id="+ep_id+"&stackType=none&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&total=<?php echo $_smarty_tpl->tpl_vars['res']->value['total'];?>
&u="+u
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                content: "?m=report&a=next_info_histogram&date_type=week&ep_id="+ep_id+"&stackType=none&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&total=<?php echo $_smarty_tpl->tpl_vars['res']->value['total'];?>
&u="+u
            <?php }?>

            });
        }
          <?php }?>
            </script>
<div class="video_record_table none">
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
     var tab=$("#freezedivTable14"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_video_record").attr("class").indexOf("active") > 0){
            $("#_video_record").removeClass("none");
            $("div.picture_video_record").addClass("charts_picture_hover");
            $("div.video_record_table").addClass("none");
            $("div.table_video_record").addClass("charts_table");
        }else{
            $("#_video_record").addClass("none");
            $("div.video_record_table").removeClass("none");
            $("div.table_video_record").addClass("charts_table_hover");
            $("div.picture_video_record").addClass("charts_picture");
        }
    $("div.table_video_record").bind("click",function(){
        $("div.table_video_record").addClass("charts_table_hover");
        $("div.picture_video_record").addClass("charts_picture");
        $("div.picture_video_record").removeClass("charts_picture_hover");
        $("div.video_record_table").removeClass("none");
        $("#_video_record").addClass("none");
    });
$("div.picture_video_record").bind("click",function(){
    $("div.picture_video_record").addClass("charts_picture_hover");
    $("div.table_video_record").addClass("charts_table");
    $("div.table_video_record").removeClass("charts_table_hover");
    $("div.video_record_table").addClass("none");
    $("#_video_record").removeClass("none");
    
});
$("div.day_video_record a").bind("click",function(){
    $("div.day_video_record a").css("color","#A83A39");
    $("div.week_video_record a").css("color","#121212");
    $("div.month_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"day",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"<?php echo L("主叫");?>
",
                        name2:"<?php echo L("被叫");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
$("div.week_video_record a").bind("click",function(){
    $("div.week_video_record a").css("color","#A83A39");
    $("div.day_video_record a").css("color","#121212");
    $("div.month_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"week",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"<?php echo L("主叫");?>
",
                        name2:"<?php echo L("被叫");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
$("div.month_video_record a").bind("click",function(){
    $("div.month_video_record a").css("color","#A83A39");
    $("div.day_video_record a").css("color","#121212");
    $("div.week_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"month",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"<?php echo L("主叫");?>
",
                        name2:"<?php echo L("被叫");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
//$("div.day_video_record a").css("color","#A83A39");
$("div._video_record").bind("click",function(){
    $("div._video_record").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable14" class="base full">
        <tr class='head' style="width:730px;">
            
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px;"><?php echo L("主叫");?>
</th>
            <th width="375px;"><?php echo L("被叫");?>
</th>
            <th width="375px;"><?php echo L("总数");?>
</th>
        </tr>
        <tr  class='head'>
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px;"><?php echo L("主叫");?>
</th>
            <th width="375px;"><?php echo L("被叫");?>
</th>
            <th width="375px;"><?php echo L("总数");?>
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
        $("div.day_video_record a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['list']->value){?>
        $("#_video_record").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script>   <?php }} ?>