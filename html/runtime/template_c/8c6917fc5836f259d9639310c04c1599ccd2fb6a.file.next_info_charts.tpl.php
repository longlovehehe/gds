<?php /* Smarty version Smarty-3.1.11, created on 2016-06-08 14:51:35
         compiled from "..\template\modules\report\next_info_charts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:249385757c0772d0b15-63068559%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c6917fc5836f259d9639310c04c1599ccd2fb6a' => 
    array (
      0 => '..\\template\\modules\\report\\next_info_charts.tpl',
      1 => 1464838518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249385757c0772d0b15-63068559',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'style' => 0,
    'data_type' => 0,
    'index' => 0,
    'json' => 0,
    'change_time' => 0,
    'checktype' => 0,
    'arr_list' => 0,
    'item' => 0,
    'title' => 0,
    'num' => 0,
    'res' => 0,
    'table_type' => 0,
    'item1' => 0,
    'key1' => 0,
    'check_date' => 0,
    'arr' => 0,
    'key' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5757c077ab06e4_50644469',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5757c077ab06e4_50644469')) {function content_5757c077ab06e4_50644469($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo L('');?>
</title>
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
         <script src="script/jquery-1.11.1.min.js"></script>
         <script src="script/jquery.form.js"></script>
         <script src="layer/layer.js"></script>
         <script src="./script/report/amcharts.js"></script>
         <script src="./script/report/serial.js"></script>
         <script src="?m=lang"></script>
         <link  href="style/next_info_charts.css" rel="stylesheet" type="text/css" />
    </head>
    <body style="background-color:#fff;<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"></div>
    <div class="right">
        <div class="<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
 right_nav table<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
"></div>
        <div class="<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
 right_nav picture<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
 active"></div>
    </div>
</div>
    <div class="get_day_info<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
">
        <div id="<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
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
                tickLength:1
                },
                chartScrollbar: {
                autoGridCount:false,
              },
                graphs: [
                <?php if ($_smarty_tpl->tpl_vars['checktype']->value&&$_smarty_tpl->tpl_vars['checktype']->value=='_term_type_data'){?>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                        animationPlayed:true,
                        bullet: "round",
                        bulletSize:4,
                        balloonText: "<b>[[title]]</b>：<b>[[value]]</b>",
                        //labelPosition: "middle"     color:<?php echo $_smarty_tpl->tpl_vars['title']->value['color1'];?>

                    },
                    <?php } ?> 
                <?php }else{ ?>
                    <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                        <?php if ($_smarty_tpl->tpl_vars['num']->value==1){?>
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
                            balloonText: "[[title]]：<b>[[value]]%<br/>活跃用户数:[[param2]]</b>"
                        }, 
                        <?php }?>
                        <?php } ?>
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
                            balloonText: "[[title]]：<b>[[value]]</b>"
                        }, 
                        <?php } ?>
                    <?php }?>
                <?php }?>
                ],
                legend: {
                    useGraphSettings: true
                },
            });
                <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.language = "th";
        }
        //点击进月 周 日
        <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='year'){?>
          <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.addListener("clickGraphItem",<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
);
        <?php }?>
          // var type = 
          <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='year'){?>
        function <?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
(obj){
            // console.log(obj);
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
            parent.layer.open({
                type: 2,
                title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>
                content: '?m=report&a=next_info_charts&date_type=day&ep_id=<?php echo $_smarty_tpl->tpl_vars['res']->value['ep_id'];?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time='+obj.item.dataContext.date+'&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&online_days=<?php echo $_smarty_tpl->tpl_vars['res']->value['online_days'];?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&u='+u
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                content: '?m=report&a=next_info_charts&date_type=week&ep_id=<?php echo $_smarty_tpl->tpl_vars['res']->value['ep_id'];?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time='+obj.item.dataContext.date+'&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&u='+u
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='year'){?>
                content: '?m=report&a=next_info_charts&date_type=month&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time='+obj.item.dataContext.date+'&data_type=<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
&table_type=<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
&ep_id=<?php echo $_smarty_tpl->tpl_vars['res']->value['ep_id'];?>
&index=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
&u='+u
                <?php }?>
            });
        }
        <?php }?>
        </script>
<div class="<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
 none">
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
                
                <th width="150px"></th>
                <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
                <th width="85px"></th>
                <?php }else{ ?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="85px"></th>
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
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
                <?php } ?>
                <?php }?>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['data_type']->value=='_liveness'){?>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <tr>
                <td width="150px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
<?php if ($_REQUEST['date_type']=='week'){?>(<?php echo L("第");?>
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
                <?php if ($_smarty_tpl->tpl_vars['checktype']->value&&$_smarty_tpl->tpl_vars['checktype']->value=='_term_type_data'){?>
                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['arr_list']->value[$_smarty_tpl->tpl_vars['key1']->value]['name']), null, 0);?>
                    <td width="85px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
                <?php }else{ ?>
                    <?php if ($_smarty_tpl->tpl_vars['i']->value=='param1'){?>
                    <td width="85px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
%</td>
                    <?php }?>
                <?php }?>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php }else{ ?>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <tr>
                
                <td width="160px"><?php if ($_REQUEST['date_type']=='week'){?><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
<?php echo L("周");?>
)<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
<?php }?></td>
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
                <?php if ($_smarty_tpl->tpl_vars['checktype']->value&&$_smarty_tpl->tpl_vars['checktype']->value=='_term_type_data'){?>
                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['arr_list']->value[$_smarty_tpl->tpl_vars['key1']->value]['name']), null, 0);?>
                    <td width="85px">
                        <?php if (!isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value])){?>
                            -
                        <?php }else{ ?>
                            <?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>

                        <?php }?>
                    </td>
                <?php }else{ ?>
                    <td width="85px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
                <?php }?>
                <?php } ?>
            </tr>
            <?php } ?>
            <?php }?>

        </table>
        <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
        <?php }?>
    </div>
</div>
<script type="text/javascript">
$(function(){  
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#<?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script>
    </body>
</html><?php }} ?>