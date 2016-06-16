    <div id="{$data_type}" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
    <input type="hidden" name="json{$index}" value='{$json}'>
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
            clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
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
                    //fillColor: "#A83A3A",
                     //labelRotation:"45",
                    //startOnAxis: "true",
                    //equalSpacing: "true",
                    //minPeriod:"dd",
                   // parseDates:"true",
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
             {$data_type}.addListener("clickGraphItem",{$table_type});
   
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
                content: "?{$url}&time="+obj.item.dataContext.date+"&u="+u
            });
        }
        </script>
<div class="{$table_type} none">
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
                {if $data_type=='_term_type'}
                    //终端类型的列表、图的切换
                    $("#_term_type_data_table").hide();
                    $("#choose").show();
                    $("#_term_type_charts").show();
                {/if}
            }else{
                $("#{$data_type}").addClass("none");
                $("div.{$table_type}").removeClass("none");

                $("div.picture").addClass("charts_picture");
                $("div.table").addClass("charts_table_hover");
                {if $data_type=='_term_type'}
                    //终端类型的列表、图的切换
                    $("#_term_type_data_table").show();
                    $("#choose").hide();
                    $("#_term_type_charts").hide();
                {/if}
            }
            $("div.table{$data_type}").bind("click",function(){
                $("div.table{$data_type}").addClass("charts_table_hover");
                $("div.picture{$data_type}").addClass("charts_picture");
                $("div.picture{$data_type}").removeClass("charts_picture_hover");
                $("div.{$table_type}").removeClass("none");
                $("#{$data_type}").addClass("none");
                {if $data_type=='_term_type'}
                    //终端类型的列表、图的切换
                    $("#_term_type_data_table").show();
                    $("#choose").hide();
                    $("#_term_type_charts").hide();
                {/if}
                {*$.ajax({
                    url:"?m=report&a=get_already_users",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}
                });
            $("div.picture{$data_type}").bind("click",function(){
                $("div.picture{$data_type}").addClass("charts_picture_hover");
                $("div.table{$data_type}").addClass("charts_table");
                $("div.table{$data_type}").removeClass("charts_table_hover");
                $("div.{$table_type}").addClass("none");
                $("#{$data_type}").removeClass("none");
                {if $data_type=='_term_type'}
                    //终端类型的列表、图的切换
                    $("#_term_type_charts").css("width","749px");
                    
                    $("#_term_type_data_table").hide();
                    $("#choose").show();
                    $("#_term_type_charts").show();
                {/if}
            });
         
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
    <table  id="freezedivTable{$index}" class="base full">
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
                <td width="150px">{$item.date}({"第"|L}{$key+1}{"月"|L})</td>
                {foreach item=item1 key=key1 from=$arr_list}
                {assign var=i value="param"|cat:$key1}
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
{if $data_type=='_term_type'}
    <div style="margin-left:63px;" id="choose">
    <input type="hidden" name="json_mdt16" value='{$json_type}' />
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
                <th width="195px">{"日期"|L}</th>
                {foreach name=type_arr item=item from=$type_arr}
                <th width="85px">{{$item.name}|L}</th>
                {/foreach}

            </tr>
           {foreach item=item key=k from=$type_list}
            <tr>
                <td width="195px">{$arr_type[$k]['date1']}({"第"|L}{$k+1}{"月"|L})</td>
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
    var _term_type_charts;
    $("input[type=checkbox]").attr("checked","checked");
    makeCharts_term(eval($("input[name=json_mdt16]").val()));
        function makeCharts_term(data){
           _term_type_charts = AmCharts.makeChart("_term_type_charts", {
                type: "serial",
                dataProvider: data,
                categoryField: "date1",
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
                    gridPosition: "start",
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
                        date_type:"{$date_type}",
                        checktermdata:"checktermdata",
                        start:$("input[name=start]").val(),
                        end:$("input[name=end]").val(),
                        ep_id:$("input[name=ep_id]").val()
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
        {if $check_date!='day'}
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
{/if}
<script type="text/javascript">
$(function(){  
    {if !$arr}
        $("#{$data_type}").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>');
    {/if}
}); 
</script>