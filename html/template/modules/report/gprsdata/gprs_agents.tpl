<style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <hr style="margin:30px 0px 10px 0px;">
    <!-- <div style="margin:20px;">
        <div class="left">
            <input autocomplete="off" style="height:24px;" class="datepickerreport start" name="this_start" type="text"  />
        </div>
        <div class="buttons right">
                <a class=" button gprs_agents" >查询</a>
        </div>
    </div> -->
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left">{"Top渠道"|L}</div>
    <div class="right">
      {*  <div class=" right_nav month_already_open"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class=" right_nav week_already_open"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class=" right_nav day_already_open"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class=" right_nav"></div>*}
        <div class="_gprs_agents right_nav table_gprs_agents"></div>
        <div class="_gprs_agents right_nav picture_gprs_agents active"></div>
    </div>
</div>
    <div class="get_day_info_gprs_agents">
       <div id="_gprs_agents" style="height: 400px;width:750px;overflow-x: auto;"></div>
{*       <div id="_gprs_agents_charts" style="height: 400px;width:750px;overflow-x: auto;"></div>*}
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
    <input type="hidden" name="json19" value='{$json}' />
        <script>
        var _gprs_agents;
        makeCharts_ga(eval($("input[name=json19]").val()));
 function makeCharts_ga(data){
           _gprs_agents = AmCharts.makeChart("_gprs_agents", {
                type: "serial",
                dataProvider: data,
                categoryField: "date",
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
            init:{
                    type:"init", 
                    chart:"AmChart"
                },
                {*angle:30,
                depth3D:15,*}
            chartCursor:{
                   zoomable: false,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },
                categoryAxis: {
                    gridPosition: "middle",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                },
                chartScrollbar: {
                    autoGridCount:false,
                },
                valueAxes: [{
                    title: "{"单位"|L}({"{$change_time['unit']}"|L})",
                    stackType:"none",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
                graphs: [
                {foreach from=$arr_list key=num item=item}
                {if $num<$sCount}
                    {
                    title: "{$item.name}",
                    valueField: "param{$num}",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "{$item.color}",
                    balloonText: "<b><span'>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                }, 
                {/if}
                {/foreach}
                {
                  type: "line",
                    title: "{$smarty.request.total}",
                    valueField: "param{$sCount}",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    animationPlayed:true,
                    lineColor:"#B0DE09",
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]]：<b>[[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:""
                },
            });
            }
          _gprs_agents.addListener("clickGraphItem",gprs_agents_table);
        function gprs_agents_table(obj){
            console.log(obj);
        }
       //  (function () {
       //      $("input.datepickerreport.start").datepicker({
       //          timeFormat: "HH:mm:ss",
       //         dateFormat: "yy-mm-dd"});
       //      $("input.datepickerreport.end").datepicker({
       //          timeFormat: "HH:mm:ss",
       //         dateFormat: "yy-mm-dd"});
       // })();
       $("a.gprs_agents").on("click",function(){
           $.ajax({
               url:'',
               dataType:"html",
               success:function(){
                   makeCharts_ga(eval($("input[name=json19]").val()));
                }
            });
        })
        </script>
<div class="gprs_agents_table none">
   <script type="text/javascript"> 
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
                 var tab=$("#freezedivTable19"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_gprs_agents").attr("class").indexOf("active") > 0){

                $("#_gprs_agents").removeClass("none");
                $("div.gprs_agents_table").addClass("none");
                $("div.picture_gprs_agents").addClass("charts_picture_hover");
                $("div.table_gprs_agents").addClass("charts_table");
            }else{
                $("#_gprs_agents").addClass("none");
                $("div.gprs_agents_table").removeClass("none");

                $("div.picture_gprs_agents").addClass("charts_picture");
                $("div.table_gprs_agents").addClass("charts_table_hover");
            }
            $("div.table_gprs_agents").bind("click",function(){
                $("div.table_gprs_agents").addClass("charts_table_hover");
                $("div.picture_gprs_agents").addClass("charts_picture");
                $("div.picture_gprs_agents").removeClass("charts_picture_hover");
                $("div.gprs_agents_table").removeClass("none");
                $("#_gprs_agents").addClass("none");
                {*$.ajax({
                    url:"?m=report&a=get_already_users",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}
                });
            $("div.picture_gprs_agents").bind("click",function(){
                $("div.picture_gprs_agents").addClass("charts_picture_hover");
                $("div.table_gprs_agents").addClass("charts_table");
                $("div.table_gprs_agents").removeClass("charts_table_hover");
                $("div.gprs_agents_table").addClass("none");
                $("#_gprs_agents").removeClass("none");
               {* $.ajax({
                    url:"?m=report&a=report_item",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}

            });
           {* $("div.day").bind("click",function(){
                $("div.day").css("background","#fff");
                $("div.week").css("background","transparent");
                $("div.month").css("background","transparent");
                $.ajax({
                    url:"?m=report&a=get_day_info",
                    dataType:"html",
                    data:{
                        ep_id:$('input[name=ep_id]').val()
                        },
                     success:function(res){
                         //alert(123);
                         //$("input[name=json]").html(123);
                         $("input[name=action]").val("get_day_info");
                         //send();
                        }
                    });
            });
            $("div.week").bind("click",function(){
                $("div.week").css("background","#fff");
                $("div.day").css("background","transparent");
                $("div.month").css("background","transparent");

            });
            $("div.month").bind("click",function(){
                $("div.month").css("background","#fff");
                $("div.day").css("background","transparent");
                $("div.week").css("background","transparent");
            });*}
            $("div._gprs_agents").bind("click",function(){
                $("div._gprs_agents").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
            
            //选择商用和测试
            var condition;
            $("input[type=checkbox]").on("click",function(){
                if($("input[name=commercial]").is(":checked")&&$("input[name=test]").is(":checked")){
                    condition="com&test";
                    //$("input[name=commercial]").val("comm");
                }else if($("input[name=commercial]").is(":checked")){
                        condition="com";
                }else if($("input[name=test]").is(":checked")){
                        condition="test";
                }else{
                        condition="none";
                }
                $.ajax({
                    url:"?m=report&a=get_gprs_agents_data",
                    dataType:"html",
                    data:{
                        u_attr_type:condition
                    },
                    success:function(res){
                        //$("#_gprs_agents_charts").hmtl("");
                        makeCharts_type(eval(res));
                    }
                });
                
            });
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable19" class="base full">
        <tr class='head' style="width:730px;">
            <th width="375px">{"代理商"|L}</th>
            {foreach name=arr_list item=item from=$arr_list}
            <th width="375px">{{$item.name}|L}</th>
            {/foreach}

        </tr>
        <tr  class='head'>
            <th width="375px">{"代理商"|L}</th>
            {foreach name=arr_list item=item from=$arr_list}
            <th width="375px">{{$item.name}|L}</th>
            {/foreach}
        </tr>
       {foreach item=item from=$arr}
        <tr>
            <td width="375px">{$item.date}</td>
            {foreach item=item1 key=key1 from=$arr_list}
            {assign var=i value="param"|cat:$key1}
            <td width="375px">{$item.$i}</td>
            {/foreach}
        </tr>
        {/foreach}

    </table>
    {if empty($arr)}
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
    {/if}
    </div>
</div>
<script type="text/javascript">
$(function(){  
    {if !$arr}
        $("#_gprs_agents").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>