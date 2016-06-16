<?php /* Smarty version Smarty-3.1.11, created on 2016-05-27 18:08:57
         compiled from "..\template\modules\report\get_charts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2105257481cb901bb66-60042640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02cc46b14201bd819ed67b6f6aa31f77db29af99' => 
    array (
      0 => '..\\template\\modules\\report\\get_charts.tpl',
      1 => 1463480138,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2105257481cb901bb66-60042640',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_type' => 0,
    'index' => 0,
    'json' => 0,
    'change_time' => 0,
    'arr_list' => 0,
    'item' => 0,
    'num' => 0,
    'table_type' => 0,
    'list' => 0,
    'arr' => 0,
    'key1' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57481cb93f80d4_37142317',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57481cb93f80d4_37142317')) {function content_57481cb93f80d4_37142317($_smarty_tpl) {?>    <div id="<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
" style="height: 400px;width:750px;overflow-x: auto;"></div>
        
    <input type="hidden" name="json<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
;
        var chart2;
        //var data=$("input[name=json]").val();

        makeCharts("light", "#E5E5E5",eval($("input[name=json<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
]").val()));

        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;

            }
            // column chart
            <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
 = AmCharts.makeChart("<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
", {
                type: "serial",
                theme:theme,
                dataProvider: data,//折线数据
                categoryField: "date",
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
                    <?php if ($_REQUEST['unit']==1){?>
                    unit:"%",
                    <?php }?>
                }],
                AxisBase:{
                tickLength:1
                },
                chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
                {
                    type: "line",
                    title: "<?php echo L("活跃度");?>
",
                    valueField: "expenses",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"#A83A3A",
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "[[title]]:<b>[[value]]<br/>活跃用户数:[[num]]</b>"
                }
                <?php }else{ ?>
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
                <?php }?>
                ],
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
                         <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.language = "th";
        }
          <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.addListener("clickGraphItem",<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
);
        function <?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
(obj){
            console.log(obj);
        }
        </script>
<div class="<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
 none">
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
                 var tab=$("#freezedivTable<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").attr("class").indexOf("active") > 0){

                $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").removeClass("none");
                $("div.<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
").addClass("none");
                $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_picture_hover");
                $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_table");
            }else{
                $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("none");
                $("div.<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
").removeClass("none");

                $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_picture");
                $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_table_hover");
            }
            $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").bind("click",function(){
                $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_table_hover");
                $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_picture");
                $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").removeClass("charts_picture_hover");
                $("div.<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
").removeClass("none");
                $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("none");
                });
            $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").bind("click",function(){
                $("div.picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_picture_hover");
                $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").addClass("charts_table");
                $("div.table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").removeClass("charts_table_hover");
                $("div.<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
").addClass("none");
                $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").removeClass("none");
            });
            $("div.<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").bind("click",function(){
                $("div.<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="base full">
            <tr class='none' style="width:730px;">
                
                <th width="150px"><?php echo L("日期");?>
</th>
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
                <th width="85px"><?php echo L("活跃度");?>
</th>
                <?php }else{ ?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
                <?php } ?>
                <?php }?>
                
            </tr>
            <tr  class='head'>
                <th width="150px"><?php echo L("日期");?>
</th>
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
                <th width="85px"><?php echo L("活跃度");?>
</th>
                <?php }else{ ?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp2=ob_get_clean();?><?php echo L($_tmp2);?>
</th>
                <?php } ?>
                <?php }?>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr>
                
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['create_time'];?>
</td>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_active_rate'];?>
%</td>
            </tr>
            <?php } ?>
            <?php }else{ ?>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr>
                
                <td width="150px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</td>
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
            <?php }?>
        </table>
        <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【暂无数据】</div>
        <?php }?>
    </div>
</div>
<script type="text/javascript">
$(function(){  
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【暂无数据】</div>');
    <?php }?>
}); 
</script><?php }} ?>