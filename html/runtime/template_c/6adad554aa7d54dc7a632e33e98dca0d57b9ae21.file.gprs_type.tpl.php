<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:10
         compiled from "..\template\modules\report\gprsdata\gprs_type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:298875762235aa7ce04-77743519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6adad554aa7d54dc7a632e33e98dca0d57b9ae21' => 
    array (
      0 => '..\\template\\modules\\report\\gprsdata\\gprs_type.tpl',
      1 => 1465368601,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298875762235aa7ce04-77743519',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total' => 0,
    'com_gprs' => 0,
    'change_time' => 0,
    'json' => 0,
    'res' => 0,
    'arr_list' => 0,
    'num' => 0,
    'sCount' => 0,
    'item' => 0,
    'data_type' => 0,
    'table_type' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'check_date' => 0,
    'arr' => 0,
    'k' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762235af0ce98_86489494',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762235af0ce98_86489494')) {function content_5762235af0ce98_86489494($_smarty_tpl) {?><style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("累计流量卡数量");?>
：<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
&nbsp;|&nbsp;<?php echo L("累计商用流量卡数量");?>
：<?php echo $_smarty_tpl->tpl_vars['com_gprs']->value;?>
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
        <div class="_gprs_type right_nav table_gprs_type"></div>
        <div class="_gprs_type right_nav picture_gprs_type active"></div>
    </div>
</div>
    <div class="get_day_info_gprs_type">
       <div id="_gprs_type" style="height: 400px;width:750px;overflow-x: auto;"></div>
       

        
    <input type="hidden" name="json18" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
' />
    <input type="hidden" name="json_mdt18" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
' />
        <script>
            $("input[type=checkbox]").attr("checked","checked");
        var _gprs_type;
        var _gprs_type_charts;
        makeCharts(eval($("input[name=json18]").val()));
 function makeCharts(data){
           _gprs_type = AmCharts.makeChart("_gprs_type", {
                type: "serial",
                dataProvider: data,
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                categoryField: "date1",
                <?php }else{ ?>
                categoryField: "date",
                <?php }?>
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
                
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
        chartScrollbar: {
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
                    /*balloonText: "<b><span style='color:<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",*/
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                }, 
                <?php }?>
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
                    animationPlayed:true,
                    lineColor:"#B0DE09",
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]]：<b>[[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:""
                },
            });
            }
          //切换月->周 
          <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']!='day'){?>
            <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.addListener("clickGraphItem",<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
);
          <?php }?>
   
            function <?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
(obj){
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
                 // var time=obj.item.dataContext.month.split("~");
                //layer.alert(obj.item.dataContext.week);
                layer.open({
                    type: 2,
                    title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                    area: ['800px', '500px'],
                    fix: false, //不固定
                    maxmin: false,
                    content: "?<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&u="+u
                });
            }


              //选择商用和测试
            var condition;
            $("input[type=checkbox]").on("click",function(){
                if($("input[name=commercial]").is(":checked")&&$("input[name=test]").is(":checked")){
                    condition="com&test";
                    //$("input[name=commercial]").val("comm");
                }else if($("input[name=commercial]").is(":checked")){
                        condition="com";
                }else if($("input[name=test]").is(":checked")){
                        condition="test";
                }else{
                        condition="none";
                }
                $.ajax({
                    url:"?m=report&a=get_gprs_type_data",
                    dataType:"json",
                    data:{
                        u_attr_type:condition,
                        date_type:'month'
                    },
                    success:function(res){
                        //$("#_gprs_type_charts").hmtl("");
                        makeCharts_term(res);
                    }
                });
                
            });
           
        </script>
<div class="gprs_type_table none">
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
                 var tab=$("#freezedivTable18"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_gprs_type").attr("class").indexOf("active") > 0){

                $("#_gprs_type").removeClass("none");
                $("div.gprs_type_table").addClass("none");
                $("div.picture_gprs_type").addClass("charts_picture_hover");
                $("div.table_gprs_type").addClass("charts_table");
            }else{
                $("#_gprs_type").addClass("none");
                $("div.gprs_type_table").removeClass("none");

                $("div.picture_gprs_type").addClass("charts_table_hover");
                $("div.table_gprs_type").addClass("charts_picture");
            }
            $("div.table_gprs_type").bind("click",function(){
                $("div.table_gprs_type").addClass("charts_table_hover");
                $("div.picture_gprs_type").addClass("charts_picture");
                $("div.picture_gprs_type").removeClass("charts_picture_hover");
                $("div.gprs_type_table").removeClass("none");
                $("#_gprs_type").addClass("none");
                
                });
            $("div.picture_gprs_type").bind("click",function(){
                $("div.picture_gprs_type").addClass("charts_picture_hover");
                $("div.table_gprs_type").addClass("charts_table");
                $("div.table_gprs_type").removeClass("charts_table_hover");
                $("div.gprs_type_table").addClass("none");
                $("#_gprs_type").removeClass("none");
               

            });
$("div.day_gprs_type a").bind("click",function(){
    $("div.day_gprs_type a").css("color","#A83A39");
    $("div.week_gprs_type a").css("color","#121212");
    $("div.month_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_day_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"<?php echo L("商用");?>
",
                        name2:"<?php echo L("测试");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L("总数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
$("div.week_gprs_type a").bind("click",function(){
    $("div.week_gprs_type a").css("color","#A83A39");
    $("div.day_gprs_type a").css("color","#121212");
    $("div.month_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_week_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"week",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"<?php echo L("商用");?>
",
                        name2:"<?php echo L("测试");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L("总数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
$("div.month_gprs_type a").bind("click",function(){
    $("div.month_gprs_type a").css("color","#A83A39");
    $("div.day_gprs_type a").css("color","#121212");
    $("div.week_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_month_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"<?php echo L("商用");?>
",
                        name2:"<?php echo L("测试");?>
",
                        name3:"<?php echo L("总数");?>
",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"<?php echo L("总数");?>
",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
            $("div._gprs_type").bind("click",function(){
                $("div._gprs_type").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });

    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable18" class="base full">
        <tr class='head' style="width:730px;">
            <th width="375px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
            <?php } ?>

        </tr>
        <tr  class='head'>
            <th width="375px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp2=ob_get_clean();?><?php echo L($_tmp2);?>
</th>
            <?php } ?>
        </tr>
       <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>
            <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("周");?>
)</td>
            <?php }elseif($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
            <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("月");?>
)</td>
            <?php }else{ ?>
            <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</td>
            <?php }?>
            <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['key1']->value), null, 0);?>
            <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
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
<script type="text/javascript">
$(function(){ 
    var checked = "<?php echo $_smarty_tpl->tpl_vars['change_time']->value['checked'];?>
";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_gprs_type a").css("color","#A83A39");
    }
     
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#_gprs_type").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>