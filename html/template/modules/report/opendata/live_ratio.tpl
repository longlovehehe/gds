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
    <div class="left">{"存活比例"|L}</div>
    <div class="right">
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class=" right_nav">&nbsp;&nbsp;</div>
        <div class="live right_nav table_live"></div>
        <div class="live right_nav picture_live active"></div>
        
    </div>
</div>
    <div class="get_day_info_live">
        <div id="_live" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
        <input type="hidden" name="json3" value='{$json}'>
{* <script src="./script/report/amcharts.js"></script>
    <script src="./script/report/serial.js"></script>*}
        <script> 
        var chart;
        makeCharts(eval($("input[name=json3]").val()));

 function makeCharts(data){
            

           _live = AmCharts.makeChart("_live", {
               type: "serial",
                dataProvider: data,
                categoryField: "date1",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
               {* angle:30,
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
                    //fillColor: "#A83A3A",
                     //labelRotation:"45",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
                },
                valueAxes: [{
                    title: "{"单位"|L}({"人"|L})",
                    stackType:"none",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
              //  AxisBase:{
              //  tickLength:1
              //  },
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
                    balloonText: "<b><span style='color:#C72C95'>[[title]]</b></span><br><span style='font-size:14px'>[[value]]</b><br/>{"所占比例"|L}:[[percents]]%</span>",
                    labelPosition: "middle"
                }, {/if}
                {/foreach} 
                {
                  type: "line",
                    title: "{$smarty.request.total}",
                    valueField: "param{$sCount}",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]] [[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }
        // _live.addListener("clickGraphItem",live_ratio_table);
        {if $res.date_type == 'week'  || $res.date_type == 'month'}
          _live.addListener("clickGraphItem",live_ratio_table);
        {/if}
          {if $res.date_type == 'week' || $res.date_type == 'month'}
          function live_ratio_table(obj){
                var u = "";
                {foreach from=$res.title item=item1 key=key1}
                var c = "{$item1}";
                c = c.replace('#','');
                u +=  "{$key1}_"+c+"__";
                {/foreach}
                 // var time=obj.item.dataContext.week.split("~");
            //layer.alert(obj.item.dataContext.week);
            parent.layer.open({
                type: 2,
                title:"{"{$change_time['dateType']}"|L}{'信息'|L}",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
            {if $res.date_type == 'week'}
                content: "?m=report&a=next_info_histogram&date_type=day&ep_id={$res.ep_id}&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&start={$res.start}&end={$res.end}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}
            {if $res.date_type == 'month'}
                content: "?m=report&a=next_info_histogram&date_type=week&ep_id={$res.ep_id}&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&start={$res.start}&end={$res.end}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}

            });
        }
          {/if}
        </script>
<div class="live_ratio_table none">
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
     var tab=$("#freezedivTable3"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
    if($("div.picture_live").attr("class").indexOf("active") > 0){
            $("#_live").removeClass("none");
            $("div.picture_live").addClass("charts_picture_hover");
            $("div.live_ratio_table").addClass("none");
            $("div.table_live").addClass("charts_table");
        }else{
            $("#_live").addClass("none");
            $("div.live_ratio_table").removeClass("none");
            $("div.table_live").addClass("charts_table_hover");
            $("div.picture_live").addClass("charts_picture");
            $("div.picture_live").removeClass("charts_picture_hover");
        }
    $("div.table_live").bind("click",function(){
        $("div.table_live").addClass("charts_table_hover");
        $("div.picture_live").addClass("charts_picture");
        $("div.picture_live").removeClass("charts_picture_hover");
        $("div.live_ratio_table").removeClass("none");
        $("#_live").addClass("none");
        {*$.ajax({
            url:"?m=report&a=get_already_users",
            dataType:"html",
            success:function(res){
                $("div.content").html(res);
            }
        });*}
    });
$("div.picture_live").bind("click",function(){
    $("div.picture_live").addClass("charts_picture_hover");
    $("div.table_live").addClass("charts_table");
    $("div.table_live").removeClass("charts_table_hover");
    $("div.live_ratio_table").addClass("none");
    $("#_live").removeClass("none");
   {* $.ajax({
        url:"?m=report&a=report_item",
        dataType:"html",
        success:function(res){
            $("div.content").html(res);
        }
    });*}
    
});
$("div.day_live a").bind("click",function(){
    $("div.day_live a").css("color","#A83A39");
    $("div.week_live a").css("color","#121212");
    $("div.month_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_day_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"{"存活用户数"|L}",
                        name2:"{"遗失用户数"|L}",
                        name3:"{"累计用户数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"{"累计用户数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
$("div.week_live a").bind("click",function(){
    $("div.week_live a").css("color","#A83A39");
    $("div.day_live a").css("color","#121212");
    $("div.month_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_week_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"week",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"{"存活用户数"|L}",
                        name2:"{"遗失用户数"|L}",
                        name3:"{"累计用户数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"{"累计用户数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
$("div.month_live a").bind("click",function(){
    $("div.month_live a").css("color","#A83A39");
    $("div.day_live a").css("color","#121212");
    $("div.week_live a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_month_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_live",
                table_type:"live_ratio_table",
                index:"3",
                title:{
                        name1:"{"存活用户数"|L}",
                        name2:"{"遗失用户数"|L}",
                        name3:"{"累计用户数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"{"累计用户数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_live").html(res);
            }
        });
});
//$("div.day_live a").css("color","#A83A39");
$("div.live").bind("click",function(){
    $("div.live").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable3" class="base full">
        <tr class='none' style="width:730px;">
                {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
                <th width="150px">{"日期"|L}</th>
                {foreach name=arr_list item=item from=$arr_list}
                <th width="85px">{{$item.name}|L}</th>
                {/foreach}
            </tr>
            <tr  class='head'>
                <th width="150px">{"日期"|L}</th>
                {foreach name=arr_list item=item from=$arr_list}
                <th width="85px">{{$item.name}|L}</th>
                {/foreach}
            </tr>
            {foreach item=item key=key from=$arr}
            <tr>
                {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
                <td width="160px">{$item.date1}{if $res.date_type == 'week'}({"第"|L}{$key+1}{"周"|L}){/if}</td>
                {foreach item=item1 key=key1 from=$arr_list}
                {if $smarty.request.unit == "1"}
                {assign var=i value="bparam"|cat:$key1}
                {else}
                {assign var=i value="param"|cat:$key1}
                {/if}
                <td width="85px">{$item.$i}</td>
                {/foreach}
            </tr>
            {/foreach}
    </table>
    {if !$arr}
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
        $("div.day_live a").css("color","#A83A39");
    }
    {if !$arr}
        $("#_live").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>