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
    <div class="left">{"用户有效性"|L}</div>
    <div class="right">
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class="right_nav"></div>
        <div class="_validity right_nav table_validity"><a href="javascript:void(0);">{"表"|L}</a></div>
        <div class="_validity right_nav picture_validity active"><a href="javascript:void(0);">{"图"|L}</a></div>
        
    </div>
</div>
    <div class="get_day_info_validity">
        <div id="_validity" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
        <input type="hidden" name="json6" value='{$json}'>
        <script src="./script/report/amcharts.js"></script>
        <script src="./script/report/serial.js"></script>
        <script> 
        var chart;
        makeCharts(eval($("input[name=json6]").val()));
 function makeCharts(data){
           
           chart = AmCharts.makeChart("_validity", {
                type: "serial",
                dataProvider: data,
                categoryField: "date",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
               {* angle:30,
                depth3D:15,*}
                chartCursor:{
                   zoomable: false,
                   categoryBalloonDateFormat: "DD",
                   cursorAlpha: 0.5,
                   valueLineEnabled: true,
                   valueLineBalloonEnabled: true,
{*                   addChartCursor: true,*}
                },
                categoryAxis: {
                    gridPosition: "middle",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                    tickLength:3,
                    //fillColor: "#A83A3A",
                     //labelRotation:"45",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
                },
            chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                /*valueAxes: [{
                    title: "{"数据统计"|L}",
                    stackType:"regular",
                    gridAlpha:0.1,
                    axisAlpha:0,
                }],*/
              //  AxisBase:{
              //  tickLength:1
              //  },
                graphs: [
                    {
                    title: "{"启用"|L}",
                    labelText: "[[value]]",
                    valueField: "pargam1",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#CCE198",
                    balloonText: "<b><span style='color:#C72C95'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    labelPosition: "middle"
                }, 
                {
                   title: "{"停用"|L}",
                    labelText: "[[value]]",
                    valueField: "pargam2",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#FF8888",
                    balloonText: "<b><span style='color:#afbb86'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    labelPosition: "middle"
                },
                {
                     type: "line",
                    title: "{"总数"|L}",
                    valueField: "total",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                },
            });
            }
        </script>
<div class="users_validity_table none">
   <script type="text/javascript"> 
    function fixupFirstRow(tab) {
        var div=tab.parent(); 

        if(div.attr("class")=="freezediv"){
            tab.children().children().eq(0).css("zIndex","999");
            tab.children().children().eq(0).css("position","absolute");
            div.scroll(function(){ 
                var tr = tab.children().children().eq(0); 
                tr.css("top" , div.scrollTop-20); 
                {*tr.css("left",-1); *}
            }); 
        }
    }
    $(function(){
     var tab=$("#freezedivTable6");
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_validity").attr("class").indexOf("active") > 0){
            $("#_validity").removeClass("none");
            $("div.picture_validity").css("background","#fff");
            $("div.users_validity_table").addClass("none");
            $("div.table_validity").css("background","transparent");
        }else{
            $("#_validity").addClass("none");
            $("div.users_validity_table").removeClass("none");
            $("div.table_validity").css("background","#fff");
            $("div.picture_validity").css("background","transparent");
        }
    $("div.table_validity").bind("click",function(){
        $("div.table_validity").css("background","#fff");
        $("div.picture_validity").css("background","transparent");
        $("div.users_validity_table").removeClass("none");
        $("#_validity").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_validity").bind("click",function(){
    $("div.picture_validity").css("background","#fff");
    $("div.table_validity").css("background","transparent");
    $("div.users_validity_table").addClass("none");
    $("#_validity").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});
$("div.day_validity").bind("click",function(){
    $("div.day_validity").css("background","#fff");
    $("div.week_validity").css("background","transparent");
    $("div.month_validity").css("background","transparent");
    $.ajax({
                url:"?m=report&a=get_day_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"day",
                    data_type:"_validity",
                    table_type:"users_validity_table",
                    index:"6",
                    title:{
                        name1:"{"启用"|L}",
                        name2:"{"停用"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_validity").html(res);
                }
        });
});
$("div.week_validity").bind("click",function(){
    $("div.week_validity").css("background","#fff");
    $("div.day_validity").css("background","transparent");
    $("div.month_validity").css("background","transparent");
    $.ajax({
                url:"?m=report&a=get_day_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"week",
                    data_type:"_validity",
                    table_type:"users_validity_table",
                    index:"6",
                   title:{
                        name1:"{"启用"|L}",
                        name2:"{"停用"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_validity").html(res);
                }
        });
});
$("div.month_validity").bind("click",function(){
    $("div.month_validity").css("background","#fff");
    $("div.day_validity").css("background","transparent");
    $("div.week_validity").css("background","transparent");
    $.ajax({
                url:"?m=report&a=get_day_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"month",
                    data_type:"_validity",
                    table_type:"users_validity_table",
                    index:"6",
                    title:{
                        name1:"{"启用"|L}",
                        name2:"{"停用"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_validity").html(res);
                }
        });
});
$("div.picture_validity").css("background","#fff");
$("div.day_validity").css("background","#fff");
$("div._validity").bind("click",function(){
    $("div._validity").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable6" class="base full">
        <tr class='head' style="width:730px;">
            {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
            <th width="375px">{"日期"|L}</th>
            <th width="375px;">{"个数"|L}</th>
        </tr>
        <tr  class='head'>
            <th width="375px">{"日期"|L}</th>
            <th width="375px">{"个数"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
        <tr>
            {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
            <td width="375px">{$item.create_time}</td>
            <td width="375px">{$item.user_num}</td>
        </tr>
        {/foreach}

    </table>
    {if !$list}
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
    {/if}
</div>
        </div>
    </div>
</form>
<script type="text/javascript">
$(function(){  
    var checked = "{$change_time['checked']}";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_validity a").css("color","#A83A39");
    }
    {if !$list}
        $("#_validity").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>   