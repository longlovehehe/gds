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
    <div class="left">{"累计对讲次数"|L}：{$total}</div>
    <div class="right">
    <!-- day_intercom_recording -->
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class="right_nav">&nbsp;</div>
        <div class="_intercom_recording right_nav table_intercom_recording"></div>
        <div class="_intercom_recording right_nav picture_intercom_recording active"></div>
        
    </div>
</div>
    <div class="get_day_info_intercom_recording">
        <div id="_intercom_recording" style="height: 400px;width:750px;overflow-x: auto;"></div>
        <input type="hidden" name="json10" value='{$json}'>
        <script> 
        var chart1;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json10]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
{*                document.body.style.backgroundImage = "url(" + bgImage + ")";*}
            }
            // column chart
            chart1 = AmCharts.makeChart("_intercom_recording", {
                type: "serial",
                theme:theme,
                dataProvider: data,//折线数据
                categoryField: "date1",
                startDuration: 1.5,
               chartCursor:{
                   zoomable: false,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },

                categoryAxis: {
                    gridPosition: "middle",
                    fillColor: "#A83A3A",
                    autoGridCount: "false",
                    gridCount:data.length,
                    labelRotation:"45",
{*                    startOnAxis: "true",*}
                },
                valueAxes: [{
                    title: "{"单位"|L}({"{$change_time['unit']}"|L})",
                    integersOnly:true,
                }],
                AxisBase:{
                tickLength:1
                },
                chartScrollbar: {
                autoGridCount:false,
              },
                graphs: [
                {
                    type: "line",
                    title: "{"对讲次数"|L}",
                    valueField: "param1",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"#F7B249",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "[[title]]：<b>[[value]]</b>" //<br><b>[[date]]</b>
                }],
                legend: {
                    position:"top",
                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    switchType:"v",
                    valueText:"",
                },
            });

        }
        chart1.addListener("clickGraphItem",intercom_recording_table);
        /**
         * 点击事件显示详细信息
         */
        function intercom_recording_table(obj){
            console.log(obj);
            {if $res.date_type == 'week' || $res.date_type == 'month'}
            var u = "";
            {foreach from=$res.title item=item1 key=key1}
            var c = "{$item1}";
            c = c.replace('#','');
            u +=  "{$key1}_"+c+"__";
            {/foreach}
            layer.open({
                type: 2,
                title:"{"{$change_time['dateType']}"|L}{'信息'|L}",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
                content: '?{$url}&time='+obj.item.dataContext.date+'&u='+u
            });
            {/if}
        }
        </script>
<div class="intercom_recording_table none">
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
    var tab=$("#freezedivTable10"); 
    if(tab){
        fixupFirstRow(tab); 
    }
});

     if($("div.picture_intercom_recording").attr("class").indexOf("active") > 0){
            $("#_intercom_recording").removeClass("none");
            $("div.picture_intercom_recording").addClass("charts_picture_hover");
            $("div.intercom_recording_table").addClass("none");
            $("div.table_intercom_recording").addClass("charts_table");
        }else{
            $("#_intercom_recording").addClass("none");
            $("div.intercom_recording_table").removeClass("none");
            $("div.table_intercom_recording").addClass("charts_table_hover");
            $("div.picture_intercom_recording").addClass("charts_picture");
        }
    $("div.table_intercom_recording").bind("click",function(){
        $("div.table_intercom_recording").addClass("charts_table_hover");
        $("div.picture_intercom_recording").addClass("charts_picture");
        $("div.picture_intercom_recording").removeClass("charts_picture_hover");
        $("div.intercom_recording_table").removeClass("none");
        $("#_intercom_recording").addClass("none");
    });
$("div.picture_intercom_recording").bind("click",function(){
    $("div.picture_intercom_recording").addClass("charts_picture_hover");
    $("div.table_intercom_recording").addClass("charts_table");
    $("div.table_intercom_recording").removeClass("charts_table_hover");
    $("div.intercom_recording_table").addClass("none");
    $("#_intercom_recording").removeClass("none");
});
$("div.day_intercom_recording a").bind("click",function(){
    $("div.day_intercom_recording a").css("color","#A83A39");
    $("div.week_intercom_recording a").css("color","#121212");
    $("div.month_intercom_recording a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"day",
            data_type:"_intercom_recording",
            table_type:"intercom_recording_table",
            index:"10",
            title:{
                        name1:"{"对讲次数"|L}",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_intercom_recording").html(res);
            }
        });
});
$("div.week_intercom_recording a").bind("click",function(){
    $("div.week_intercom_recording a").css("color","#A83A39");
    $("div.day_intercom_recording a").css("color","#121212");
    $("div.month_intercom_recording a").css("color","#121212");
    //alert($('select[name=checkp]').val());
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"week",
            data_type:"_intercom_recording",
            table_type:"intercom_recording_table",
            index:"10",
            title:{
                        name1:"{"对讲次数"|L}",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_intercom_recording").html(res);
            }
        });
});
$("div.month_intercom_recording a").bind("click",function(){
    $("div.month_intercom_recording a").css("color","#A83A39");
    $("div.day_intercom_recording a").css("color","#121212");
    $("div.week_intercom_recording a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            checkp:$('select[name=checkp]').val(),
            date_type:"month",
            data_type:"_intercom_recording",
            table_type:"intercom_recording_table",
            index:"10",
            title:{
                        name1:"{"对讲次数"|L}",
                        color1:'#F7B249'
                    },
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_intercom_recording").html(res);
            }
        });
});

$("div._intercom_recording").bind("click",function(){
    $("div._intercom_recording").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});

</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable10" class="base full">
        <tr class='head' name="title" style="width:730px;z-index: -1;">
            {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
            <th width="375px">{"日期"|L}</th>
            <th width="375px;">{"对讲次数"|L}</th>
        </tr>
        <tr  class='head' name="title" style="width:730px;z-index: -1;">
            <th width="375px">{"日期"|L}</th>
            <th width="375px">{"对讲次数"|L}</th>
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
        $("div.day_intercom_recording a").css("color","#A83A39");
    }

    $("tr[name=title]").css('z-index','-999');
    {if !$list}
        $("#_intercom_recording").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>