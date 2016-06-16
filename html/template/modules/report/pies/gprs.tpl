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
    <div class="left">{"流量卡总数"|L}：<span id="sum">{$sum}</span></div>
    <div class="right">
        {*<div class="_gprs right_nav table_gprs"><a href="javascript:void(0);">{"类型"|L}</a></div>*}
        <div class="_gprs right_nav picture_gprs active"><a href="javascript:void(0);"></a></div>
    </div>
</div>
    <div class="get_day_info_gprs">
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="sum">{$sum}</span></div> -->
        <div id="_gprs" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_gprs_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
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
                    "country": "{"测试"|L}",
                        "litres": "{$list[0]['sdr_gprs_user_test']}"
                }, {
                    "country": "{"商用"|L}",
                        "litres": "{$list[0]['sdr_gprs_user_commercial']}"
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
    {*$.ajax({
        url:"?m=report&a=get_already_users",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    });
$("div.picture_gprs").bind("click",function(){
    $("#_gprs_attr").addClass("none");
    $("#_gprs").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});

$("div._gprs").bind("click",function(){
    $("div._gprs").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});

$(function(){ 
    {if $sum==0 || $sum=='0'}
        $("#_gprs").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script> 

    </div>
    </div>
</form>
    