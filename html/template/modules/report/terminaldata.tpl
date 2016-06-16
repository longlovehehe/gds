{strip}
<!--代理商企业三级联动-->
<script src="jQuerySelectMenu/fg.menu.js"></script>

{*<link type="text/css" href="jQuerySelectMenu/fg.menu.css" media="screen" rel="stylesheet" />*}
<link type="text/css" href="jQuerySelectMenu/theme/ui.all.css" media="screen" rel="stylesheet" />
<link type="text/css" href="style/autocomplete.css" media="screen" rel="stylesheet" />
<script src="./script/report/amcharts.js"></script>
<script src="./script/report/serial.js"></script>
<script src="./script/autocomplete.js"></script>
<style type="text/css">
{*	body { font-size:62.5%; margin:0; padding:0; }*}
	#menuLog { font-size:1.4em; margin:20px; }
	.hidden { position:absolute; top:0; left:-9999px; width:1px; height:1px; overflow:hidden; }
	
	.fg-button { clear:left; {*margin:0 4px 40px 20px;*} padding: 1px 0px 6px 0px; text-decoration:none !important; cursor:pointer; position: relative; text-align: center; zoom: 1; }
	.fg-button .ui-icon { position: absolute; top: 50%; margin-top: -8px; left: 50%; margin-left: -8px; }
	a.fg-button { }
	button.fg-button { width:auto; overflow:visible; } /* removes extra button width in IE */
	
	.fg-button-icon-left { padding-left: 2.1em; }
	.fg-button-icon-right { padding-right: 24px; }
	.fg-button-icon-left .ui-icon { right: auto; left: .2em; margin-left: 0; }
	.fg-button-icon-right .ui-icon { left: auto; right: .2em; margin-left: 0; }
	.fg-button-icon-solo { display:block; width:8px; text-indent: -9999px; }	 /* solo icon buttons must have block properties for the text-indent to work */	
	
	.fg-button.ui-state-loading .ui-icon { background: url(./jQuerySelectMenu/spinner_bar.gif) no-repeat 0 0; }
	</style>
{*	<script type="text/javascript"> $(function(){ $('<div style="position: absolute; top: 20px; right: 300px;" />').appendTo('body').themeswitcher(); }); </script>*}
	<script type="text/javascript"> 
                $(function() {

                       $('#remote_input').autocomplete({
	valueKey:'title',
	source:[{
		url:"?m=report&a=get_ep_ag_list",
		type:'remote',
		getValue:function(item){
			return item.title
		},
		ajax:{
			dataType : 'json'
		}
	}]
});
                    
{*                    $('#remote_input').autocomplete({
                    valueKey:'ag_number',
                    source:[{
                            url:"http://xdsoft.net/jquery-plugins/?task=demodata",
                            type:'remote',
                            getValueFromItem:function(item){
                                    return item.ag_number;
                            },
                            ajax:{
                                    dataType : 'json'	
                            }
                    }]});*}
                });
                  </script>

<form id="form" action="?m=report&a=report_item" method="post" data='{ "type" : "charts"}'>
    <input autocomplete="off"  name="modules" value="report" type="hidden" />
    <input autocomplete="off"  name="action" value="report_item" type="hidden" />
    <input autocomplete="off"  name="page" value="0" type="hidden" />
    <input autocomplete="off"  name="ep_id" value="" type="hidden" />
    <input autocomplete="off"  name="status" value="" type="hidden" />
    <input autocomplete="off"  name="e_or_ag_id" value="" type="hidden" />
    <!--选择条件-->
	{*<div class="toolbar mactoolbar ">
	&nbsp;
		<a href="javascript:void(0);" class="button open active" style="min-width: 80px;">{"开户数据"|L}</a>
		<a href="javascript:void(0);" class="button liveness" style="min-width: 80px;">{"活跃度"|L}</a>
		<a href="javascript:void(0);" class="button bissness" style="min-width: 80px;">{"业务数据"|L}</a>
		<a href="javascript:void(0);" class="button terminal" style="min-width: 80px;">{"终端"|L}</a>
		<a href="javascript:void(0);" class="button gprs_charts" style="min-width: 80px;">{"流量卡"|L}</a>
	</div>*}

    <div style="float:left;margin-right: 10px;">
            <span>{"选择目标"|L}：</span>
        <input type="text" class="form-control nothing" id="remote_input" value="OMP" style="width:191px;" placeholder="{"输入名称"|L}">
                <span class="input-group-btn">
                <a tabindex="0" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flyout">
                    <span class="ui-icon ui-icon-triangle-1-s"></span>
                    <span class="select_enterprise"></span>
                </a>
                <button id="open" class="btn btn-default none" type="button"><span class="caret"></span></button>
        </span>
    </div>
    <div class="select_time">
    <span>{"选择日期"|L}：</span>
        <input autocomplete="off" style="height:24px;" class="datepickerreport start nothing" name="start" type="text" value="{$start}" readonly/>
        <span>-</span>
        <input autocomplete="off" style="height:24px;" class="datepickerreport end nothing" name="end" type="text" value="{$end}"  {*datatime="true"*} readonly/>
{*	<div id="main">
		<div class="demo">
			<div id="city_5">
				<select name="lv1" class="prov" style="width:200px;height:28px;margin:5px 10px"></select>
				<select name="lv2" class="city" style="width:200px;height:28px;margin:5px 10px" disabled="disabled"></select>
				<select name="lv3" class="dist" style="width:200px;height:28px;margin:5px 10px" disabled="disabled"></select>
			</div>
		</div>
	</div>	*}		
    </div>
    <div style="clear:both;"></div>
	
    <div class="buttons right">
            <a form="form" class="button submit" >{"查询"|L}</a>
    </div>
</form>
    <hr style="margin:10px 0px;"/>
        {*<div class="toolbar mactoolbar open_data">
                 <div class="left">
                    <input name="already_open" type="checkbox" ><span>{"已开用户数"|L}</span>
                </div>
                 <div class="left">
                    <input name="commercial_users" type="checkbox" ><span>{"商用用户数"|L}</span>
                </div>
                 <div class="left">
                    <input name="live_ratio" type="checkbox" ><span>{"存活比例"|L}</span>
                </div>
                 <div class="left">
                    <input name="users" type="checkbox" ><span>{"已创建用户数"|L}&{"新创建用户数"|L}</span>
                </div>
                 <div class="left">
                    <input name="users_type" type="checkbox" ><span>{"用户类型"|L}</span>
                </div>
                 <div class="left">
                    <input name="users_validity" type="checkbox" ><span>{"用户有效性"|L}</span>
                </div>
                 <div style="clear:both;"></div>
            </div>
            <div class="toolbar mactoolbar live_data none">
                 <div class="left">
                    <input name="live_num" type="checkbox" ><span>{"在线人数"|L}</span>
                </div>
                 <div class="left">
                    <input name="live_sum" type="checkbox" ><span>{"累计在线人数"|L}</span>
                </div>
                 <div class="left">
                    <input name="liveness" type="checkbox" ><span>{"活跃度"|L}</span>
                </div>
                 <div style="clear:both;"></div>
            </div>
        <div class="toolbar mactoolbar bissness_data none">
                 <div class="left">
                    <input name="intercom_recording" type="checkbox" ><span>{"对讲记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="call_record" type="checkbox" ><span>{"单呼记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="video_record" type="checkbox" ><span>{"视频通话记录"|L}</span>
                </div>
                 <div style="clear:both;"></div>
            </div>*}
        <div class="toolbar mactoolbar terminal_data none">
{*                <div class="left">
                    <input name="intercom_recording" type="checkbox" ><span>{"对讲记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="call_record" type="checkbox" ><span>{"单呼记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="video_record" type="checkbox" ><span>{"视频通话记录"|L}</span>
                </div>
                 <div style="clear:both;"></div>*}
        </div>
        <div class="toolbar mactoolbar gprs_data none">
                {* <div class="left">
                    <input name="intercom_recording" type="checkbox" ><span>{"对讲记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="call_record" type="checkbox" ><span>{"单呼记录"|L}</span>
                </div>
                 <div class="left">
                    <input name="video_record" type="checkbox" ><span>{"视频通话记录"|L}</span>
                </div>
                 <div style="clear:both;"></div>*}
        </div>
<div class="content charts16 "></div>
<div class="content charts17 "></div>
{/strip}
