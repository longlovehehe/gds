{strip}
{*{include file="modules/enterprise/nav.tpl" }*}
    <link type="text/css" href="style/autocomplete.css" media="screen" rel="stylesheet" />
{*<link type="text/css" href="./script/report/export/export.css" media="screen" rel="stylesheet" />*}
    <script src="./script/report/amcharts.js"></script>
    <script src="./script/report/pie.js"></script>
{*    <script src="./script/plugins/tableExport/jquery.base64.js"></script>*}
    <script src="./script/plugins/tableExport/jquery.table2excel.js"></script>
{*    <script src="./script/report/export/export.js"></script>*}
    <script src="./script/autocomplete.js"></script>
{*    <script src="./script/plugins/datepicker/bootstrap.js"></script>*}
{*    <script src="./script/plugins/datepicker/bootstrap-datetimepicker.js"></script>*}
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
<div class="toptoolbar">
{*    <a href="?m=enterprise&a=users_save&e_id={$data.e_id}" class="button orange">{"新增企业用户"|L}</a>
    <a href="?m=enterprise&a=users_auto_save&e_id={$data.e_id}" class="button orange">{"批量新增企业用户"|L}</a>*}
</div>
<div class="toolbar">
    <form action="?m=enterprise&a=users_item&e_id={$data.e_id}" id="form" method="post" >
        <input autocomplete="off"  name="modules" value="enterprise" type="hidden" />
        <input autocomplete="off"  name="action" value="charts_item" type="hidden" />
        <input autocomplete="off"  name="e_id" value="{$data.e_id}" type="hidden" />
        <input autocomplete="off"  name="page" value="{$page}" type="hidden" />

        <div class="condition-seacher block" style="margin-right: 10px;">
            <label>{"查询目标"|L}：</label>
            <select name='checkp' class="select-condition" style="border:1px solid #CCCCCC;height:32px; margin-left: 1px;width: 80px;">
                <option value="0">EMP</option>
                <option value="1">{"部门"|L}</option>
                <option value="2">{"个人"|L}</option>
            </select>
            <input type="text" class="form-control emp" value="EMP" style="width:191px;height:20px;border: 1px solid #bfbfbf;" placeholder="{"输入名称"|L}" readonly>
            <select class="form-control usergroup none" name="u_ug_id" style="width:223px;height:32px;border:1px solid #bfbfbf;">
                {foreach name=usergroup item=group from=$usergroup}
                    <option value="{$group.ug_id}">{$group.ug_name}</option>
                {/foreach}
            </select>
            <input type="text" class="form-control oneuser none" id="remote_input" name="u_name" style="width:191px;height:20px;border: 1px solid #bfbfbf;" placeholder="{"输入名称"|L}" />
        </div>
        <div class="select_time block">
            <label>{"查询日期"|L}：</label>
            <select name='checkdate' class="select-condition" style="border:1px solid #CCCCCC;height:32px; margin-left: 1px;width: 80px;">
                <option value="0">{"年"|L}</option>
                <option value="1">{"月"|L}</option>
                <option value="2">{"周"|L}</option>
                <option value="3">{"日"|L}</option>
            </select>
            <span class="add-on"><i class="icon-calendar"></i></span>
            <input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport year inputnothing" name="year" type="text" value="{date('Y',strtotime("-1 day"))}" readonly />
            <input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport month inputnothing none" name="month" type="text" value="{date('Y-m',strtotime("-1 day"))}" readonly />
            <input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport week inputnothing none" name="week" type="text" value="{date('Y-m-d',time()-86400*date("N",time()))}" readonly />
            <input autocomplete="off" style="width:191px;height:20px;border: 1px solid #bfbfbf;" class="datepickerreport day inputnothing none" name="day" type="text" value="{date('Y-m-d',strtotime("-1 day"))}" readonly />
        </div>
        <div style="clear:both;"></div>
        <div class="buttons right">
            <a form="form" class="button submit">{"查询"|L}</a>
        </div>
    </form>
</div>
<hr class="hr" />

	<div class="tablehead">
		<div class="table-th"></div>
		<div class="table-th"><p>{"上线总人次"|L}<br>({"人次"|L})</p></div>
		<div class="table-th"><p>{"上线总时长"|L}<br>({"时/分/秒"|L})</p></div>
		<div class="table-th" width="92px"><p>{"语音通话"|L}<br>({"时/分/秒"|L})</p></div>
		<div class="table-th" width="92px"><p>{"视频通话"|L}<br>({"时/分/秒"|L})</p></div>
		<div class="table-th" width="92px"><p>{"对讲通话"|L}<br>({"时/分/秒"|L})</p></div>
		<div class="table-th" width="92px"><p>{"短信"|L}<br>({"条"|L})</div>
		<div class="table-th" style="width:100px;"><p>{"图片拍传"|L}<br>({"条"|L})</p></div>
	</div>
<div class="content"></div>

<div>
	<hr />
</div>
<div class="right">
	<a class="button export-excel">{"导出数据"|L}</a>
</div>
{/strip}