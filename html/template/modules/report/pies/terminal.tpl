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
    <div class="left">{"终端总数"|L}：<span id="sumnum">{$sum}</span></div>
    <div class="right">
        <div class="_terminal right_nav table_terminal"><a href="javascript:void(0);">{"类型"|L}</a></div>
        <div class="_terminal right_nav picture_terminal active"><a href="javascript:void(0);">{"分类"|L}</a></div>
    </div>
</div>
    <div class="get_day_info_terminal">
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="sumnum">{$sum}</span></div> -->
        <div id="_terminal" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <div id="_terminal_attr" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
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
                    "country": "{"测试"|L}",
                        "litres": "{$list[0]['sdr_terminal_user_test']}"
                }, {
                    "country": "{"商用"|L}",
                        "litres": "{$list[0]['sdr_terminal_user_commercial']}"
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
                {foreach from=$aList key=num item=item} 
                {
                    "country": "{$item->type}",
                    "litres": "{$item->value}"
                }, 
                {/foreach}
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                {if $sum1 > 0}
                legend: {
                    position:"top",
                    // fontSize:"2",
                    valueText:"",
                    align: "center",
                    markerType: "square",
                }
                {/if}
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
        var sum = "{$sum1}";
        $("#sumnum").html(sum);
        $("#_terminal_attr").removeClass("none");
        $("#_terminal").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_terminal").bind("click",function(){
    var sum = "{$sum}";
    $("#sumnum").html(sum);
    $("#_terminal_attr").addClass("none");
    $("#_terminal").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});

$("div._terminal").bind("click",function(){
    $("div._terminal").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    {if $sum==0 || $sum=='0'}
        $("#_terminal").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
        $("#_terminal_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:188px;">【{"暂无数据"|L}】</div>');
    {/if}
});
</script> 

    </div>
    </div>
</form>
    