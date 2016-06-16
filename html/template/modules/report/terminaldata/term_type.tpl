<style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left">{"累计终端数量"|L}：{$total}&nbsp;|&nbsp;{"累计商用终端数量"|L}：{$com_term}</div>
    <div class="right">
      <div class="right_nav {$change_time['month']}"><a href="javascript:void(0);">{"月"|L}</a></div>
        <div class="right_nav {$change_time['week']}"><a href="javascript:void(0);">{"周"|L}</a></div>
        <div class="right_nav {$change_time['day']}"><a href="javascript:void(0);">{"日"|L}</a></div>
        <div class="right_nav">&nbsp;</div>
        <div class="_term_type right_nav table_term_type"></div>
        <div class="_term_type right_nav picture_term_type active"></div>
    </div>
</div>
    <div class="get_day_info_term_type">
       <div id="_term_type" style="height: 400px;width:750px;overflow-x: auto;"></div>
       
       
        <!-- {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*} -->
    <input type="hidden" name="json16" value='{$json}' />
    <input type="hidden" name="json_mdt16" value='{$json_type}' />
        <script>
            $("input[type=checkbox]").attr("checked","checked");
        var _term_type;
        var _term_type_charts;
        makeCharts(eval($("input[name=json16]").val()));
 function makeCharts(data){
           _term_type = AmCharts.makeChart("_term_type", {
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
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
                /*{*angle:30,
                depth3D:15,*}*/
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
                    //stackType:"{$res.stackType}",
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
                    lineColor:"#B0DE09",
                    bullet: "round",
                    animationPlayed:true,
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
          /*_term_type.addListener("clickGraphItem",term_type_table);
        function term_type_table(obj){
            console.log(obj);
        }*/
            
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


            makeCharts_term(eval($("input[name=json_mdt16]").val()));
        function makeCharts_term(data){
           _term_type_charts = AmCharts.makeChart("_term_type_charts", {
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
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
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
                valueAxes: [{
                    title: "{"单位"|L}({"{$change_time['unit']}"|L})",
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                {foreach from=$type_arr key=num item=item} 
                    {
                    title: "{$item['name']}",
                    valueField: "param{$item['name']}",
                    type: "line",
                     lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    //lineColor: "{$item.color}",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<b><span style=''>[[title]]</b></span><span>：<b>[[value]]</b></span>",
                    //labelPosition: "middle"     color:{$title.color1}
                },
                {/foreach} 
                ],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }

            
              //选择商用和测试
            var condition='com&test';
            $("input[type=checkbox]").on("click",function(){
                var date_type = "{$res.date_type}";
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
                    url:"?m=report&a=get_term_type_data",
                    dataType:"json",
                    data:{
                        u_attr_type:condition,
                        date_type:"{$res.date_type}",
                        start:$("input[name=start]").val(),
                        end:$("input[name=end]").val(),
                        ep_id:$('input[name=ep_id]').val()
                    },
                    success:function(res){
                        //$("#_term_type_charts").hmtl("");
                        makeCharts_term(res);
                        if(date_type!='day'){
                            _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
                        }
                    }
                });
                
            });

        //终端类型的年 月 周 日 切换
        {if $res['date_type']!='day'}
        _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
        {/if}

        function term_type_charts_table(obj){
            var ep_id = $("input[name=ep_id]").val();
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
                content: "?m=report&a=next_info_charts&date_type={$change_time['check_date']}&check_date={$check_date}&data_type=_term_type_data&table_type=term_type_data_table&index=666&ep_id="+ep_id+"&stackType=none&total=total&time="+obj.item.dataContext.date
            });
        }
        
        $("input[name=commercial]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-com");
                }else{
                    $(this).parent().removeClass("background-com");
                     $(this).parent().addClass("background-none");
                }
        });
        
        $("input[name=test]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-test");
                }else{
                    $(this).parent().removeClass("background-test");
                     $(this).parent().addClass("background-none");
                }
        });

        </script>
<div class="term_type_table none">
   <script type="text/javascript"> 
                function fixupFirstRow(tab) {
                    var div=tab.parent(); 

                    if(div.attr("class")=="freezediv"){
                     //{* tab.children().children().eq(0).css("zIndex","999");*}
                        tab.children().children().eq(0).css("position","absolute");
                        div.scroll(function(){ 
                            var tr = tab.children().children().eq(0); 
                            tr.css("top" , div.scrollTop-20); 
                            //{*tr.css("left",-1); *}
                        }); 
                    }
                }
                $(function(){
                 var tab=$("#freezedivTable16"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_term_type").attr("class").indexOf("active") > 0){

                $("#_term_type").removeClass("none");
                $("div.term_type_table").addClass("none");
                $("div.picture_term_type").addClass("charts_picture_hover");
                $("div.table_term_type").addClass("charts_table");
            }else{
                $("#_term_type").addClass("none");
                $("div.term_type_table").removeClass("none");

                $("div.picture_term_type").addClass("charts_picture");
                $("div.table_term_type").addClass("charts_table_hover");
            }
            $("div.table_term_type").bind("click",function(){
                $("div.table_term_type").addClass("charts_table_hover");
                $("div.picture_term_type").addClass("charts_picture");
                $("div.picture_term_type").removeClass("charts_picture_hover");
                $("div.term_type_table").removeClass("none");
                //终端类型的列表、图的切换
                $("#_term_type_data_table").show();
                $("#choose").hide();
                $("#_term_type_charts").hide();

                $("#_term_type").addClass("none");
                /*{*$.ajax({
                    url:"?m=report&a=get_already_users",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}*/
                });
            $("div.picture_term_type").bind("click",function(){
                $("div.picture_term_type").addClass("charts_picture_hover");
                $("div.table_term_type").addClass("charts_table");
                $("div.table_term_type").removeClass("charts_table_hover");
                $("div.term_type_table").addClass("none");
                $("#_term_type").removeClass("none");
                //终端类型的列表、图的切换
                $("#_term_type_data_table").hide();
                $("#choose").show();
                $("#_term_type_charts").show();
               /*{* $.ajax({
                    url:"?m=report&a=report_item",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}*/

            });

//切换天
$("div.day_term_type a").bind("click",function(){
    $("div.day_term_type a").css("color","#A83A39");
    $("div.week_term_type a").css("color","#121212");
    $("div.month_term_type a").css("color","#121212");
    //终端数据 #7ECEF4  #BAE4F8
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
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
            $("div.get_day_info_term_type").html(res);
        }
    });
});

//切换周
$("div.week_term_type a").bind("click",function(){
    $("div.week_term_type a").css("color","#A83A39");
    $("div.day_term_type a").css("color","#121212");
    $("div.month_term_type a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
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
            $("div.get_day_info_term_type").html(res);
        }
    });
});

//切换月
$("div.month_term_type a").bind("click",function(){
    $("div.month_term_type a").css("color","#A83A39");
    $("div.day_term_type a").css("color","#121212");
    $("div.week_term_type a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
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
            $("div.get_day_info_term_type").html(res);
        }
    });
});
            $("div._term_type").bind("click",function(){
                $("div._term_type").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
            
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
        <table  id="freezedivTable16" class="base full">
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
           {foreach item=item key=k from=$arr}
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
<div style="margin-left:63px;" id="choose">
    <div class="piaochecked background-com on_check">
        <input name="commercial" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
    </div>
    <div class="checked">{"商用"|L}</div>
    <div class="piaochecked background-test on_check" style="margin-left:12px">
        <input name="test" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
    </div>
    <div class="checked">{"测试"|L}</div>
</div>
<div id="_term_type_charts" style="height: 400px;width:750px;overflow-x: auto;"></div>

<!-- 终端类型 106ZW 120WZ table... -->
<div class="freezediv" id="_term_type_data_table" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;display: none;">
    <table  id="freezedivTable16" class="base full">
        <tr class='head' style="width:730px;">
            <th width="205px">{"日期"|L}</th>
            {foreach name=type_arr item=item from=$type_arr}
            <th width="85px">{{$item.name}|L}</th>
            {/foreach}

        </tr>
       {foreach item=item key=k from=$type_list}
        <tr>
            {if $res['date_type']=='week'}
            <td width="205px">{$arr_type[$k]['date1']}<br />({"第"|L}{$k+1}{"周"|L})</td>
            {elseif $res['date_type']=='month'}
            <td width="205px">{$arr_type[$k]['date1']}({"第"|L}{$k+1}{"月"|L})</td>
            {else}
            <td width="205px">{$item.create_time}</td>
            {/if}
            {foreach item=item1 key=key1 from=$type_arr}
            {assign var=i value=$type_arr[$key1]['name']}
            <td width="85px">
                {if !isset($item.$i)}
                -
                {else}
                {$item.$i}
                {/if}
            </td>
            {/foreach}
        </tr>
        {/foreach}
    </table>
    {if !$type_list}
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
    {/if}
</div>


<script type="text/javascript">
$(function(){  
    var checked = "{$change_time['checked']}";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_term_type a").css("color","#A83A39");
    }
    {if !$arr}
        $("#_term_type").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>