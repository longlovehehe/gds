<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:03
         compiled from "..\template\modules\report\opendata\commercial_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1696757622353500e32-46988610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9e58e564dbf2556aced07ae76aa3519737fe0dc' => 
    array (
      0 => '..\\template\\modules\\report\\opendata\\commercial_users.tpl',
      1 => 1465381067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1696757622353500e32-46988610',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sum' => 0,
    'change_time' => 0,
    'json' => 0,
    'arr_list' => 0,
    'item' => 0,
    'num' => 0,
    'res' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'arr' => 0,
    'key' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576223538e50a5_49300405',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576223538e50a5_49300405')) {function content_576223538e50a5_49300405($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("新增用户");?>
:<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
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
        <div class="commercial right_nav table_commercial"></div>
        <div class="commercial right_nav picture_commercial active"></div>
        
    </div>
</div>
    <div class="get_day_info_commercial">
        <div id="_commercial" style="height: 400px;width:755px;overflow-x: auto;"></div>
        
        <input type="hidden" name="json2" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>

        <script> 
        var _commercial;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json2]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;

            }
            // column chart
            _commercial = AmCharts.makeChart("_commercial", {
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
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                {
                    type: "line",
                    title: "<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    bullet: "round",
                    bulletSize:4,
                    animationPlayed:true,
                    balloonText: "[[title]]:<b>[[value]]</b>"
                },
                <?php } ?> 
                ],
                legend: {
                     position:"top",

                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    valueText:"",
                    switchType:"v",
                },
            });
                         _commercial.language = "th";

        }
        _commercial.addListener("clickGraphItem",commercial_users_table);
        /**
         * 点击事件显示详细信息
         */
        function commercial_users_table(obj){
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
<div class="commercial_users_table none">
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
     var tab=$("#freezedivTable2"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_commercial").attr("class").indexOf("active") > 0){
            $("#_commercial").removeClass("none");
            $("div.picture_commercial").addClass("charts_picture_hover");
            $("div.commercial_users_table").addClass("none");
            $("div.table_commercial").addClass("charts_table");
        }else{
            $("#_commercial").addClass("none");
            $("div.commercial_users_table").removeClass("none");
            $("div.table_commercial").addClass("charts_table_hover");
            $("div.picture_commercial").addClass("charts_picture");
        }
    $("div.table_commercial").bind("click",function(){
        $("div.table_commercial").addClass("charts_table_hover");
        $("div.picture_commercial").addClass("charts_picture");
        $("div.picture_commercial").removeClass("charts_picture_hover");
        $("div.commercial_users_table").removeClass("none");
        $("#_commercial").addClass("none");
    });
$("div.picture_commercial").bind("click",function(){
    $("div.picture_commercial").addClass("charts_picture_hover");
    $("div.table_commercial").addClass("charts_table");
    $("div.table_commercial").removeClass("charts_table_hover");
    $("div.commercial_users_table").addClass("none");
    $("#_commercial").removeClass("none");
});
$("div.day_commercial a").bind("click",function(){
    $("div.day_commercial  a").css("color","#A83A39");
    $("div.week_commercial a").css("color","#121212");
    $("div.month_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"<?php echo L("新增用户");?>
",
                        name2:"<?php echo L("删除用户");?>
",
                        name3:"<?php echo L("净增长");?>
",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});
$("div.week_commercial a").bind("click",function(){
    $("div.week_commercial a").css("color","#A83A39");
    $("div.day_commercial a").css("color","#121212");
    $("div.month_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"<?php echo L("新增用户");?>
",
                        name2:"<?php echo L("删除用户");?>
",
                        name3:"<?php echo L("净增长");?>
",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});
$("div.month_commercial").bind("click",function(){
    $("div.month_commercial a").css("color","#A83A39");
    $("div.day_commercial a").css("color","#121212");
    $("div.week_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"<?php echo L("新增用户");?>
",
                        name2:"<?php echo L("删除用户");?>
",
                        name3:"<?php echo L("净增长");?>
",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});

//$("div.day_commercial a").css("color","#A83A39");
$("div.commercial").bind("click",function(){
    $("div.commercial").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable2" class="base full">
        <tr class='none' style="width:730px;">
            
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
        <tr  class='head'>
            <th width="150px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp3=ob_get_clean();?><?php echo L($_tmp3);?>
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
        $("div.day_commercial a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#_commercial").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script>    <?php }} ?>