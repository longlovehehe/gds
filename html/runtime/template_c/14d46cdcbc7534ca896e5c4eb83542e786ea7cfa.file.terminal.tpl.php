<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:28
         compiled from "..\template\modules\report\pies\terminal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:415762236c8cb5f3-63904121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14d46cdcbc7534ca896e5c4eb83542e786ea7cfa' => 
    array (
      0 => '..\\template\\modules\\report\\pies\\terminal.tpl',
      1 => 1465368654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '415762236c8cb5f3-63904121',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sum' => 0,
    'json' => 0,
    'list' => 0,
    'aList' => 0,
    'item' => 0,
    'sum1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236ca88b61_40270739',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236ca88b61_40270739')) {function content_5762236ca88b61_40270739($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("终端总数");?>
：<span id="sumnum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
    <div class="right">
        <div class="_terminal right_nav table_terminal"><a href="javascript:void(0);"><?php echo L("类型");?>
</a></div>
        <div class="_terminal right_nav picture_terminal active"><a href="javascript:void(0);"><?php echo L("分类");?>
</a></div>
    </div>
</div>
    <div class="get_day_info_terminal">
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="sumnum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="_terminal" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_terminal_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var _terminal;
        var _terminal_attr;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _terminal = AmCharts.makeChart("_terminal", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "<?php echo L("测试");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_terminal_user_test'];?>
"
                }, {
                    "country": "<?php echo L("商用");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_terminal_user_commercial'];?>
"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#BAE4F8","#7ECEF4"],
                outlineColor:"#ffffff",
               outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left",
                legend: {
                     position:"top",
                    // fontSize:"2",
                    valueText:"",
                    align: "left",
                    markerType: "square",
                }
            });
            _terminal_attr = AmCharts.makeChart("_terminal_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['aList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                {
                    "country": "<?php echo $_smarty_tpl->tpl_vars['item']->value->type;?>
",
                    "litres": "<?php echo $_smarty_tpl->tpl_vars['item']->value->value;?>
"
                }, 
                <?php } ?>
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                <?php if ($_smarty_tpl->tpl_vars['sum1']->value>0){?>
                legend: {
                    position:"top",
                    // fontSize:"2",
                    valueText:"",
                    align: "center",
                    markerType: "square",
                }
                <?php }?>
            });
            
        }
        _terminal.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_terminal").attr("class").indexOf("active") > 0){
            $("#_terminal").removeClass("none");
            $("#_terminal_attr").addClass("none");
        }else{
            $("#_terminal").addClass("none");
            $("#_terminal_attr").removeClass("none");
        }
    $("div.table_terminal").bind("click",function(){
        var sum = "<?php echo $_smarty_tpl->tpl_vars['sum1']->value;?>
";
        $("#sumnum").html(sum);
        $("#_terminal_attr").removeClass("none");
        $("#_terminal").addClass("none");
        
    });
$("div.picture_terminal").bind("click",function(){
    var sum = "<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
";
    $("#sumnum").html(sum);
    $("#_terminal_attr").addClass("none");
    $("#_terminal").removeClass("none");
   
    
});

$("div._terminal").bind("click",function(){
    $("div._terminal").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    <?php if ($_smarty_tpl->tpl_vars['sum']->value==0||$_smarty_tpl->tpl_vars['sum']->value=='0'){?>
        $("#_terminal").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
        $("#_terminal_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:188px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
});
</script> 

    </div>
    </div>
</form>
    <?php }} ?>