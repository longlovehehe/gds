<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:28
         compiled from "..\template\modules\report\pies\already_open_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:265945762236c4ef095-47204779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dce202d9b553ae5c1d7251140d4a59e86581a34' => 
    array (
      0 => '..\\template\\modules\\report\\pies\\already_open_users.tpl',
      1 => 1464674565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '265945762236c4ef095-47204779',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sum' => 0,
    'json' => 0,
    'list' => 0,
    'sum1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236c64ab60_62780682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236c64ab60_62780682')) {function content_5762236c64ab60_62780682($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("开户用户总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
    <div class="right">
        <div class="_already_open right_nav table_already_open"><a href="javascript:void(0);"><?php echo L("类型");?>
</a></div>
        <div class="_already_open right_nav picture_already_open active"><a href="javascript:void(0);"><?php echo L("分类");?>
</a></div>
    </div>
</div>
    <div class="get_day_info_already_open">
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="_already_open" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_already_open_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var _already_open;
        var _already_open_attr;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _already_open = AmCharts.makeChart("_already_open", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "<?php echo L("测试");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_test_user'];?>
"
                }, {
                    "country": "<?php echo L("商用");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_commercial_user'];?>
"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#BAE4F8","#7ECEF4"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                creditsPosition:"top-left",
                startDuration:0,

                legend: {
                    position:"top",
                    valueText:"",
                    align: "left",
                    markerType: "square",
                }
            });
            _already_open_attr = AmCharts.makeChart("_already_open_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "Phone",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_phone_user'];?>
"
                }, {
                    "country": "Console",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_console_user'];?>
"
                }, {
                    "country": "GVS",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_gvs_user'];?>
"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                legend: {
                    position:"top",
                    valueText:"",
                    align: "left",
                    markerType: "square",
                }
            });
            
        }
        _already_open.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_already_open").attr("class").indexOf("active") > 0){
            $("#_already_open").removeClass("none");
            $("#_already_open_attr").addClass("none");
        }else{
            $("#_already_open").addClass("none");
            $("#_already_open_attr").removeClass("none");

        }
    $("div.table_already_open").bind("click",function(){
        var sum = "<?php echo $_smarty_tpl->tpl_vars['sum1']->value;?>
";
        $("#sum").html(sum);
        $("#_already_open_attr").removeClass("none");
        $("#_already_open").addClass("none");
        
    });
$("div.picture_already_open").bind("click",function(){
    var sum = "<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
";
    $("#sum").html(sum);
    $("#_already_open_attr").addClass("none");
    $("#_already_open").removeClass("none");
   
    
});

$("div._already_open").bind("click",function(){
    $("div._already_open").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});

$(function(){ 
    <?php if ($_smarty_tpl->tpl_vars['sum']->value==0||$_smarty_tpl->tpl_vars['sum']->value=='0'){?>
        $("#_already_open").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
        $("#_already_open_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');

    <?php }?>
});  
</script> 

    </div>
    </div>
</form>
    <?php }} ?>