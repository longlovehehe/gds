<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:15
         compiled from "..\template\modules\report\terminaldata\term_agents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242775762235f73dea4-84984264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dcb025362875b17e36250af0ad899dce122d9e5' => 
    array (
      0 => '..\\template\\modules\\report\\terminaldata\\term_agents.tpl',
      1 => 1464674565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242775762235f73dea4-84984264',
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
    'karr' => 0,
    'key1' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762235f970722_74910273',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762235f970722_74910273')) {function content_5762235f970722_74910273($_smarty_tpl) {?><style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
            /*.ui-datepicker-calendar { 
            display: none; 
            }*/ 
    </style>
    <div style="margin:20px;">
        <!-- <div class="left" id="datepickerterm">
            年:<input autocomplete="off" style="height:24px;" class="datepickerterm year" name="year" type="text"  />
            月:<input autocomplete="off" style="height:24px;" class="datepickerterm month" name="month" type="text"  />
        </div>
        <div class="buttons right">
                <a class=" button term_agents" >查询</a>
        </div> -->
    </div>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("Top渠道");?>
</div>
    <div class="right">
      
        <div class="_term_agents right_nav table_term_agents"></div>
        <div class="_term_agents right_nav picture_term_agents active"></div>
    </div>
</div>
    <div class="get_day_info_term_agents">
       <div id="_term_agents" style="height: 400px;width:750px;overflow-x: auto;"></div>

        
    <input type="hidden" name="json17" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
' />
        <script>
        var _term_agents;
        makeCharts_ta(eval($("input[name=json17]").val()));
 function makeCharts_ta(data){
           _term_agents = AmCharts.makeChart("_term_agents", {
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
                    lineColor:"#B0DE09",
                    bullet: "round",
                    animationPlayed:true,
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
          _term_agents.addListener("clickGraphItem",term_agents_table);
        function term_agents_table(obj){
            console.log(obj);
        }
        (function () { 
                $('input.datepickerterm.year').datepicker({
                        //changeMonth: true,
                        changeYear: true,
                        dateFormat: 'MM yy',
                        showButtonPanel: false,
                    onClose: function(dateText, inst) {
                        //var month = $("#ui-datepicker-div .ui-datepicker-month option:selected").val();//得到选中的月份值
                        var year = $("#ui-datepicker-div .ui-datepicker-year option:selected").val();//得到选中的年份值
                        $('input.datepickerterm.year').val(year);//给input赋值，其中要对月值加1才是实际的月份
                    }
                });
                
                $('input.datepickerterm.month').datepicker({
                        changeMonth: true,
                        //changeYear: true,
                        Year: false,
                        dateFormat: 'MM yy',
                        showButtonPanel: false,
                    onClose: function(dateText, inst) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month option:selected").val();//得到选中的月份值
                        //var year = $("#ui-datepicker-div .ui-datepicker-year option:selected").val();//得到选中的年份值
                        $('input.datepickerterm.month').val((parseInt(month)+1));//给input赋值，其中要对月值加1才是实际的月份
                    }
                });
          
            // $("input.datepickerreport.end").datepicker({
            //     timeFormat: "HH:mm:ss",
            //    dateFormat: "yy-mm-dd"});
       })();
       $("a.term_agents").on("click",function(){
           $.ajax({
                url:'?m=report&a=get_term_agents',
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"month",
                    data_type:"_term_type",
                    table_type:"term_type_table",
                    index:"16",
                    this_start:$("input[name=this_start]").val(),
                    end:$("input[name=end]").val()
                },
               success:function(){
                   makeCharts_ta(eval($("input[name=json17]").val()));
                }
            });
        })
        </script>
<div class="term_agents_table none">
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
                 var tab=$("#freezedivTable17"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_term_agents").attr("class").indexOf("active") > 0){

                $("#_term_agents").removeClass("none");
                $("div.term_agents_table").addClass("none");
                $("div.picture_term_agents").addClass("charts_picture_hover");
                $("div.table_term_agents").addClass("charts_table");
            }else{
                $("#_term_agents").addClass("none");
                $("div.term_agents_table").removeClass("none");
                $("div.picture_term_agents").addClass("charts_picture");
                $("div.table_term_agents").addClass("charts_table_hover");
            }
            $("div.table_term_agents").bind("click",function(){
                $("div.table_term_agents").addClass("charts_table_hover");
                $("div.picture_term_agents").addClass("charts_picture");
                $("div.picture_term_agents").removeClass("charts_picture_hover");
                $("div.term_agents_table").removeClass("none");
                $("#_term_agents").addClass("none");
                
                });
            $("div.picture_term_agents").bind("click",function(){
                $("div.picture_term_agents").addClass("charts_picture_hover");
                $("div.table_term_agents").addClass("charts_table");
                $("div.table_term_agents").removeClass("charts_table_hover");
                $("div.term_agents_table").addClass("none");
                $("#_term_agents").removeClass("none");
               

            });
           
            $("div._term_agents").bind("click",function(){
                $("div._term_agents").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
            
  
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable17" class="base full">
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
 $_from = $_smarty_tpl->tpl_vars['karr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
    <?php if (!$_smarty_tpl->tpl_vars['karr']->value){?>
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
        $("div.day_livenum a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['karr']->value){?>
        $("#_term_agents").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script> <?php }} ?>