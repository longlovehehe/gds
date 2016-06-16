<?php /* Smarty version Smarty-3.1.11, created on 2016-06-02 11:36:19
         compiled from "..\template\modules\report\get_histogram_month.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9475574fa9b336aa94-33980205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f81a42de277565f953ed9348145751f11c33016b' => 
    array (
      0 => '..\\template\\modules\\report\\get_histogram_month.tpl',
      1 => 1464838518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9475574fa9b336aa94-33980205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_type' => 0,
    'index' => 0,
    'json' => 0,
    'change_time' => 0,
    'res' => 0,
    'arr_list' => 0,
    'num' => 0,
    'sCount' => 0,
    'item' => 0,
    'table_type' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'arr' => 0,
    'key' => 0,
    'i' => 0,
    'json_type' => 0,
    'type_arr' => 0,
    'type_list' => 0,
    'title' => 0,
    'date_type' => 0,
    'check_date' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574fa9b38cda51_65831336',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574fa9b38cda51_65831336')) {function content_574fa9b38cda51_65831336($_smarty_tpl) {?>    <div id="<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
" style="height: 400px;width:750px;overflow-x: auto;"></div>
        
    <input type="hidden" name="json<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
;
        makeCharts(eval($("input[name=json<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
]").val()));

 function makeCharts(data){
            

           <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
 = AmCharts.makeChart("<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
", {
               type: "serial",
                dataProvider: data,
                categoryField: "date1",
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
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
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    stackType:"<?php echo $_smarty_tpl->tpl_vars['res']->value['stackType'];?>
",
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
                    lineColor: "<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    animationPlayed:true,
                    balloonText: "<b>[[title]]</b>：<b>[[value]]</b>",
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
             <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.addListener("clickGraphItem",<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
);
   
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
&time="+obj.item.dataContext.date+"&u="+u
            });
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

                $("div.picture").addClass("charts_picture");
                $("div.table").addClass("charts_table_hover");
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
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_term_type'){?>
                    //终端类型的列表、图的切换
                    $("#_term_type_data_table").show();
                    $("#choose").hide();
                    $("#_term_type_charts").hide();
                <?php }?>
                
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
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_term_type'){?>
                    //终端类型的列表、图的切换
                    $("#_term_type_data_table").hide();
                    $("#choose").show();
                    $("#_term_type_charts").show();
                <?php }?>
            });
         
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" class="base full">
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
                
                <td width="150px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
<?php echo L("月");?>
)</td>
                <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['key1']->value), null, 0);?>
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
<?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_term_type'){?>
    <div style="margin-left:63px;" id="choose">
    <input type="hidden" name="json_mdt16" value='<?php echo $_smarty_tpl->tpl_vars['json_type']->value;?>
' />
        <div class="piaochecked background-com on_check">
            <input name="commercial" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
        </div>
        <div class="checked"><?php echo L("商用");?>
</div>
        <div class="piaochecked background-test on_check" style="margin-left:12px">
            <input name="test" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
        </div>
        <div class="checked"><?php echo L("测试");?>
</div>
    </div>
    <div id="_term_type_charts" style="height: 400px;width:750px;overflow-x: auto;"></div>

    <!-- 终端类型 106ZW 120WZ table... -->
    <div class="freezediv" id="_term_type_data_table" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;display: none;">
        <table  id="freezedivTable16" class="base full">
            <tr class='head' style="width:730px;">
                <th width="375px"><?php echo L("日期");?>
</th>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp3=ob_get_clean();?><?php echo L($_tmp3);?>
</th>
                <?php } ?>

            </tr>
           <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['type_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['create_time'];?>
</td>
                <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['type_arr']->value[$_smarty_tpl->tpl_vars['key1']->value]['name'], null, 0);?>
                <td width="85px">
                    <?php if (!isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value])){?>
                    -
                    <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>

                    <?php }?>
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        <?php if (!$_smarty_tpl->tpl_vars['type_list']->value){?>
            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
        <?php }?>
    </div>
<script type="text/javascript">
    var _term_type_charts;
    $("input[type=checkbox]").attr("checked","checked");
    makeCharts_term(eval($("input[name=json_mdt16]").val()));
        function makeCharts_term(data){
           _term_type_charts = AmCharts.makeChart("_term_type_charts", {
                type: "serial",
                dataProvider: data,
                categoryField: "date1",
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
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
                    gridPosition: "start",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                    {
                    title: "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    type: "line",
                     lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    //lineColor: "<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<b><span style=''>[[title]]</b></span><span>：<b>[[value]]</b></span>",
                    //labelPosition: "middle"     color:<?php echo $_smarty_tpl->tpl_vars['title']->value['color1'];?>

                },
                <?php } ?> 
                ],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }

            


              //选择商用和测试
            var condition='com&test';
            $("input[type=checkbox]").on("click",function(){
                var date_type = "<?php echo $_smarty_tpl->tpl_vars['res']->value['date_type'];?>
";
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
                    url:"?m=report&a=get_term_type_data",
                    dataType:"json",
                    data:{
                        u_attr_type:condition,
                        date_type:"<?php echo $_smarty_tpl->tpl_vars['date_type']->value;?>
",
                        checktermdata:"checktermdata",
                        start:$("input[name=start]").val(),
                        end:$("input[name=end]").val(),
                        ep_id:$("input[name=ep_id]").val()
                    },
                    success:function(res){
                        //$("#_term_type_charts").hmtl("");
                        makeCharts_term(res);
                        if(date_type!='day'){
                            _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
                        }
                    }
                });
                
            });

        //终端类型的年 月 周 日 切换
        <?php if ($_smarty_tpl->tpl_vars['check_date']->value!='day'){?>
        _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
        <?php }?>

        function term_type_charts_table(obj){
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
                content: "?m=report&a=next_info_charts&date_type=<?php echo $_smarty_tpl->tpl_vars['change_time']->value['check_date'];?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&data_type=_term_type_data&table_type=term_type_data_table&index=666&ep_id="+ep_id+"&stackType=none&total=total&time="+obj.item.dataContext.date
            });
        }
        
        $("input[name=commercial]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-com");
                }else{
                    $(this).parent().removeClass("background-com");
                     $(this).parent().addClass("background-none");
                }
        });
        
        $("input[name=test]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-test");
                }else{
                    $(this).parent().removeClass("background-test");
                     $(this).parent().addClass("background-none");
                }
        });
</script>
<?php }?>
<script type="text/javascript">
$(function(){  
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>