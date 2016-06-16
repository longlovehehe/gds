<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:28
         compiled from "..\template\modules\report\pies\topamp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:274445762236cea38d3-61682123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba6186946349e0b3d5cbf713cb7501afb6d95f4f' => 
    array (
      0 => '..\\template\\modules\\report\\pies\\topamp.tpl',
      1 => 1464674565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '274445762236cea38d3-61682123',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list1' => 0,
    'item' => 0,
    'total1' => 0,
    'list2' => 0,
    'total2' => 0,
    'list3' => 0,
    'total3' => 0,
    'json' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236d38bc53_59068967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236d38bc53_59068967')) {function content_5762236d38bc53_59068967($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("Top渠道");?>
</div>
    <div class="right">
        <div class="_topamp right_nav card_topamp"><a href="javascript:void(0);"><?php echo L("商用卡");?>
</a></div>
        <div class="_topamp right_nav table_topamp"><a href="javascript:void(0);"><?php echo L("商用终端");?>
</a></div>
        <div class="_topamp right_nav picture_topamp active"><a href="javascript:void(0);"><?php echo L("商用用户");?>
</a></div>
    </div>
</div>
    <div class="get_day_info_topamp">
        <div id="_topamp" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
        <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable" class="base full">
                            <tr class='none' style="width:400px;">
                                <th width="365px"><?php echo L("商用用户名称");?>
</th>
                                <th width="365px;"><?php echo L("个数");?>
</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px"><?php echo L("商用用户名称");?>
</th>
                                <th width="375px"><?php echo L("个数");?>
</th>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
;border:1px solid <?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
"></div>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</td>
                            </tr>
                            <?php } ?>
                            
                            <tr>
                                <td width="750px" colspan='2'align="center"><?php echo L("总计");?>
:<?php echo $_smarty_tpl->tpl_vars['total1']->value;?>
<?php echo L("个");?>
</td>
                            </tr>
                            
                        </table>
                        <?php if (!$_smarty_tpl->tpl_vars['list1']->value){?>
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
                        <?php }?>
                </div>
        </div>
        <div id="_topamp_attr" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
                <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable1" class="base full">
                            <tr class='head' style="width:400px;">
                                <th width="365px"><?php echo L("商用用户名称");?>
</th>
                                <th width="365px;"><?php echo L("个数");?>
</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px"><?php echo L("商用用户名称");?>
</th>
                                <th width="375px"><?php echo L("个数");?>
</th>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
;border:1px solid <?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
"></div>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td width="750px" colspan='2' align="center"><?php echo L("总计");?>
:<?php echo $_smarty_tpl->tpl_vars['total2']->value;?>
<?php echo L("个");?>
</td>
                            </tr>
                            
                        </table>
                        <?php if (!$_smarty_tpl->tpl_vars['list2']->value){?>
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
                        <?php }?>
                </div>
        </div>
        <div id="_topamp_card" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
                <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable2" class="base full">
                            <tr class='head' style="width:400px;">
                                <th width="365px"><?php echo L("商用用户名称");?>
</th>
                                <th width="365px;"><?php echo L("个数");?>
</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px"><?php echo L("商用用户名称");?>
</th>
                                <th width="375px"><?php echo L("个数");?>
</th>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
;border:1px solid <?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
"></div>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</td>
                            </tr>
                            <?php } ?>
                            
                            <tr>
                                <td width="750px" colspan='2' align="center"><?php echo L("总计");?>
:<?php echo $_smarty_tpl->tpl_vars['total3']->value;?>
<?php echo L("个");?>
</td>
                            </tr>
                            
                        </table>
                        <?php if (!$_smarty_tpl->tpl_vars['list3']->value){?>
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
                        <?php }?>
                </div>
        </div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
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
                 var tab=$("#freezedivTable");
                 var tab1=$("#freezedivTable1");
                 var tab2=$("#freezedivTable2");
                 if(tab){
                        fixupFirstRow(tab); 
                  }
                  if(tab1){
                        fixupFirstRow(tab1); 
                 }
                 if(tab2){
                        fixupFirstRow(tab2); 
                 }
                });
        var _topamp;
        var _topamp_attr;
        var _topamp_card;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _topamp = AmCharts.makeChart("_topamp", {
                type: "pie",
                theme: theme,
                dataProvider: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                {
                    "country": "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    "litres": "<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
"
                }, 
                <?php } ?>
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
            _topamp_attr = AmCharts.makeChart("_topamp_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                {
                    "country": "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    "litres": "<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
"
                }, 
                <?php } ?>
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
           _topamp_card = AmCharts.makeChart("_topamp_card", {
                type: "pie",
                theme: theme,
                dataProvider: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                {
                    "country": "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    "litres": "<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
"
                }, 
                <?php } ?>
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
            
        }
        _topamp.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_topamp").attr("class").indexOf("active") > 0){
            $("#_topamp").removeClass("none");
            $("#_topamp").next().removeClass("none");
            $("#_topamp_attr").addClass("none");
            $("#_topamp_attr").next().addClass("none");
            $("#_topamp_card").addClass("none");
            $("#_topamp_card").next().addClass("none");
        }else if($("div.table_topamp").attr("class").indexOf("active") > 0){
            $("#_topamp").addClass("none");
            $("#_topamp").next().addClass("none");
            $("#_topamp_card").addClass("none");
            $("#_topamp_card").next().addClass("none");
            $("#_topamp_attr").removeClass("none");
            $("#_topamp_attr").next().removeClass("none");
        }else{
            $("#_topamp").addClass("none");
            $("#_topamp").next().addClass("none");
            $("#_topamp_attr").addClass("none");
            $("#_topamp_attr").next().addClass("none");
            $("#_topamp_card").removeClass("none");
            $("#_topamp_card").next().removeClass("none");
    }
    $("div.table_topamp").bind("click",function(){
    $("#_topamp_attr").removeClass("none");
    $("#_topamp_attr").next().removeClass("none");
    $("#_topamp").addClass("none");
    $("#_topamp").next().addClass("none");
    $("#_topamp_card").addClass("none");
    $("#_topamp_card").next().addClass("none");
    });
$("div.picture_topamp").bind("click",function(){
    $("#_topamp_attr").addClass("none");
    $("#_topamp_attr").next().addClass("none");
    $("#_topamp").removeClass("none");
    $("#_topamp").next().removeClass("none");
    $("#_topamp_card").addClass("none");
    $("#_topamp_card").next().addClass("none"); 
});
$("div.card_topamp").bind("click",function(){
    $("#_topamp_attr").addClass("none");
    $("#_topamp_attr").next().addClass("none");
    $("#_topamp_card").removeClass("none");
    $("#_topamp_card").next().removeClass("none");
    $("#_topamp").addClass("none");
    $("#_topamp").next().addClass("none"); 
});

$("div._topamp").bind("click",function(){
    $("div._topamp").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    <?php if (!$_smarty_tpl->tpl_vars['list1']->value){?>
        $("#_topamp").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['list2']->value){?>
        $("#_topamp_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['list3']->value){?>
        $("#_topamp_card").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
});
</script> 

    </div>
    </div>
</form>
    <?php }} ?>