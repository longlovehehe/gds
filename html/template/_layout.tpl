<!DOCTYPE html>
{strip}
<!--[if lt IE 7 ]> <html class="ie6 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
<!--[if IE 7 ]><html class="ie7 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
<!--[if IE 8 ]><html class="ie8 lang_{$smarty.cookies.lang} can_select"><![endif]-->
<!--[if IE 9 ]><html class="ie9 lang_{$smarty.cookies.lang} can_select"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!--><html class="lang_{$smarty.cookies.lang} can_select"><!--<![endif]-->
		<head> 
			<meta charset="UTF-8"> 

			<meta http-equiv="pragma" content="max-age=2592000">
			<meta http-equiv="cache-control" content="max-age=2592000">
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="renderer" content="webkit">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
			<title>{"数据统计"|L}</title>
			{$style|style}
			<link href="./style/datepicker/foundation.min.css" rel="stylesheet" type="text/css">
			<link href="./style/datepicker/foundation-datepicker.css" rel="stylesheet" type="text/css">
			<script src="script/libs.before.js"></script>
			<script src="script/autoselect.js"></script>
			<script src="script/form.js"></script>
			<script src="./script/plugins/datepicker/foundation-datepicker.js"></script>
			{* {if $smarty.session.ident eq "GQT"}
            <script src="./script/plugins/datepicker/locales/foundation-datepicker.en-GB.js"></script>
			{else}
            <script src="./script/plugins/datepicker/locales/foundation-datepicker.zh-CN.js"></script>
			{/if}*}
			<script src="./script/plugins/datepicker/locales/foundation-datepicker.zh-CN.js"></script>

			<script type="text/javascript">
				$(document).ready(function () {
					$().orion({
						speed: 500, animation: "zoom"
					});
				});
				$(function () {
					var scorllTop = 10;
					$('#lanPos').css('top', "9999px");
					$('ul li').hover(function () {
						scorllTop = $(this).position().top + 78;
						$('#lanPos').css('top', scorllTop);
					});

                {*$('ul li').click(function(){
				for(var i=0;i<$('ul li').size();i++){
				if($(this).attr("class").indexOf("onelevel")>0){
				}else{
				if(this==$('ul li').get(i)){
				$('ul li').eq(i).children('a').addClass('hover');
				}else{
				$('ul li').eq(i).children('a').removeClass('hover');
				}
				}
				}
				});*}
					$("li a.onelevel1").on("click", function () {
						if ($(this).parent().next().attr("class").indexOf("none") > 0) {
							$(this).parent().next().removeClass("none");
						} else {
							$(this).parent().next().addClass("none");
						}
					});
				});

			</script>
			{'before'|scriptmodule}
			<link  href="style/ie6.layout.adapter.css" rel="stylesheet" type="text/css" />
			{*        <link href="style/layout.css"  rel="stylesheet" />*}
			<link  href="style/basic.css" rel="stylesheet" type="text/css" />
			{*        <link  href="style/css.css" rel="stylesheet" type="text/css" />*}
					<!--[if lte IE 8]>{'libs/html5'|scriptnocompile}<![endif]-->
		</head>
		<body class="{$smarty.get.m}" scroll="yes">
			<input type="hidden" name="lang" value="{$smarty.cookies.lang}"/>
			<span class="request none">[{$smarty.request|json_encode|escape:"htmlall"}]</span>
			<div class="lang" style="float:right;">
				<a class="lang" data="cn_ZH">中文版 </a>
				<span class='sep'>|</span>
				<a class="lang" data="en_US">English</a>
				<span class='sep'>|</span>
				<a class="lang" data="zh_TW">繁體中文</a>
			</div>

			<div class="quicktoolbar animated none">
				<input autocomplete="off"  value="{$smarty.get.u_number}" type="text" placeholder="输入需要搜索的企业用户帐号" />
				<a class="search" data="?m=enterprise&a=allusers&u_number=">{*搜索*}</a>
			</div>

			<div class="header">
				<header>
                    <h1 class="title {if $smarty.cookies.lang eq en_US}_GQT_icon_logo_1x120_en_png{else}_GQT_icon_logo_1x120_png{/if}"><a>{"运营管理平台--数据统计"|L}</a></h1>
                    <div class="login_tips" style="overflow: hidden;float: right;padding-right: 20px;" >
                        <div class="account" >
                            <a class="link ">{$account}</a>&nbsp;&nbsp;<a class="link" target="_blank" {if $smarty.session.eown neq NULL}href="?m=help"{else}{if $smarty.cookies.lang == 'zh_TW'}href="help_zh.html"{else if $smarty.cookies.lang == 'en_US'}href="help_en.html"{else}href="help.html"{/if}{/if}>{"帮助"|L}</a>
                        </div>
                    </div>
				</header>
			</div>

			<hr style="border-bottom:3px solid #B23E3E;border-top:0px solid #FF5F3E;" />
			<section class="content" style="overflow: hidden;">

				{*            <div style="clear:both;"></div>*}

				<div class="minipage" style="overflow: hidden;" >

					<div style="width:160px;height:500px;float:left;">
						<ul class="nav">
							{if $smarty.session.eown eq NULL}
							<li><a class="onelevel" href="?m=report&a=index" >{"选择查询"|L}  》</a></li>
							<ul class="twolevel none">
								<li><a class="charts_nav ajaxsub open index" href="javascript:void(0);" goto="index">{"开户数据"|L}</a></li>
								<li><a class="charts_nav ajaxsub open liveness livenessdata" href="javascript:void(0);" goto="livenessdata">{"活跃度"|L}</a></li>
								<li><a class="charts_nav ajaxsub open bissness bissnessdata"href="javascript:void(0);" goto="bissnessdata">{"业务数据"|L}</a></li>
								<li><a class="charts_nav ajaxsub terminal terminaldata"href="javascript:void(0);" goto="terminaldata">{"终端"|L}</a></li>
								<li><a class="charts_nav ajaxsub gprs_charts gprsdata"href="javascript:void(0);" goto="gprsdata">{"流量卡"|L}</a></li>
									{*<li><a class="charts_nav ajaxsub open index" href="?m=report&a=index">{"开户数据"|L}</a></li>
									<li><a class="charts_nav ajaxsub open liveness livenessdata" href="?m=report&a=livenessdata">{"活跃度"|L}</a></li>
									<li><a class="charts_nav ajaxsub open bissness bissnessdata"href="?m=report&a=bissnessdata">{"业务数据"|L}</a></li>
									<li><a class="charts_nav ajaxsub terminal terminaldata"href="?m=report&a=terminaldata">{"终端"|L}</a></li>
									<li><a class="charts_nav ajaxsub gprs_charts gprsdata"href="?m=report&a=gprsdata">{"流量卡"|L}</a></li>*}
							</ul>
							<li><a class="onelevel" href="?m=report&a=review">{"整体回顾"|L}  》</a></li>
							<ul class="twolevel none">
								<li><a class="charts_nav review" href="?m=report&a=review">{"回顾"|L}</a></li>
							</ul>
							{else}
							<li><a class="onelevel" href="?m=enterprise&a=charts">{"企业统计"|L}  》</a></li>
							<ul class="twolevel">
								<li><a class="charts_nav charts" href="?m=enterprise&a=charts">{"企业统计"|L}</a></li>
							</ul>
							{/if}
							<div id="lanPos"></div>
						</ul>
					</div>
					<div style=""></div>
					{if $mininav != null }
						<nav class="mininav" style='background: transparent;'>
							{foreach name=mininav item=item from=$mininav}
								<a title='{"{$item.name}"|L}' class="ctips" {if $item.next !=""}href="{$item.url}"{else}style="color:#111;text-decoration:none;"{/if}>{"{$item.name|mbsubstr: 20}"|L}</a>{$item.next}
							{/foreach}
						</nav>
					{/if}
					{*                <div style="float:left;width:160px;">&nbsp;</div>*}
					<div class="pagecontent mini_{$request.modules}_{$request.action} " style="overflow: hidden;padding-bottom:50px;padding-top: 30px;width:750px;" >
						{"{$content}"|L}
					</div>
					<div style="width:200px;float:right;">
					</div>
					<div class="OnlineService_Bg">
						<div class="OnlineService_Box">
							<div class="OnlineService_Top"><a href="#">{"返回顶部"|L}</a></div>
						</div>
					</div>
				</div>

			</section>
			{*                <img src="./images/top.png" width="93" height="62" id="hehe" style="position:fixed;bottom:30px;right:30px;  z-index:1000;cursor:pointer">*}

			<footer class="none">
				<hr />
				<p class='hidden1'>Copyright (C) http://www.zed-3.com.cn/, All Rights Reserved</p>
				<p class='hidden1'>{"捷思锐科技版权所有 京ICP备09032422号"|L}</p>
			</footer>
			<script src="?m=lang"></script>
			{$script|scriptafter}
			<script src="script/com.js"></script>
			<div id="fade" class="black_overlay"></div>
		</body>
	</html>
{/strip}
