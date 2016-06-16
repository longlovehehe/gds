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
    <div class="left">{"新增用户"|L}:{$sum}</div>
    <div class="right">
        <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class=" right_nav">&nbsp;&nbsp;</div>
        <div class="commercial right_nav table_commercial"></div>
        <div class="commercial right_nav picture_commercial active"></div>
        
    </div>
</div>
    <div class="get_day_info_commercial">
        <div id="_commercial" style="height: 400px;width:755px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
        <input type="hidden" name="json2" value='{$json}'>
{*        <script src="./script/report/amcharts.js"></script>
        <script src="./script/report/serial.js"></script>*}
        <script> 
        var _commercial;
        var chart2;
        
        makeCharts("light", "#E5E5E5",eval($("input[name=json2]").val()));

        function makeCharts(theme, bgColor, data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
{*                document.body.style.backgroundImage = "url(" + bgImage + ")";*}
            }
            // column chart
            _commercial = AmCharts.makeChart("_commercial", {
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
                    title: "{"单位"|L}({"人"|L})",
                    integersOnly:true,
                }],
                AxisBase:{
                tickLength:1
                },
                chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                {foreach from=$arr_list key=num item=item} 
                {
                    type: "line",
                    title: "{{$item.name}|L}",
                    valueField: "param{$num}",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"{$item.color}",
                    bullet: "round",
                    bulletSize:4,
                    animationPlayed:true,
                    balloonText: "[[title]]:<b>[[value]]</b>"
                },
                {/foreach} 
                ],
                legend: {
                     position:"top",
{*                    useGraphSettings: true,*}
                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    valueText:"",
                    switchType:"v",
                },
            });
                         _commercial.language = "th";

        }
        _commercial.addListener("clickGraphItem",commercial_users_table);
        /**
         * 点击事件显示详细信息
         */
        function commercial_users_table(obj){
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
<div class="commercial_users_table none">
   <script type="text/javascript"> 
    function fixupFirstRow(tab) {
        var div=tab.parent(); 

        if(div.attr("class")=="freezediv"){
            tab.children().children().eq(0).css("zIndex","999");
            tab.children().children().eq(0).css("position","absolute");
            div.scroll(function(){ 
                var tr = tab.children().children().eq(0); 
                tr.css("top" , div.scrollTop-20); 
            }); 
        }
    }
    $(function(){
     var tab=$("#freezedivTable2"); 
     if(tab){
            fixupFirstRow(tab); 
        } 
    });
     if($("div.picture_commercial").attr("class").indexOf("active") > 0){
            $("#_commercial").removeClass("none");
            $("div.picture_commercial").addClass("charts_picture_hover");
            $("div.commercial_users_table").addClass("none");
            $("div.table_commercial").addClass("charts_table");
        }else{
            $("#_commercial").addClass("none");
            $("div.commercial_users_table").removeClass("none");
            $("div.table_commercial").addClass("charts_table_hover");
            $("div.picture_commercial").addClass("charts_picture");
        }
    $("div.table_commercial").bind("click",function(){
        $("div.table_commercial").addClass("charts_table_hover");
        $("div.picture_commercial").addClass("charts_picture");
        $("div.picture_commercial").removeClass("charts_picture_hover");
        $("div.commercial_users_table").removeClass("none");
        $("#_commercial").addClass("none");
    });
$("div.picture_commercial").bind("click",function(){
    $("div.picture_commercial").addClass("charts_picture_hover");
    $("div.table_commercial").addClass("charts_table");
    $("div.table_commercial").removeClass("charts_table_hover");
    $("div.commercial_users_table").addClass("none");
    $("#_commercial").removeClass("none");
});
$("div.day_commercial a").bind("click",function(){
    $("div.day_commercial  a").css("color","#A83A39");
    $("div.week_commercial a").css("color","#121212");
    $("div.month_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"{"新增用户"|L}",
                        name2:"{"删除用户"|L}",
                        name3:"{"净增长"|L}",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});
$("div.week_commercial a").bind("click",function(){
    $("div.week_commercial a").css("color","#A83A39");
    $("div.day_commercial a").css("color","#121212");
    $("div.month_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"{"新增用户"|L}",
                        name2:"{"删除用户"|L}",
                        name3:"{"净增长"|L}",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});
$("div.month_commercial").bind("click",function(){
    $("div.month_commercial a").css("color","#A83A39");
    $("div.day_commercial a").css("color","#121212");
    $("div.week_commercial a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_commercial",
            table_type:"commercial_users_table",
            title:{
                        name1:"{"新增用户"|L}",
                        name2:"{"删除用户"|L}",
                        name3:"{"净增长"|L}",
                        color1:'#A83A3A',
                        color2:'#7ECEF4',
                        color3:'#FFE250'
                    },
            index:"2",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
            },
         success:function(res){
             $("div.get_day_info_commercial").html(res);
            }
        });
});

//$("div.day_commercial a").css("color","#A83A39");
$("div.commercial").bind("click",function(){
    $("div.commercial").each(function(){

        $(this).removeClass("active");
    });
    $(this).addClass("active");
});
</script>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable2" class="base full">
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
        $("div.day_commercial a").css("color","#A83A39");
    }
    {if !$arr}
        $("#_commercial").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>    