<form class="data">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><span id="callname">{"累计通话次数"|L}：</span><span id="callsum">{$sum}</span></div>
    <div class="right">
        <div class="_calls right_nav table_calls"><a href="javascript:void(0);">{"时长"|L}</a></div>
        <div class="_calls right_nav picture_calls active"><a href="javascript:void(0);">{"次数"|L}</a></div>
    </div>
</div>
    <div class="get_day_info_calls">
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="callsum">{$sum}</span></div> -->
        <div id="_calls" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_calls_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
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
                    "country": "{"语音"|L}",
                        "litres": "{$list[0]['sdr_audio_hcount']}"
                }, {
                    "country": "{"视频"|L}",
                        "litres": "{$list[0]['sdr_video_hcount']}"
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
                    "country": "{"语音"|L}",
                        "litres": "{$list[0]['sdr_audio_htime']}"
                }, {
                    "country": "{"视频"|L}",
                        "litres": "{$list[0]['sdr_video_htime']}"
                }],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#e465c8", "#7ECEF4", "#F8FF01", "#B0DE09", "#04D215", "#0D8ECF", "#0D52D1", "#2A0CD0", "#8A0CCF", "#CD0D74", "#754DEB", "#DDDDDD", "#999999", "#333333", "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
{*                gradientRatio:[0.2, 0, -0.2],*}
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
        var sum = "{$sum1}({"分钟"|L})";
        $("#callsum").html(sum);
        var name = '{"累计通话时长"|L}：';
        $("#callname").html(name);
        $("#_calls_attr").removeClass("none");
        $("#_calls").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_calls").bind("click",function(){
    var sum = "{$sum}";
    $("#callsum").html(sum);
    var name = '{"累计通话次数"|L}：';
    $("#callname").html(name);
    $("#_calls_attr").addClass("none");
    $("#_calls").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});

$("div._calls").bind("click",function(){
    $("div._calls").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    {if $sum==0 || $sum=='0'}
        /*$("#_calls > div.amcharts-chart-div").eq(2).html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
        $("#_calls_attr > div.amcharts-chart-div").eq(3).html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');*/
        $("#_calls").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
        $("#_calls_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script> 

    </div>
    </div>
</form>
    