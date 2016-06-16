<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:28
         compiled from "..\template\modules\report\pies\gprs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49455762236c6f2b03-58930225%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f696f06245626ca95b1aa4a467f6a5cca52a3347' => 
    array (
      0 => '..\\template\\modules\\report\\pies\\gprs.tpl',
      1 => 1464674565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49455762236c6f2b03-58930225',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sum' => 0,
    'json' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762236c817ad1_00728088',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236c817ad1_00728088')) {function content_5762236c817ad1_00728088($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("流量卡总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
    <div class="right">
        
        <div class="_gprs right_nav picture_gprs active"><a href="javascript:void(0);"></a></div>
    </div>
</div>
    <div class="get_day_info_gprs">
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="_gprs" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_gprs_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var _gprs;
        var _gprs_attr;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _gprs = AmCharts.makeChart("_gprs", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "<?php echo L("测试");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_gprs_user_test'];?>
"
                }, {
                    "country": "<?php echo L("商用");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_gprs_user_commercial'];?>
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
                    valueText:"",
                    align: "left",
                    markerType: "square",
                }
            });
            _gprs_attr = AmCharts.makeChart("_gprs_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "Czech Republic",
                        "litres": 15.9
                }, {
                    "country": "Ireland",
                        "litres": 131.1
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                legend: {
                    position:"top",
                    align: "center",
                    markerType: "circle",
                }
            });
            
        }
        _gprs.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_gprs").attr("class").indexOf("active") > 0){
            $("#_gprs").removeClass("none");
            $("#_gprs_attr").addClass("none");
        }else{
            $("#_gprs").addClass("none");
            $("#_gprs_attr").removeClass("none");
        }
    $("div.table_gprs").bind("click",function(){
    $("#_gprs_attr").removeClass("none");
    $("#_gprs").addClass("none");
    
    });
$("div.picture_gprs").bind("click",function(){
    $("#_gprs_attr").addClass("none");
    $("#_gprs").removeClass("none");
   
    
});

$("div._gprs").bind("click",function(){
    $("div._gprs").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});

$(function(){ 
    <?php if ($_smarty_tpl->tpl_vars['sum']->value==0||$_smarty_tpl->tpl_vars['sum']->value=='0'){?>
        $("#_gprs").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script> 

    </div>
    </div>
</form>
    <?php }} ?>