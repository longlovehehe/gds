<form class="data">
    <div class="freezediv3" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
        <table id="" class="base full" >
		<tr class="none">
			<th></th>
			<th>{"上线总人次"|L}<br>({"人次"|L})</th>
			<th>{"上线总时长"|L}<br>({"时/分/秒"|L})</th>
			<th>{"语音通话"|L}<br>({"时/分/秒"|L})</th>
			<th>{"视频通话"|L}<br>({"时/分/秒"|L})</th>
			<th>{"对讲通话"|L}<br>({"时/分/秒"|L})</th>
			<th>{"短信"|L}<br>({"条"|L})</th>
			<th>{"图片拍传"|L}<br>({"条"|L})</th>
		</tr>
            {foreach name=list item=item from=$list}
                <tr class="charts" u_number="{$item.u_number}">
                    <td title="{$item.u_name}" class="rich">{$item.u_name|mbsubstr:11}</td>
		<td class="rich">{$item.sdr_online_count}</td>
		<td class="rich">{$item.sdr_online_time}</td>
		<td class="rich">{$item.sdr_audio_time}</td>
		<td class="rich">{$item.sdr_video_time}</td>
		<td class="rich">{$item.sdr_ptt_time}</td>
		<td class="rich">{$item.sdr_send_sm_count}</td>
		<td class="rich">{$item.sdr_send_pic_count}</td>
                </tr>
            {/foreach}
        </table>
    </div>
	<br />
	<div class="select-info">{$list[0].ug_name}</div>
    <style>
        @font-face {
            font-family: 'Covered By Your Grace';
            font-style: normal;
            font-weight: 400;
            src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
        }
    </style>
<script>
	var OnetrObj=$("table.base.full tr.charts").eq(0);
	OnetrObj.addClass("visted");
	$("table.base.full tr.charts").on("click",function(){
		$("table.base.full tr.charts").removeClass("visted");
		$(this).addClass("visted");
		var u_number=$(this).attr("u_number");
		var checkp=$("select[name=checkp]").val();
		var checkdate=$("select[name=checkdate]").val();
		var day=$("input.datepickerreport.year").val();
		switch(checkdate){
			case '0'://年
				day=$("input.datepickerreport.year").val();
				break;
			case '1'://月
				day=$("input.datepickerreport.month").val();
				break;
			case '2'://周
				day=$("input.datepickerreport.week").val();
				break;
			case '3'://日
				day=$("input.datepickerreport.day").val();
				break;
		}
		var title=$(this).children().eq(0).attr("title");
		$("div.select-info").html(title);
		$.ajax({
			type:"POST",
			url:"?m=enterprise&a=get_data",
			data:{
				day:day,
				e_id:$("input[name=e_id]").val(),
				type:"user",
				u_number:u_number,
				checkdate:checkdate,
			},
			success:function(html){
				$("div.show-charts").html(html);
			}
		});
	});

</script>
<div class="show-charts">
    <div class="get_call_time" style="width: 370px;float: left;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title">{"通话时长"|L}：<span id="sum">{$sum}</span></div>
        </div>
        <!-- <div style="padding-top:12px;">{"总数"|L}：<span id="sum">{$sum}</span></div> -->
        <div id="get_call_time" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
        <script>
            var get_call_time;
            makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                // column chart
                get_call_time = AmCharts.makeChart("get_call_time", {
                    type: "pie",
                    theme: theme,
                    dataProvider: [{
                        "country": "语音",
                        "litres": "{$OneUserInfo.sdr_audio_time}"
                    }, {
                        "country": "视频",
                        "litres": "{$OneUserInfo.sdr_video_time}"
                    }, {
                        "country": "对讲",
                        "litres": "{$OneUserInfo.sdr_ptt_time}"
                    }],
                    titleField: "country",
                    valueField: "litres",
                    labelText:"",
                    colors:["#7ECEF4","#4CA3FC","#227BD6"],
                    outlineColor:"#ffffff",
                    outlineAlpha:1,
                    outlineThickness:0,
                    creditsPosition:"top-left",
                    startDuration:0,
                    {*                startEffect:"easeOutSine",*}
                    legend: {
                        position:"top",
                        valueText:"",
                        align: "left",
                        markerType: "square",
                    }
                });

            }

        </script>
    </div>
    <div class="get_call" style="width: 370px;float: right;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title">{"短信条数"|L}：<span id="sum">{$sum}</span></div>
        </div>
        <div id="get_call" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='{$json}'>
        <script>
            var get_call;
            makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                get_call = AmCharts.makeChart("get_call", {
                    type: "pie",
                    theme: theme,
                     dataProvider: [{
                        "country": "短信",
                        "litres": "{$OneUserInfo.sdr_send_sm_count}"
                    }, {
                        "country": "彩信",
                        "litres": "{$OneUserInfo.sdr_send_pic_count}"
                    }],
                    titleField: "country",
                    valueField: "litres",
                    labelText:"",
                    colors:["#56BA8A","#95E07E"],
                    outlineColor:"#ffffff",
                    outlineAlpha:1,
                    outlineThickness:0,
                    startDuration:0,
                    legend: {
                        position:"top",
                        valueText:"",
                        align: "left",
                        markerType: "square",
                    }
                });

            }
           
        </script>
    </div>
    <div style="clear: both;"></div>
</div>
</form>
<script>
	 function fixupFirstRow3(tab) {
                var div=tab.parent();

                if(div.attr("class")=="freezediv3"){
                    tab.children().children().eq(0).css("zIndex","1");
                    tab.children().children().eq(0).css("position","absolute");
                    tab.children().children().eq(0).css("width","735px");
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
                    fixupFirstRow3(tab);
                }
            });
</script>