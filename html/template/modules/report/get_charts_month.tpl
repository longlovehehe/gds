    <div id="{$data_type}" style="height: 400px;width:750px;overflow-x: auto;"></div>
        {*<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
    <input type="hidden" name="json{$index}" value='{$json}'>
    <input type="hidden" name="u" value=''>
        <script>
        var {$data_type};
       makeCharts("light", "#E5E5E5",eval($("input[name=json{$index}]").val()));

        function makeCharts(theme, bgColor,data){
            // background
            if(document.body){
                document.body.style.backgroundColor = bgColor;
{*                document.body.style.backgroundImage = "url(" + bgImage + ")";*}
            }
            // column chart
            {$data_type} = AmCharts.makeChart("{$data_type}", {
                    type: "serial",
                    theme:theme,
                    dataProvider: data,//折线数据
                    categoryField: "date1",
                    startDuration: 1.5,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
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
{*                    startOnAxis: "true"*}
                },
                valueAxes: [{
                    title: "{"单位"|L}({"{$change_time['unit']}"|L})",
                    integersOnly:true,
                    {if $smarty.request.unit == 1}
                    unit:"%",
                    {/if}
                }],
                AxisBase:{
                tickLength:1
                },
                chartScrollbar: {
                autoGridCount:false,
              },
                graphs: [
                {if $data_type=='_liveness'}
                {
                    type: "line",
                    title: "{"活跃度"|L}",
                    valueField: "expenses",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"#A83A3A",
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "[[title]]:<b>[[value]]%<br/>活跃用户数:[[num]]</b>"
                }
                {else}
                {foreach from=$arr_list key=num item=item} 
                {
                   type: "line",
                    title: "{$item.name}",
                    valueField: "param{$num}",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineColor:"{$item.color}",
                    lineAlpha:1,
                    animationPlayed:true,
                    bullet: "round",
                    bulletSize:4,
                    balloonText: "[[title]]:<b>[[value]]</b>"
                }, 
                {/foreach} 
                {/if}
                ],
                legend: {
                    position:"top",
{*                    useGraphSettings: true,*}
                    marginRight:5,
                    marginLeft:5,
                    equalWidths:"false",
                    bulletType:"round",
                    valueWidth:50,
                    switchType:"v",
                    valueText:"",

                },
            });
                         {$data_type}.language = "zh";

        }
          {$data_type}.addListener("clickGraphItem",{$table_type});
         function {$table_type}(obj){
            // console.log(obj);
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
                content: "?{$url}&time="+obj.item.dataContext.date+"&u="+u
            });
        }
        </script>
<div class="{$table_type} none">
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
                $("div.table{$data_type}").removeClass("charts_picture_hover");
                $("div.{$table_type}").addClass("none");
                $("#{$data_type}").removeClass("none");
               {* $.ajax({
                    url:"?m=report&a=report_item",
                    dataType:"html",
                    success:function(res){
                        $("div.content").html(res);
                    }
                });*}

            });
           {* $("div.day").bind("click",function(){
                $("div.day").css("background","#fff");
                $("div.week").css("background","transparent");
                $("div.month").css("background","transparent");
                $.ajax({
                    url:"?m=report&a=get_day_info",
                    dataType:"html",
                    data:{
                        ep_id:$('input[name=ep_id]').val()
                        },
                     success:function(res){
                         //alert(123);
                         //$("input[name=json]").html(123);
                         $("input[name=action]").val("get_day_info");
                         //send();
                        }
                    });
            });
            $("div.week").bind("click",function(){
                $("div.week").css("background","#fff");
                $("div.day").css("background","transparent");
                $("div.month").css("background","transparent");

            });
            $("div.month").bind("click",function(){
                $("div.month").css("background","#fff");
                $("div.day").css("background","transparent");
                $("div.week").css("background","transparent");
            });*}
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
                <th width="150px">{"日期"|L}</th>
                {if $data_type=='_liveness'}
                <th width="85px">{"活跃度"|L}</th>
                {else}
                {foreach name=arr_list item=item from=$arr_list}
                <th width="85px">{{$item.name}|L}</th>
                {/foreach}
                {/if}
            </tr>
            <tr  class='head'>
                <th width="150px">{"日期"|L}</th>
                {if $data_type=='_liveness'}
                <th width="85px">{"活跃度"|L}</th>
                {else}
                {foreach name=arr_list item=item from=$arr_list}
                <th width="85px">{{$item.name}|L}</th>
                {/foreach}
                {/if}
            </tr>
             {if $data_type=='_liveness'}
            {foreach name=list item=item from=$arr}
            <tr>
                {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
                <td width="375px">{$item.date}</td>
                <td width="375px">{$item.expenses}%</td>
            </tr>
            {/foreach}
            {else}
            {foreach item=item key=key from=$arr}
            <tr>
                {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
                <td width="150px">{$item.date}({"第"|L}{$key+1}{"月"|L})</td>
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
            {/if}

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