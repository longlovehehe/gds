<div class="get_call_time" style="width: 370px;float: left;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title">{"通话时长"|L}：<span id="sum">{$sum}</span></div>
        </div>
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="sum">{$sum}</span></div> -->
        <div id="get_call_time" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="callTime" value='{$callTime}'>
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
                        "value": "{$callTime.sdr_audio_time}"
                    }, {
                        "type": "视频",
                        "value": "{$callTime.sdr_video_time}"
                    }, {
                        "type": "对讲",
                        "value": "{$callTime.sdr_ptt_time}"
                    }],
                    export: {
                        "enabled": true,
                        {*"menu": [ {
                            "class": "export-main",
                            "menu": [ {
                                "label": "Download",
                                "menu": [ "PNG", "JPG" ]
                            }, {
                                "label": "Annotate",
                                "action": "draw",
                                "menu": [ {
                                    "class": "export-drawing",
                                    "menu": [ "PNG", "JPG", "CANCEL" ]
                                } ]
                            } ]
                        } ]*}
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
                    {*                startEffect:"easeOutSine",*}
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
            <div class="left charts-title">{"短信条数"|L}：<span id="sum">{$sum}</span></div>
        </div>
        <div id="get_call" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="infoNum" value='{$infoNum}'>
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
                        "value": "{$infoNum.sdr_send_sm_count}"
                    }, {
                        "type": "彩信",
                        "value": "{$infoNum.sdr_send_pic_count}"
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
