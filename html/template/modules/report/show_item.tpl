<form class="data">
	<div class="tablecharts">
		<div class="table-th" width="">{$item_e.e_name}</div>
		<div class="table-th">{$epInfo.otherInfo.sdr_online_count}</div>
		<div class="table-th">{$epInfo.otherInfo.sdr_online_time}</div>
		<div class="table-th">{$epInfo.callTime.sdr_audio_time}</div>
		<div class="table-th">{$epInfo.callTime.sdr_video_time}</div>
		<div class="table-th">{$epInfo.callTime.sdr_ptt_time}</div>
		<div class="table-th">{$epInfo.infoNum.sdr_send_sm_count}</div>
		<div class="table-th">{$epInfo.infoNum.sdr_send_pic_count}</div>
	</div>
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
	<table class="base full" >
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
		<tr class="none">
			<td>{$item_e.e_name}</td>
			<td>{$epInfo.otherInfo.sdr_online_count}</td>
			<td>{$epInfo.otherInfo.sdr_online_time}</td>
			<td>{$epInfo.callTime.sdr_audio_time}</td>
			<td>{$epInfo.callTime.sdr_video_time}</td>
			<td>{$epInfo.callTime.sdr_ptt_time}</td>
			<td>{$epInfo.infoNum.sdr_send_sm_count}</td>
			<td>{$epInfo.infoNum.sdr_send_pic_count}</td>
		</tr>
		{foreach name=list item=item from=$list}
		<tr class="charts" ug_id="{$item.ug_id}">
			<td title="{$item.ug_name}" class="rich">{$item.ug_name|mbsubstr:11}</td>
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
	<div class="select-info">{$item_e.e_name}</div>
    <style>
        @font-face {
            font-family: 'Covered By Your Grace';
            font-style: normal;
            font-weight: 400;
            src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
        }
    </style>
	<script>
		$("table.base.full tr.charts").unbind("click").on("click",function(){
			$("table.base.full tr.charts").removeClass("visted");
			$(this).addClass("visted");
			var ug_id=$(this).attr("ug_id");
			var checkp=$("select[name=checkp]").val();
			var checkdate=$("select[name=checkdate]").val();
			var day=$("input.datepickerreport.year").val();
			var type="usergroup";
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
			if($(this).attr("class").indexOf("head")>=0){
				type="enterprise";
			}
			var title=$(this).children().eq(0).attr("title");
			$("div.select-info").html(title);
			$.ajax({
				type:"POST",
				url:"?m=enterprise&a=get_data",
				data:{
					ug_id:ug_id,
					day:day,
					e_id:$("input[name=e_id]").val(),
					type:type,
					checkdate:checkdate,
					
				},
				dataType:"html",
				success:function(html){
					$("div.show-charts").html(html);
				}
			});
		});
	$("div.tablecharts").on("click",function(){
		$("a.submit").trigger("click");
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
                        "type": "语音",
                        "value": "{$epInfo.callTime.sdr_audio_time}"
                    }, {
                        "type": "视频",
                        "value": "{$epInfo.callTime.sdr_video_time}"
                    }, {
                        "type": "对讲",
                        "value": "{$epInfo.callTime.sdr_ptt_time}"
                    }],
                    export: {
                        "enabled": true,
                        {*"menu": [ {
                            "class": "export-main",
                            "menu": [ {
                                "label": "Download",
                                "menu": [ "PNG", "JPG" ]
                            }, {
                                "label": "Annotate",
                                "action": "draw",
                                "menu": [ {
                                    "class": "export-drawing",
                                    "menu": [ "PNG", "JPG", "CANCEL" ]
                                } ]
                            } ]
                        } ]*}
                    },
                    titleField: "type",
                    valueField: "value",
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
                        "type": "短信",
                        "value": "{$epInfo.infoNum.sdr_send_sm_count}"
                    }, {
                        "type": "彩信",
                        "value": "{$epInfo.infoNum.sdr_send_pic_count}"
                    }],
                    titleField: "type",
                    valueField: "value",
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
