<style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left">{"累计流量卡数量"|L}：{$total}&nbsp;|&nbsp;{"累计商用流量卡数量"|L}：{$com_gprs}</div>
    <div class="right">
      <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class="right_nav">&nbsp;</div>
        <div class="_gprs_type right_nav table_gprs_type"></div>
        <div class="_gprs_type right_nav picture_gprs_type active"></div>
    </div>
</div>
    <div class="get_day_info_gprs_type">
       <div id="_gprs_type" style="height: 400px;width:750px;overflow-x: auto;"></div>
       {*<div>
           <input type="checkbox" name="commercial">{"商用"|L}
           <input type="checkbox" name="test">{"测试"|L}
       </div>*}
{*       <div id="_gprs_type_charts" style="height: 400px;width:750px;overflow-x: auto;"></div>*}
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
    <input type="hidden" name="json18" value='{$json}' />
    <input type="hidden" name="json_mdt18" value='{$json}' />
        <script>
            $("input[type=checkbox]").attr("checked","checked");
        var _gprs_type;
        var _gprs_type_charts;
        makeCharts(eval($("input[name=json18]").val()));
 function makeCharts(data){
           _gprs_type = AmCharts.makeChart("_gprs_type", {
                type: "serial",
                dataProvider: data,
                {if $res['date_type']=='week'||$res['date_type']=='month'}
                categoryField: "date1",
                {else}
                categoryField: "date",
                {/if}
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
                    stackType:"none",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
        chartScrollbar: {
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
                    animationPlayed:true,
                    lineColor: "{$item.color}",
                    /*balloonText: "<b><span style='color:{$item.color}'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",*/
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
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
          //切换月->周 
          {if $res['date_type']!='day'}
            {$data_type}.addListener("clickGraphItem",{$table_type});
          {/if}
   
            function {$table_type}(obj){
                var u = "";
                {foreach from=$res.title item=item1 key=key1}
                var c = "{$item1}";
                c = c.replace('#','');
                u +=  "{$key1}_"+c+"__";
                {/foreach}
                 // var time=obj.item.dataContext.month.split("~");
                //layer.alert(obj.item.dataContext.week);
                layer.open({
                    type: 2,
                    title:"{"{$change_time['dateType']}"|L}{'信息'|L}",
                    area: ['800px', '500px'],
                    fix: false, //不固定
                    maxmin: false,
                    content: "?{$url}&check_date={$check_date}&time="+obj.item.dataContext.date+"&u="+u
                });
            }


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
                    url:"?m=report&a=get_gprs_type_data",
                    dataType:"json",
                    data:{
                        u_attr_type:condition,
                        date_type:'month'
                    },
                    success:function(res){
                        //$("#_gprs_type_charts").hmtl("");
                        makeCharts_term(res);
                    }
                });
                
            });
           
        </script>
<div class="gprs_type_table none">
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
                 var tab=$("#freezedivTable18"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_gprs_type").attr("class").indexOf("active") > 0){

                $("#_gprs_type").removeClass("none");
                $("div.gprs_type_table").addClass("none");
                $("div.picture_gprs_type").addClass("charts_picture_hover");
                $("div.table_gprs_type").addClass("charts_table");
            }else{
                $("#_gprs_type").addClass("none");
                $("div.gprs_type_table").removeClass("none");

                $("div.picture_gprs_type").addClass("charts_table_hover");
                $("div.table_gprs_type").addClass("charts_picture");
            }
            $("div.table_gprs_type").bind("click",function(){
                $("div.table_gprs_type").addClass("charts_table_hover");
                $("div.picture_gprs_type").addClass("charts_picture");
                $("div.picture_gprs_type").removeClass("charts_picture_hover");
                $("div.gprs_type_table").removeClass("none");
                $("#_gprs_type").addClass("none");
                {*$.ajax({
                    url:"?m=report&a=get_already_users",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}
                });
            $("div.picture_gprs_type").bind("click",function(){
                $("div.picture_gprs_type").addClass("charts_picture_hover");
                $("div.table_gprs_type").addClass("charts_table");
                $("div.table_gprs_type").removeClass("charts_table_hover");
                $("div.gprs_type_table").addClass("none");
                $("#_gprs_type").removeClass("none");
               {* $.ajax({
                    url:"?m=report&a=report_item",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}

            });
$("div.day_gprs_type a").bind("click",function(){
    $("div.day_gprs_type a").css("color","#A83A39");
    $("div.week_gprs_type a").css("color","#121212");
    $("div.month_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_day_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"{"商用"|L}",
                        name2:"{"测试"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"{"总数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
$("div.week_gprs_type a").bind("click",function(){
    $("div.week_gprs_type a").css("color","#A83A39");
    $("div.day_gprs_type a").css("color","#121212");
    $("div.month_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_week_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"week",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"{"商用"|L}",
                        name2:"{"测试"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"{"总数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
$("div.month_gprs_type a").bind("click",function(){
    $("div.month_gprs_type a").css("color","#A83A39");
    $("div.day_gprs_type a").css("color","#121212");
    $("div.week_gprs_type a").css("color","#121212");
    $.ajax({
            url:"?m=report&a=get_month_info",
            dataType:"html",
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                index:"18",
                title:{
                        name1:"{"商用"|L}",
                        name2:"{"测试"|L}",
                        name3:"{"总数"|L}",
                        color1:'#CCE198',
                        color2:'#FF8888',
                        color3:'#B0DE09'
                    },
                total:"{"总数"|L}",
                stackType:"none",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.get_day_info_gprs_type").html(res);
            }
        });
});
            $("div._gprs_type").bind("click",function(){
                $("div._gprs_type").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
{*            
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
                    url:"?m=report&a=get_gprs_type_data",
                    dataType:"html",
                    data:{
                        u_attr_type:condition
                    },
                    success:function(res){
                        //$("#_gprs_type_charts").hmtl("");
                        makeCharts_gprs(eval(res));
                    }
                });
                
            });*}
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable18" class="base full">
        <tr class='head' style="width:730px;">
            <th width="375px">{"日期"|L}</th>
            {foreach name=arr_list item=item from=$arr_list}
            <th width="375px">{{$item.name}|L}</th>
            {/foreach}

        </tr>
        <tr  class='head'>
            <th width="375px">{"日期"|L}</th>
            {foreach name=arr_list item=item from=$arr_list}
            <th width="375px">{{$item.name}|L}</th>
            {/foreach}
        </tr>
       {foreach item=item from=$arr}
        <tr>
            {if $res['date_type']=='week'}
            <td width="375px">{$item.date1}({"第"|L}{$k+1}{"周"|L})</td>
            {elseif $res['date_type']=='month'}
            <td width="375px">{$item.date1}({"第"|L}{$k+1}{"月"|L})</td>
            {else}
            <td width="375px">{$item.date}</td>
            {/if}
            {foreach item=item1 key=key1 from=$arr_list}
            {assign var=i value="param"|cat:$key1}
            <td width="375px">{$item.$i}</td>
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
    var checked = "{$change_time['checked']}";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_gprs_type a").css("color","#A83A39");
    }
     
    {if !$arr}
        $("#_gprs_type").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>