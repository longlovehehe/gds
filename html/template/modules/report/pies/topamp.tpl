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
    <div class="left">{"Top渠道"|L}</div>
    <div class="right">
        <div class="_topamp right_nav card_topamp"><a href="javascript:void(0);">{"商用卡"|L}</a></div>
        <div class="_topamp right_nav table_topamp"><a href="javascript:void(0);">{"商用终端"|L}</a></div>
        <div class="_topamp right_nav picture_topamp active"><a href="javascript:void(0);">{"商用用户"|L}</a></div>
    </div>
</div>
    <div class="get_day_info_topamp">
        <div id="_topamp" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
        <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable" class="base full">
                            <tr class='none' style="width:400px;">
                                <th width="365px">{"商用用户名称"|L}</th>
                                <th width="365px;">{"个数"|L}</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px">{"商用用户名称"|L}</th>
                                <th width="375px">{"个数"|L}</th>
                            </tr>
                            {foreach name=list item=item from=$list1}
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:{$item.color};border:1px solid {$item.color}"></div>&nbsp;{$item.name}</td>
                                <td width="375px">{$item.value}</td>
                            </tr>
                            {/foreach}
                            
                            <tr>
                                <td width="750px" colspan='2'align="center">{"总计"|L}:{$total1}{"个"|L}</td>
                            </tr>
                            
                        </table>
                        {if !$list1}
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
                        {/if}
                </div>
        </div>
        <div id="_topamp_attr" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
                <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable1" class="base full">
                            <tr class='head' style="width:400px;">
                                <th width="365px">{"商用用户名称"|L}</th>
                                <th width="365px;">{"个数"|L}</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px">{"商用用户名称"|L}</th>
                                <th width="375px">{"个数"|L}</th>
                            </tr>
                            {foreach name=list item=item from=$list2}
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:{$item.color};border:1px solid {$item.color}"></div>&nbsp;{$item.name}</td>
                                <td width="375px">{$item.value}</td>
                            </tr>
                            {/foreach}
                            <tr>
                                <td width="750px" colspan='2' align="center">{"总计"|L}:{$total2}{"个"|L}</td>
                            </tr>
                            
                        </table>
                        {if !$list2}
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
                        {/if}
                </div>
        </div>
        <div id="_topamp_card" style="float:left;height: 400px;width:350px;overflow-x: auto;"></div>
                <div style="float:left;">
                <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 400px;height: 399px;">
                    <table  id="freezedivTable2" class="base full">
                            <tr class='head' style="width:400px;">
                                <th width="365px">{"商用用户名称"|L}</th>
                                <th width="365px;">{"个数"|L}</th>
                            </tr>
                            <tr  class='head'>
                                <th width="375px">{"商用用户名称"|L}</th>
                                <th width="375px">{"个数"|L}</th>
                            </tr>
                            {foreach name=list item=item from=$list3}
                            <tr>
                                <td width="375px"><div style="float:left; display:inline;width:15px;height:15px;background:{$item.color};border:1px solid {$item.color}"></div>&nbsp;{$item.name}</td>
                                <td width="375px">{$item.value}</td>
                            </tr>
                            {/foreach}
                            
                            <tr>
                                <td width="750px" colspan='2' align="center">{"总计"|L}:{$total3}{"个"|L}</td>
                            </tr>
                            
                        </table>
                        {if !$list3}
                            <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
                        {/if}
                </div>
        </div>
        <input type="hidden" name="json" value='{$json}'>
        <script>
             function fixupFirstRow(tab) {
                    var div=tab.parent(); 

                    if(div.attr("class")=="freezediv"){
{*                        tab.children().children().eq(0).css("zIndex","999");*}
                        tab.children().children().eq(0).css("position","absolute");
                        div.scroll(function(){ 
                            var tr = tab.children().children().eq(0); 
                            tr.css("top" , div.scrollTop-20); 
                            {*tr.css("left",-1); *}
                        }); 
                    }
                }
                $(function(){
                 var tab=$("#freezedivTable");
                 var tab1=$("#freezedivTable1");
                 var tab2=$("#freezedivTable2");
                 if(tab){
                        fixupFirstRow(tab); 
                  }
                  if(tab1){
                        fixupFirstRow(tab1); 
                 }
                 if(tab2){
                        fixupFirstRow(tab2); 
                 }
                });
        var _topamp;
        var _topamp_attr;
        var _topamp_card;
        makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));
        
        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
            }
            // column chart
            _topamp = AmCharts.makeChart("_topamp", {
                type: "pie",
                theme: theme,
                dataProvider: [
                {foreach from=$list1 key=num item=item}
                {
                    "country": "{$item.name}",
                    "litres": "{$item.value}"
                }, 
                {/foreach}
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
            _topamp_attr = AmCharts.makeChart("_topamp_attr", {
                type: "pie",
                theme: theme,
                dataProvider: [
                {foreach from=$list2 key=num item=item}
                {
                    "country": "{$item.name}",
                    "litres": "{$item.value}"
                }, 
                {/foreach}
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
           _topamp_card = AmCharts.makeChart("_topamp_card", {
                type: "pie",
                theme: theme,
                dataProvider: [
                {foreach from=$list3 key=num item=item}
                {
                    "country": "{$item.name}",
                    "litres": "{$item.value}"
                }, 
                {/foreach}
                ],
                titleField: "country",
                valueField: "litres",
                labelText:"",
                colors:["#56ba8a","#ffe250","#ff8888","#e465c8","#6f73f3","#4ca3fc","#7ecef4","#b0b4b4","#56ba8a","#f7b249"],
                outlineColor:"#ffffff",
                outlineAlpha:1,
                outlineThickness:0,
                startDuration:0,
                creditsPosition:"top-left"
            });
            
        }
        _topamp.addListener("clickGraphItem",already_users_table);
        /**
         * 点击事件显示详细信息
         */
        function already_users_table(obj){
            console.log(obj);
        }
        </script>
        <div class="already_users_table1">
            
   <script type="text/javascript">
        if($("div.picture_topamp").attr("class").indexOf("active") > 0){
            $("#_topamp").removeClass("none");
            $("#_topamp").next().removeClass("none");
            $("#_topamp_attr").addClass("none");
            $("#_topamp_attr").next().addClass("none");
            $("#_topamp_card").addClass("none");
            $("#_topamp_card").next().addClass("none");
        }else if($("div.table_topamp").attr("class").indexOf("active") > 0){
            $("#_topamp").addClass("none");
            $("#_topamp").next().addClass("none");
            $("#_topamp_card").addClass("none");
            $("#_topamp_card").next().addClass("none");
            $("#_topamp_attr").removeClass("none");
            $("#_topamp_attr").next().removeClass("none");
        }else{
            $("#_topamp").addClass("none");
            $("#_topamp").next().addClass("none");
            $("#_topamp_attr").addClass("none");
            $("#_topamp_attr").next().addClass("none");
            $("#_topamp_card").removeClass("none");
            $("#_topamp_card").next().removeClass("none");
    }
    $("div.table_topamp").bind("click",function(){
    $("#_topamp_attr").removeClass("none");
    $("#_topamp_attr").next().removeClass("none");
    $("#_topamp").addClass("none");
    $("#_topamp").next().addClass("none");
    $("#_topamp_card").addClass("none");
    $("#_topamp_card").next().addClass("none");
    });
$("div.picture_topamp").bind("click",function(){
    $("#_topamp_attr").addClass("none");
    $("#_topamp_attr").next().addClass("none");
    $("#_topamp").removeClass("none");
    $("#_topamp").next().removeClass("none");
    $("#_topamp_card").addClass("none");
    $("#_topamp_card").next().addClass("none"); 
});
$("div.card_topamp").bind("click",function(){
    $("#_topamp_attr").addClass("none");
    $("#_topamp_attr").next().addClass("none");
    $("#_topamp_card").removeClass("none");
    $("#_topamp_card").next().removeClass("none");
    $("#_topamp").addClass("none");
    $("#_topamp").next().addClass("none"); 
});

$("div._topamp").bind("click",function(){
    $("div._topamp").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
$(function(){ 
    {if !$list1}
        $("#_topamp").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
    {if !$list2}
        $("#_topamp_attr").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
    {if !$list3}
        $("#_topamp_card").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
});
</script> 

    </div>
    </div>
</form>
    