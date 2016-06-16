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
    <div class="left">{"开户用户总数"|L}：<span id="sum">{$sum}</span></div>
    <div class="right">
        <div class="_already_open right_nav table_already_open"><a href="javascript:void(0);">{"类型"|L}</a></div>
        <div class="_already_open right_nav picture_already_open active"><a href="javascript:void(0);">{"分类"|L}</a></div>
    </div>
</div>
    <div class="get_day_info_already_open">
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="sum">{$sum}</span></div> -->
        <div id="_already_open" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_already_open_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
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
                    "country": "{"测试"|L}",
                        "litres": "{$list[0]['sdr_test_user']}"
                }, {
                    "country": "{"商用"|L}",
                        "litres": "{$list[0]['sdr_commercial_user']}"
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
{*                startEffect:"easeOutSine",*}
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
                        "litres": "{$list[0]['sdr_phone_user']}"
                }, {
                    "country": "Console",
                        "litres": "{$list[0]['sdr_console_user']}"
                }, {
                    "country": "GVS",
                        "litres": "{$list[0]['sdr_gvs_user']}"
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
        var sum = "{$sum1}";
        $("#sum").html(sum);
        $("#_already_open_attr").removeClass("none");
        $("#_already_open").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_already_open").bind("click",function(){
    var sum = "{$sum}";
    $("#sum").html(sum);
    $("#_already_open_attr").addClass("none");
    $("#_already_open").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});

$("div._already_open").bind("click",function(){
    $("div._already_open").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});

$(function(){ 
    {if $sum==0 || $sum=='0'}
        $("#_already_open").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
        $("#_already_open_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');

    {/if}
});  
</script> 

    </div>
    </div>
</form>
    