<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{""|L}</title>
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
         <script src="script/jquery-1.11.1.min.js"></script>
         <script src="script/jquery.form.js"></script>
         <script src="layer/layer.js"></script>
         <script src="./script/report/amcharts.js"></script>
         <script src="./script/report/serial.js"></script>
         <script src="?m=lang"></script>
         <link  href="style/next_info_charts.css" rel="stylesheet" type="text/css" />
    </head>
    <body style="background-color:#fff;{$style}">
    <style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"></div>
    <div class="right">
        <div class="{$data_type} right_nav table{$data_type}"></div>
        <div class="{$data_type} right_nav picture{$data_type} active"></div>
    </div>
</div>
    <div class="get_day_info{$data_type}">
       <div id="{$data_type}" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
    <input type="hidden" name="json{$index}" value='{$json}' />
        <script>
        var {$data_type};
        makeCharts(eval($("input[name=json{$index}]").val()));
 function makeCharts(data){
           {$data_type} = AmCharts.makeChart("{$data_type}", {
                type: "serial",
                dataProvider: data,
                categoryField: "date1",
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
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
                valueAxes: [{
                    title: "{"单位"|L}({"{$change_time['unit']}"|L})",
                    stackType:"{$res.stackType}",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                {foreach from=$arr_list key=num item=item} 
                   {if $num<$sCount}
                {
                    title: "{$item.name}",
                    valueField: "param{$num}",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
                    lineColor: "{$item.color}",
                    animationPlayed:true,
                    balloonText: "<b>[[title]]</b>：<b>[[value]]</b>",
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
                },
            });
            }

        //点击进月 周 日
        {if $res.date_type == 'week'  || $res.date_type == 'month' || $res.date_type == 'year'}
          {$data_type}.addListener("clickGraphItem",{$table_type});
        {/if}
          {if $res.date_type == 'week' || $res.date_type == 'month' || $res.date_type == 'year'}
          function {$table_type}(obj){
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
                content: "?m=report&a=next_info_histogram&date_type=day&ep_id={$res.ep_id}&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}
            {if $res.date_type == 'month'}
                content: "?m=report&a=next_info_histogram&date_type=week&ep_id={$res.ep_id}&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}
            {if $res.date_type == 'year'}
                content: "?m=report&a=next_info_histogram&date_type=month&ep_id={$res.ep_id}&stackType=none&check_date={$check_date}&time="+obj.item.dataContext.date+"&data_type={$data_type}&table_type={$table_type}&index={$index}&total={$res.total}&u="+u
            {/if}

            });
        }
          {/if}
        
        </script>
<div class="{$table_type} none">
   <script type="text/javascript"> 
                function fixupFirstRow(tab) {
                    var div=tab.parent(); 

                    if(div.attr("class")=="freezediv"){
                        tab.children().children().eq(0).css("position","absolute");
                        div.scroll(function(){ 
                            var tr = tab.children().children().eq(0); 
                            tr.css("top" , div.scrollTop-20); 
                        }); 
                    }
                }
                $(function(){
                 var tab=$("#freezedivTable{$index}"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture{$data_type}").attr("class").indexOf("active") > 0){

                $("#{$data_type}").removeClass("none");
                $("div.{$table_type}").addClass("none");
                $("div.picture{$data_type}").addClass("charts_picture_hover");
                $("div.table{$data_type}").addClass("charts_table");
            }else{
                $("#{$data_type}").addClass("none");
                $("div.{$table_type}").removeClass("none");

                $("div.picture{$data_type}").addClass("charts_picture");
                $("div.table{$data_type}").addClass("charts_table_hover");
            }
            $("div.table{$data_type}").bind("click",function(){
                $("div.table{$data_type}").addClass("charts_table_hover");
                $("div.picture{$data_type}").addClass("charts_picture");
                $("div.picture{$data_type}").removeClass("charts_picture_hover");
                $("div.{$table_type}").removeClass("none");
                $("#{$data_type}").addClass("none");
                });
            $("div.picture{$data_type}").bind("click",function(){
                $("div.picture{$data_type}").addClass("charts_picture_hover");
                $("div.table{$data_type}").addClass("charts_table");
                $("div.table{$data_type}").removeClass("charts_table_hover");
                $("div.{$table_type}").addClass("none");
                $("#{$data_type}").removeClass("none");
            });
          
            $("div.{$data_type}").bind("click",function(){
                $("div.{$data_type}").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable{$index}" class="base full">
            <tr class='none' style="width:730px;">
                {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
                <th width="150px"></th>
                {foreach name=arr_list item=item from=$arr_list}
                <th width="85px"></th>
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
                <td width="160px">{if $smarty.request.date_type == 'week'}{$item.date1}({"第"|L}{$key+1}{"周"|L}){else}{$item.date}{/if}</td>
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
<script type="text/javascript">
$(function(){  
    {if !$arr}
        $("#{$data_type}").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script> 
    </body>
</html>