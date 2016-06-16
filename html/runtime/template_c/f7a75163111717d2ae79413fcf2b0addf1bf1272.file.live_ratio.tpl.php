<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:03
         compiled from "..\template\modules\report\opendata\live_ratio.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142715762235399ca48-80872430%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7a75163111717d2ae79413fcf2b0addf1bf1272' => 
    array (
      0 => '..\\template\\modules\\report\\opendata\\live_ratio.tpl',
      1 => 1464943827,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142715762235399ca48-80872430',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'change_time' => 0,
    'json' => 0,
    'arr_list' => 0,
    'num' => 0,
    'sCount' => 0,
    'item' => 0,
    'res' => 0,
    'item1' => 0,
    'key1' => 0,
    'check_date' => 0,
    'data_type' => 0,
    'table_type' => 0,
    'index' => 0,
    'arr' => 0,
    'key' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57622353ef7d15_34598012',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57622353ef7d15_34598012')) {function content_57622353ef7d15_34598012($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
   
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("存活比例");?>
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
        <div class="live right_nav table_live"></div>
        <div class="live right_nav picture_live active"></div>
        
    </div>
</div>
    <div class="get_day_info_live">
        <div id="_live" style="height: 400px;width:750px;overflow-x: auto;"></div>
        
        <input type="hidden" name="json3" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>

        <script> 
        var chart;
        makeCharts(eval($("input[name=json3]").val()));

 function makeCharts(data){
            

           _live = AmCharts.makeChart("_live", {
               type: "serial",
                dataProvider: data,
                categoryField: "date1",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
               
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
                    //fillColor: "#A83A3A",
                     //labelRotation:"45",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
                },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L("人");?>
)",
                    stackType:"none",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
              //  AxisBase:{
              //  tickLength:1
              //  },
                graphs: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                   <?php if ($_smarty_tpl->tpl_vars['num']->value<$_smarty_tpl->tpl_vars['sCount']->value){?>
                {
                    title: "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    balloonText: "<b><span style='color:#C72C95'>[[title]]</b></span><br><span style='font-size:14px'>[[value]]</b><br/><?php echo L("所占比例");?>
:[[percents]]%</span>",
                    labelPosition: "middle"
                }, <?php }?>
                <?php } ?> 
                {
                  type: "line",
                    title: "<?php echo $_REQUEST['total'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['sCount']->value;?>
",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]] [[value]]</b></span>"
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
        // _live.addListener("clickGraphItem",live_ratio_table);
        <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
          _live.addListener("clickGraphItem",live_ratio_table);
        <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
          function live_ratio_table(obj){
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
                content: "?m=report&a=next_info_histogram&date_type=day&ep_id=<?php echo $_smarty_tpl->tpl_vars['res']->value['ep_id'];?>
&stackType=none&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&start=<?php echo $_smarty_tpl->tpl_vars['res']->value['start'];?>
&end=<?php echo $_smarty_tpl->tpl_vars['res']->value['end'];?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&total=<?php echo $_smarty_tpl->tpl_vars['res']->value['total'];?>
&u="+u
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                content: "?m=report&a=next_info_histogram&date_type=week&ep_id=<?php echo $_smarty_tpl->tpl_vars['res']->value['ep_id'];?>
&stackType=none&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&start=<?php echo $_smarty_tpl->tpl_vars['res']->value['start'];?>
&end=<?php echo $_smarty_tpl->tpl_vars['res']->value['end'];?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&total=<?php echo $_smarty_tpl->tpl_vars['res']->value['total'];?>
&u="+u
            <?php }?>

            });
        }
          <?php }?>
        </script>
<div class="live_ratio_table none">
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
     var tab=$("#freezedivTable3"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
    if($("div.picture_live").attr("class").indexOf("active") > 0){
            $("#_live").removeClass("none");
            $("div.picture_live").addClass("charts_picture_hover");
            $("div.live_ratio_table").addClass("none");
            $("div.table_live").addClass("charts_table");
        }else{
            $("#_live").addClass("none");
            $("div.live_ratio_table").removeClass("none");
            $("div.table_live").addClass("charts_table_hover");
            $("div.picture_live").addClass("charts_picture");
            $("div.picture_live").removeClass("charts_picture_hover");
        }
    $("div.table_live").bind("click",function(){
        $("div.table_live").addClass("charts_table_hover");
        $("div.picture_live").addClass("charts_picture");
        $("div.picture_live").removeClass("charts_picture_hover");
        $("div.live_ratio_table").removeClass("none");
        $("#_live").addClass("none");
        
    });
$("div.picture_live").bind("click",function(){
    $("div.picture_live").addClass("charts_picture_hover");
    $("div.table_live").addClass("charts_table");
    $("div.table_live").removeClass("charts_table_hover");
    $("div.live_ratio_table").addClass("none");
    $("#_live").removeClass("none");
   
    
});
$("div.day_live a").bind("click",function(){
    $("div.day_live a").css("color","#A83A39");
    $("div.week_live a").css("color","#121212");
    $("div.month_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_day_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"<?php echo L("存活用户数");?>
",
                        name2:"<?php echo L("遗失用户数");?>
",
                        name3:"<?php echo L("累计用户数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"<?php echo L("累计用户数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
$("div.week_live a").bind("click",function(){
    $("div.week_live a").css("color","#A83A39");
    $("div.day_live a").css("color","#121212");
    $("div.month_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_week_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"week",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"<?php echo L("存活用户数");?>
",
                        name2:"<?php echo L("遗失用户数");?>
",
                        name3:"<?php echo L("累计用户数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"<?php echo L("累计用户数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
$("div.month_live a").bind("click",function(){
    $("div.month_live a").css("color","#A83A39");
    $("div.day_live a").css("color","#121212");
    $("div.week_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_month_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"<?php echo L("存活用户数");?>
",
                        name2:"<?php echo L("遗失用户数");?>
",
                        name3:"<?php echo L("累计用户数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"<?php echo L("累计用户数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
//$("div.day_live a").css("color","#A83A39");
$("div.live").bind("click",function(){
    $("div.live").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable3" class="base full">
        <tr class='none' style="width:730px;">
                
                <th width="150px"><?php echo L("日期");?>
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
                <th width="150px"><?php echo L("日期");?>
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
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
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
        $("div.day_live a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#_live").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>