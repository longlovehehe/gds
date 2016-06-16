<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:11
         compiled from "..\template\modules\report\gprsdata\gprs_agents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159535762235b091e43-50796553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35b63d3d3ea7f34c740b7fdfbc2e27e2c70356a3' => 
    array (
      0 => '..\\template\\modules\\report\\gprsdata\\gprs_agents.tpl',
      1 => 1464674565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159535762235b091e43-50796553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'json' => 0,
    'change_time' => 0,
    'arr_list' => 0,
    'num' => 0,
    'sCount' => 0,
    'item' => 0,
    'arr' => 0,
    'key1' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762235b3128e1_22323800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762235b3128e1_22323800')) {function content_5762235b3128e1_22323800($_smarty_tpl) {?><style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <hr style="margin:30px 0px 10px 0px;">
    <!-- <div style="margin:20px;">
        <div class="left">
            <input autocomplete="off" style="height:24px;" class="datepickerreport start" name="this_start" type="text"  />
        </div>
        <div class="buttons right">
                <a class=" button gprs_agents" >查询</a>
        </div>
    </div> -->
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("Top渠道");?>
</div>
    <div class="right">
      
        <div class="_gprs_agents right_nav table_gprs_agents"></div>
        <div class="_gprs_agents right_nav picture_gprs_agents active"></div>
    </div>
</div>
    <div class="get_day_info_gprs_agents">
       <div id="_gprs_agents" style="height: 400px;width:750px;overflow-x: auto;"></div>

        
    <input type="hidden" name="json19" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
' />
        <script>
        var _gprs_agents;
        makeCharts_ga(eval($("input[name=json19]").val()));
 function makeCharts_ga(data){
           _gprs_agents = AmCharts.makeChart("_gprs_agents", {
                type: "serial",
                dataProvider: data,
                categoryField: "date",
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
            init:{
                    type:"init", 
                    chart:"AmChart"
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
                    balloonText: "<b><span'>[[title]]</span></b>：<b>[[value]]</b>",
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
          _gprs_agents.addListener("clickGraphItem",gprs_agents_table);
        function gprs_agents_table(obj){
            console.log(obj);
        }
       //  (function () {
       //      $("input.datepickerreport.start").datepicker({
       //          timeFormat: "HH:mm:ss",
       //         dateFormat: "yy-mm-dd"});
       //      $("input.datepickerreport.end").datepicker({
       //          timeFormat: "HH:mm:ss",
       //         dateFormat: "yy-mm-dd"});
       // })();
       $("a.gprs_agents").on("click",function(){
           $.ajax({
               url:'',
               dataType:"html",
               success:function(){
                   makeCharts_ga(eval($("input[name=json19]").val()));
                }
            });
        })
        </script>
<div class="gprs_agents_table none">
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
                 var tab=$("#freezedivTable19"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_gprs_agents").attr("class").indexOf("active") > 0){

                $("#_gprs_agents").removeClass("none");
                $("div.gprs_agents_table").addClass("none");
                $("div.picture_gprs_agents").addClass("charts_picture_hover");
                $("div.table_gprs_agents").addClass("charts_table");
            }else{
                $("#_gprs_agents").addClass("none");
                $("div.gprs_agents_table").removeClass("none");

                $("div.picture_gprs_agents").addClass("charts_picture");
                $("div.table_gprs_agents").addClass("charts_table_hover");
            }
            $("div.table_gprs_agents").bind("click",function(){
                $("div.table_gprs_agents").addClass("charts_table_hover");
                $("div.picture_gprs_agents").addClass("charts_picture");
                $("div.picture_gprs_agents").removeClass("charts_picture_hover");
                $("div.gprs_agents_table").removeClass("none");
                $("#_gprs_agents").addClass("none");
                
                });
            $("div.picture_gprs_agents").bind("click",function(){
                $("div.picture_gprs_agents").addClass("charts_picture_hover");
                $("div.table_gprs_agents").addClass("charts_table");
                $("div.table_gprs_agents").removeClass("charts_table_hover");
                $("div.gprs_agents_table").addClass("none");
                $("#_gprs_agents").removeClass("none");
               

            });
           
            $("div._gprs_agents").bind("click",function(){
                $("div._gprs_agents").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
            
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
                    url:"?m=report&a=get_gprs_agents_data",
                    dataType:"html",
                    data:{
                        u_attr_type:condition
                    },
                    success:function(res){
                        //$("#_gprs_agents_charts").hmtl("");
                        makeCharts_type(eval(res));
                    }
                });
                
            });
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable19" class="base full">
        <tr class='head' style="width:730px;">
            <th width="375px"><?php echo L("代理商");?>
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
            <th width="375px"><?php echo L("代理商");?>
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
            <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</td>
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
    <?php if (empty($_smarty_tpl->tpl_vars['arr']->value)){?>
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
    <?php }?>
    </div>
</div>
<script type="text/javascript">
$(function(){  
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#_gprs_agents").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>