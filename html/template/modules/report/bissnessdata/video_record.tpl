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
    <div class="left">{"累计视频次数"|L}：{$total}</div>
    <div class="right">
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class="right_nav">&nbsp;</div>
        <div class="_video_record right_nav table_video_record"></div>
        <div class="_video_record right_nav picture_video_record active"></div>
        
    </div>
</div>
    <div class="get_day_info_video_record">
        <div id="_video_record" style="height: 400px;width:750px;overflow-x: auto;"></div>
        <input type="hidden" name="json14" value='{$json}'>
        <script> 
        var chart1;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json14]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
{*                document.body.style.backgroundImage = "url(" + bgImage + ")";*}
            }
            // column chart
            chart1 = AmCharts.makeChart("_video_record", {
               type: "serial",
                dataProvider: data,
                categoryField: "date1",
                //startDuration: 1.5,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
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
                    tickLength:3,
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
              //  AxisBase:{
              //  tickLength:1
              //  },
                graphs: [
                    {
                    title: "{"主叫"|L}",
                    valueField: "param1",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#CCE198",
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                }, 
                {
                   title: "{"被叫"|L}",
                    valueField: "param2",
                    type: "column",
                    columnWidth:0.8,
                    minVerticalGap:400,
                    lineAlpha: 0,
                    fillAlphas: 1,
                    animationPlayed:true,
                    lineColor: "#FF8888",
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                },
                {
                     type: "line",
                    title: "{"总数"|L}",
                    valueField: "param3",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]]：<b>[[value]]</b></span>"
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
        {if $res.date_type == 'week'  || $res.date_type == 'month'}
          chart1.addListener("clickGraphItem",video_record_table);
        {/if}
          {if $res.date_type == 'week' || $res.date_type == 'month'}
          function video_record_table(obj){
                var ep_id = $("input[name=ep_id]").val();
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
                content: "?m=report&a=next_info_histogram&date_type=day&ep_id="+ep_id+"&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}
            {if $res.date_type == 'month'}
                content: "?m=report&a=next_info_histogram&date_type=week&ep_id="+ep_id+"&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}

            });
        }
          {/if}
            </script>
<div class="video_record_table none">
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
     var tab=$("#freezedivTable14"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_video_record").attr("class").indexOf("active") > 0){
            $("#_video_record").removeClass("none");
            $("div.picture_video_record").addClass("charts_picture_hover");
            $("div.video_record_table").addClass("none");
            $("div.table_video_record").addClass("charts_table");
        }else{
            $("#_video_record").addClass("none");
            $("div.video_record_table").removeClass("none");
            $("div.table_video_record").addClass("charts_table_hover");
            $("div.picture_video_record").addClass("charts_picture");
        }
    $("div.table_video_record").bind("click",function(){
        $("div.table_video_record").addClass("charts_table_hover");
        $("div.picture_video_record").addClass("charts_picture");
        $("div.picture_video_record").removeClass("charts_picture_hover");
        $("div.video_record_table").removeClass("none");
        $("#_video_record").addClass("none");
    });
$("div.picture_video_record").bind("click",function(){
    $("div.picture_video_record").addClass("charts_picture_hover");
    $("div.table_video_record").addClass("charts_table");
    $("div.table_video_record").removeClass("charts_table_hover");
    $("div.video_record_table").addClass("none");
    $("#_video_record").removeClass("none");
    
});
$("div.day_video_record a").bind("click",function(){
    $("div.day_video_record a").css("color","#A83A39");
    $("div.week_video_record a").css("color","#121212");
    $("div.month_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"day",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"{"主叫"|L}",
                        name2:"{"被叫"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"{"总数"|L}",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
$("div.week_video_record a").bind("click",function(){
    $("div.week_video_record a").css("color","#A83A39");
    $("div.day_video_record a").css("color","#121212");
    $("div.month_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"week",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"{"主叫"|L}",
                        name2:"{"被叫"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"{"总数"|L}",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
$("div.month_video_record a").bind("click",function(){
    $("div.month_video_record a").css("color","#A83A39");
    $("div.day_video_record a").css("color","#121212");
    $("div.week_video_record a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"month",
            data_type:"_video_record",
            table_type:"video_record_table",
            index:"14",
            title:{
                        name1:"{"主叫"|L}",
                        name2:"{"被叫"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
            total:"{"总数"|L}",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_video_record").html(res);
            }
        });
});
//$("div.day_video_record a").css("color","#A83A39");
$("div._video_record").bind("click",function(){
    $("div._video_record").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable14" class="base full">
        <tr class='head' style="width:730px;">
            {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
            <th width="375px">{"日期"|L}</th>
            <th width="375px;">{"主叫"|L}</th>
            <th width="375px;">{"被叫"|L}</th>
            <th width="375px;">{"总数"|L}</th>
        </tr>
        <tr  class='head'>
            <th width="375px">{"日期"|L}</th>
            <th width="375px;">{"主叫"|L}</th>
            <th width="375px;">{"被叫"|L}</th>
            <th width="375px;">{"总数"|L}</th>
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
        $("div.day_video_record a").css("color","#A83A39");
    }
    {if !$list}
        $("#_video_record").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>   