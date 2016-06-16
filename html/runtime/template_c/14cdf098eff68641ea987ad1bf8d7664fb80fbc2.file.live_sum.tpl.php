<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:07
         compiled from "..\template\modules\report\livenessdata\live_sum.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31645576223574ceff7-92724766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14cdf098eff68641ea987ad1bf8d7664fb80fbc2' => 
    array (
      0 => '..\\template\\modules\\report\\livenessdata\\live_sum.tpl',
      1 => 1464838518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31645576223574ceff7-92724766',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'change_time' => 0,
    'res' => 0,
    'json' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'title' => 0,
    'arr' => 0,
    'item' => 0,
    'key' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223577ad6a8_19077434',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223577ad6a8_19077434')) {function content_576223577ad6a8_19077434($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("持续在线人数");?>
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
        <div class="right_nav">&nbsp;&nbsp;</div>
        <div class="_livesum right_nav table_livesum"></div>
        <div class="_livesum right_nav picture_livesum active"></div>
        
    </div>
</div>
<div style="padding-top:12px;"><?php echo L("持续在线");?>

    <input type="hidden" name="date_type" id="date_type" value="<?php echo $_smarty_tpl->tpl_vars['res']->value['date_type'];?>
"/>
        <select name="online_days" id="online_days" style="width: 10%">
            <option value="3">3<?php echo L("天");?>
</option>
            <option value="7">7<?php echo L("天");?>
</option>
            <option value="14">14<?php echo L("天");?>
</option>
            <option value="30">30<?php echo L("天");?>
</option>
        </select><?php echo L("及以上");?>
</div>
    <div class="get_day_info_livesum">
        <div id="_livesum" style="height: 400px;width:760px;overflow-x: auto;"></div>
        
        <input type="hidden" name="json8" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>

        <script> 
        var chart1;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json8]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;

            }
            // column chart
            chart1 = AmCharts.makeChart("_livesum", {
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
                {
                    type: "line",
                    title: "<?php echo L("在线人数");?>
",
                    valueField: "expenses",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"#A83A3A",
                    bullet: "round",
                    bulletSize:4,
                    animationPlayed:true,
                    balloonText: "[[title]]:<b>[[value]]</b>"
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
                         chart1.language = "th";

        }
        chart1.addListener("clickGraphItem",live_sum_table);
        /**
         * 点击事件显示详细信息
         */
        function live_sum_table(obj){
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
<div class="live_sum_table none">
   <script type="text/javascript"> 
   // alert($("#online_days").val());
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
     var tab=$("#freezedivTable8"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_livesum").attr("class").indexOf("active") > 0){
            $("#_livesum").removeClass("none");
            $("div.picture_livesum").addClass("charts_picture_hover");
            $("div.live_sum_table").addClass("none");
            $("div.table_livesum").addClass("charts_table");
        }else{
            $("#_livesum").addClass("none");
            $("div.live_sum_table").removeClass("none");
            $("div.table_livesum").addClass("charts_table_hover");
            $("div.picture_livesum").addClass("charts_picture");
        }
    $("div.table_livesum").bind("click",function(){
        $("div.table_livesum").addClass("charts_table_hover");
        $("div.picture_livesum").addClass("charts_picture");
        $("div.picture_livesum").removeClass("charts_picture_hover");
        $("div.live_sum_table").removeClass("none");
        $("#_livesum").addClass("none");
    });
$("div.picture_livesum").bind("click",function(){
    $("div.picture_livesum").addClass("charts_picture_hover");
    $("div.table_livesum").addClass("charts_table");
    $("div.table_livesum").removeClass("charts_table_hover");
    $("div.live_sum_table").addClass("none");
    $("#_livesum").removeClass("none");
});
$("select#online_days").bind("change", function () {
    var type = $("#date_type").val();
    if(type == 'month')
    {
        get_month();
    }
    else if(type == 'week')
    {
        get_week();
    }
    else
    {
        get_day();
    }
    
});
$("div.day_livesum a").bind("click",function(){
    get_day();
});
$("div.week_livesum a").bind("click",function(){
    get_week();
});
$("div.month_livesum a").bind("click",function(){
    get_month();
});
function get_week()
{
    $("#date_type").val('week');
    $("div.week_livesum a").css("color","#A83A39");
    $("div.day_livesum a").css("color","#121212");
    $("div.month_livesum a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_livesum",
            table_type:"live_sum_table",
            online_days:$("#online_days").val(),
            title:{
                    name1:"<?php echo L("在线人数");?>
",
                    color1:'#A83A3A'
                },
            index:"8",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_livesum").html(res);
            }
        });
}
function get_month()
{
    $("#date_type").val('month');
    $("div.month_livesum a").css("color","#A83A39");
    $("div.day_livesum a").css("color","#121212");
    $("div.week_livesum a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_livesum",
            table_type:"live_sum_table",
            online_days:$("#online_days").val(),
            title:{
                    name1:"<?php echo L("在线人数");?>
",
                    color1:'#A83A3A'
                },
            index:"8",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_livesum").html(res);
            }
        });
}
function get_day()
{
    $("#date_type").val('day');
    $("div.day_livesum a").css("color","#A83A39");
    $("div.week_livesum a").css("color","#121212");
    $("div.month_livesum a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_livesum",
            table_type:"live_sum_table",
            online_days:$("#online_days").val(),
            title:{
                    name1:"<?php echo L("在线人数");?>
",
                    color1:'#A83A3A'
                },
            index:"8",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_livesum").html(res);
            }
        });
}
//$("div.day_livesum a").css("color","#A83A39");
$("div._livesum").bind("click",function(){
    $("div._livesum").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable8" class="base full">
        <tr class='none' style="width:730px;">
            
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px;"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
        </tr>
        <tr  class='head'>
            <th width="375px"><?php echo L("日期");?>
</th>
            <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo L($_tmp2);?>
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
            <td width="85px"><?php echo $_smarty_tpl->tpl_vars['item']->value['expenses'];?>
</td>
           
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
        $("div.day_livesum a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['list']->value){?>
        $("#_livesum").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>