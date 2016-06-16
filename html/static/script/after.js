$("input[required]").focus(function () {
	$("#form").valid();
});

$("a.toggle").click(function () {
	var owner = $(this);
	var toggle = $("." + owner.attr('data'));
	if (owner.text() == "<%'收缩'|L%>↑") {
		owner.text("<%'展开'|L%>↓");
		toggle.addClass('none');
	} else {
		owner.text("<%'收缩'|L%>↑");
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
				var index=layer.tips("<%'查询目标不存在,请重新输入'|L%>",$("#remote_input"), {
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
