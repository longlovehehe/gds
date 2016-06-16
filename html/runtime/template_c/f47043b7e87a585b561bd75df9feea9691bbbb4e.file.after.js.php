<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:17:23
         compiled from "..\static\script\after.js" */ ?>
<?php /*%%SmartyHeaderCode:31704576244734a33e1-97407563%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f47043b7e87a585b561bd75df9feea9691bbbb4e' => 
    array (
      0 => '..\\static\\script\\after.js',
      1 => 1465266776,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31704576244734a33e1-97407563',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576244734ca4f1_61742511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576244734ca4f1_61742511')) {function content_576244734ca4f1_61742511($_smarty_tpl) {?>$("input[required]").focus(function () {
	$("#form").valid();
});

$("a.toggle").click(function () {
	var owner = $(this);
	var toggle = $("." + owner.attr('data'));
	if (owner.text() == "<?php echo L('收缩');?>
↑") {
		owner.text("<?php echo L('展开');?>
↓");
		toggle.addClass('none');
	} else {
		owner.text("<?php echo L('收缩');?>
↑");
		toggle.removeClass('none');
	}
});

$('div.content').delegate('select.only_show', 'change', function () {
	$(this).val(1);
});

/**
 *调度台号码选择其他号码
 */

$("select[name=u_alarm_inform_svp_num]").change(function () {
	$("input[name=u_alarm_inform_svp_num]").val($(this).val());
	if ($("select[name=u_alarm_inform_svp_num] option:selected").val() == "@") {
		$("input[name=u_alarm_inform_svp_num]").removeClass("none");
		$("input[name=u_alarm_inform_svp_num]").val("");
	} else {
		$("input[name=u_alarm_inform_svp_num]").addClass("none");
	}
});
/**
 * 导航栏访问后背景颜色
 * @type @arr;request
 */
var request = eval($("span.request").text());
var request = request[0];
(function ()
{
	var nav = request.a;
	if (nav != "")
	{
		$("a.charts_nav").each(function () {
			$(this).removeClass("hover");
		});
		$("a." + nav).addClass("hover");
		if ($("a." + nav).attr("class").indexOf("hover") > 0) {
			$("a." + nav).parent().parent().removeClass("none");
		}
	}
})();
$('div.content').delegate('select.only_show', 'change', function () {
	$(this).val(1);
});
var maxpage = $("input[name=sum]").val();
$(function () {

	$("input.xdsoft_input").on("blur", function () {
		if ($("#remote_input").val() == "") {
			$("input[name=ep_id]").val("");
		} else {
			$("div.xdsoft_autocomplete_dropdown div").each(function () {
				if ($("#remote_input").val() == decodeURIComponent($(this).attr("data-value"))&&$("input[name=ep_id]").val()=="") {
					$("input[name=ep_id]").val($(this).attr("data-number"));
				}
			});
			if ($("input[name=ep_id]").val() == '' && $("#remote_input").val() != "" &&$("#remote_input").val()!="OMP")
			{
				var index=layer.tips("<?php echo L('查询目标不存在,请重新输入');?>
",$("#remote_input"), {
						tips:[1, '#A83A3A'],
						time:8000
					});
//				$("#remote_input").val("")
			}else{
				layer.closeAll("tips");
			}

		}
	});
	get_limit_select();
});


function get_limit_select(limit) {
	$.ajax({
		url: "?m=report&a=getagep",
		dataType: "html",
		async: true,
//                    data:{limit:limit},
		success: function (data) {
			$('#flyout').menu({content: data, flyOut: true});
		}
	});
}
var winWidth = 0;
var winHeight = 0;
function findDimensions() //函数：获取尺寸
{
	//获取窗口宽度
	if (window.innerWidth)
		winWidth = window.innerWidth;
	else if ((document.body) && (document.body.clientWidth))
		winWidth = document.body.clientWidth;
	//获取窗口高度
	if (window.innerHeight)
		winHeight = window.innerHeight;
	else if ((document.body) && (document.body.clientHeight))
		winHeight = document.body.clientHeight;
	//通过深入Document内部对body进行检测，获取窗口大小
	if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
	{
		winHeight = document.documentElement.clientHeight;
		winWidth = document.documentElement.clientWidth;
	}
}
findDimensions();
//调用函数，获取数值
window.onresize = findDimensions;
<?php }} ?>