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
    <div class="left">已创建用户数&新创建用户数：1000个&100个</div>
    <div class="right">
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">月</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">周</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">日</a></div>
        <div class="right_nav"></div>
        <div class="_users right_nav table_users"><a href="javascript:void(0);">表</a></div>
        <div class="_users right_nav picture_users active"><a href="javascript:void(0);">图</a></div>
        
    </div>
</div>
    <div class="get_day_info_users">
        <div id="_users" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
        <input type="hidden" name="json4" value='{$json}'>
        <script> 
        var chart;
        makeCharts(eval($("input[name=json4]").val()));

 function makeCharts(data){
            

           chart = AmCharts.makeChart("_users", {
               type: "serial",
                dataProvider: data,
                categoryField: "date",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                {*angle:30,
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
                    //fillColor: "#A83A3A",
                     //labelRotation:"45",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
                },
                valueAxes: [{
                    title: "{"数据统计"|L}",
                    stackType:"regular",
                    gridAlpha:0.1,
                    axisAlpha:0,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
              //  AxisBase:{
              //  tickLength:1
              //  },
                graphs: [
                    {
                    title: "存活量",
                    labelText: "[[value]]",
                    valueField: "pargam1",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
                    lineColor: "#CCE198",
                    balloonText: "<b><span style='color:#C72C95'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    labelPosition: "middle"
                }, 
                {
                   title: "丢失量",
                    labelText: "[[value]]",
                    valueField: "pargam2",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
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
<div class="users_table none">
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
     var tab=$("#freezedivTable4");
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
    if($("div.picture_users").attr("class").indexOf("active") > 0){
            $("#_users").removeClass("none");
            $("div.picture_users").css("background","#fff");
            $("div.users_table").addClass("none");
            $("div.table_users").css("background","transparent");
        }else{
            $("#_users").addClass("none");
            $("div.users_table").removeClass("none");
            $("div.table_users").css("background","#fff");
            $("div.picture_users").css("background","transparent");
        }
    $("div.table_users").bind("click",function(){
        $("div.table_users").css("background","#fff");
        $("div.picture_users").css("background","transparent");
        $("div.users_table").removeClass("none");
        $("#_users").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_users").bind("click",function(){
    $("div.picture_users").css("background","#fff");
    $("div.table_users").css("background","transparent");
    $("div.users_table").addClass("none");
    $("#_users").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});
$("div.day_users").bind("click",function(){
    $("div.day_users").css("background","#fff");
    $("div.week_users").css("background","transparent");
    $("div.month_users").css("background","transparent");
        $.ajax({
                url:"?m=report&a=get_day_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"day",
                    data_type:"_users",
                    table_type:"users_table",
                    index:"4",
                    title:{
                        name1:'新创建',
                        name2:'已创建',
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_users").html(res);
                }
        });
});
$("div.week_users").bind("click",function(){
    $("div.week_users").css("background","#fff");
    $("div.day_users").css("background","transparent");
    $("div.month_users").css("background","transparent");
     $.ajax({
                url:"?m=report&a=get_week_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"week",
                    data_type:"_users",
                    table_type:"users_table",
                    index:"4",
                    title:{
                        name1:'新创建',
                        name2:'已创建',
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_users").html(res);
                }
        });
});
$("div.month_users").bind("click",function(){
    $("div.month_users").css("background","#fff");
    $("div.day_users").css("background","transparent");
    $("div.week_users").css("background","transparent");
     $.ajax({
                url:"?m=report&a=get_month_info",
                dataType:"html",
                data:{
                    ep_id:$('input[name=ep_id]').val(),
                    date_type:"month",
                    data_type:"_users",
                    table_type:"users_table",
                    index:"4",
                    title:{
                        name1:'新创建',
                        name2:'已创建',
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                    stackType:"regular",
                    start:$("input[name=start]").val(),
                    end:$("input[name=end]").val()
                },
                success:function(res){
                    $("div.get_day_info_users").html(res);
                }
        });
});
$("div.picture_users").css("background","#fff");
$("div.day_users").css("background","#fff");
$("div._users").bind("click",function(){
    $("div._users").each(function(){
        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable4" class="base full">
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
        $("div.day_users a").css("color","#A83A39");
    }
    {if !$list}
        $("#_users").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>