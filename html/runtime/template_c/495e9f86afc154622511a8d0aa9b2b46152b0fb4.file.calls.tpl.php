<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:28
         compiled from "..\template\modules\report\pies\calls.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116045762236cb40516-52348014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '495e9f86afc154622511a8d0aa9b2b46152b0fb4' => 
    array (
      0 => '..\\template\\modules\\report\\pies\\calls.tpl',
      1 => 1465368654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116045762236cb40516-52348014',
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
  'unifunc' => 'content_5762236cd4bc84_48340405',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762236cd4bc84_48340405')) {function content_5762236cd4bc84_48340405($_smarty_tpl) {?><form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><span id="callname"><?php echo L("累计通话次数");?>
：</span><span id="callsum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
    <div class="right">
        <div class="_calls right_nav table_calls"><a href="javascript:void(0);"><?php echo L("时长");?>
</a></div>
        <div class="_calls right_nav picture_calls active"><a href="javascript:void(0);"><?php echo L("次数");?>
</a></div>
    </div>
</div>
    <div class="get_day_info_calls">
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="callsum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="_calls" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_calls_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
        var _calls;
        var _calls_attr;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _calls = AmCharts.makeChart("_calls", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "<?php echo L("语音");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_audio_hcount'];?>
"
                }, {
                    "country": "<?php echo L("视频");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_video_hcount'];?>
"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#F6B37F","#CCE198"],
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
            _calls_attr = AmCharts.makeChart("_calls_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [{
                    "country": "<?php echo L("语音");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_audio_htime'];?>
"
                }, {
                    "country": "<?php echo L("视频");?>
",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['list']->value[0]['sdr_video_htime'];?>
"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#e465c8", "#7ECEF4", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"],
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
        _calls.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_calls").attr("class").indexOf("active") > 0){
            $("#_calls").removeClass("none");
            $("#_calls_attr").addClass("none");
        }else{
            $("#_calls").addClass("none");
            $("#_calls_attr").removeClass("none");
        }
    $("div.table_calls").bind("click",function(){
        var sum = "<?php echo $_smarty_tpl->tpl_vars['sum1']->value;?>
(<?php echo L("分钟");?>
)";
        $("#callsum").html(sum);
        var name = '<?php echo L("累计通话时长");?>
：';
        $("#callname").html(name);
        $("#_calls_attr").removeClass("none");
        $("#_calls").addClass("none");
        
    });
$("div.picture_calls").bind("click",function(){
    var sum = "<?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
";
    $("#callsum").html(sum);
    var name = '<?php echo L("累计通话次数");?>
：';
    $("#callname").html(name);
    $("#_calls_attr").addClass("none");
    $("#_calls").removeClass("none");
   
    
});

$("div._calls").bind("click",function(){
    $("div._calls").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    <?php if ($_smarty_tpl->tpl_vars['sum']->value==0||$_smarty_tpl->tpl_vars['sum']->value=='0'){?>
        /*$("#_calls > div.amcharts-chart-div").eq(2).html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
        $("#_calls_attr > div.amcharts-chart-div").eq(3).html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');*/
        $("#_calls").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
        $("#_calls_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script> 

    </div>
    </div>
</form>
    <?php }} ?>