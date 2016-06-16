<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:14:14
         compiled from "..\template\modules\report\show_charts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28700576243b6183285-77335955%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9e6f272645552f233d8afe0e9fe86c466e151c7' => 
    array (
      0 => '..\\template\\modules\\report\\show_charts.tpl',
      1 => 1466055349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28700576243b6183285-77335955',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sum' => 0,
    'callTime' => 0,
    'infoNum' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576243b6252339_30358711',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576243b6252339_30358711')) {function content_576243b6252339_30358711($_smarty_tpl) {?><div class="get_call_time" style="width: 370px;float: left;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title"><?php echo L("通话时长");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
        </div>
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="get_call_time" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="callTime" value='<?php echo $_smarty_tpl->tpl_vars['callTime']->value;?>
'>
        <script>
            var get_call_time;
            makeCharts("light", "#E5E5E5",eval($("input[name=callTime]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                // column chart
                get_call_time = AmCharts.makeChart("get_call_time", {
                    type: "pie",
                    theme: theme,
                    dataProvider: [{
                        "type": "语音",
                        "value": "<?php echo $_smarty_tpl->tpl_vars['callTime']->value['sdr_audio_time'];?>
"
                    }, {
                        "type": "视频",
                        "value": "<?php echo $_smarty_tpl->tpl_vars['callTime']->value['sdr_video_time'];?>
"
                    }, {
                        "type": "对讲",
                        "value": "<?php echo $_smarty_tpl->tpl_vars['callTime']->value['sdr_ptt_time'];?>
"
                    }],
                    export: {
                        "enabled": true,
                        
                    },
                    titleField: "type",
                    valueField: "value",
                    labelText:"",
                    colors:["#7ECEF4","#4CA3FC","#227BD6"],
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

            }

        </script>
    </div>
    <div class="get_call" style="width: 370px;float: right;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title"><?php echo L("短信条数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
        </div>
        <div id="get_call" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="infoNum" value='<?php echo $_smarty_tpl->tpl_vars['infoNum']->value;?>
'>
        <script>
            var get_call;
            makeCharts("light", "#E5E5E5",eval($("input[name=infoNum]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                get_call = AmCharts.makeChart("get_call", {
                    type: "pie",
                    theme: theme,
                    dataProvider: [{
                        "type": "短信",
                        "value": "<?php echo $_smarty_tpl->tpl_vars['infoNum']->value['sdr_send_sm_count'];?>
"
                    }, {
                        "type": "彩信",
                        "value": "<?php echo $_smarty_tpl->tpl_vars['infoNum']->value['sdr_send_pic_count'];?>
"
                    }],
                    titleField: "type",
                    valueField: "value",
                    labelText:"",
                    colors:["#56BA8A","#95E07E"],
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
        </script>
    </div>
    <div style="clear: both;"></div>
<?php }} ?>