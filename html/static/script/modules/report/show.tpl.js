/* The file is auto create */
/* 此文件由资源管理器自动创建生成。该文件用于开发时，可以选择删除这条注释 */
$(function () {
    $('#remote_input').autocomplete({
        valueKey: 'title',
        source: [{
            url: "?m=enterprise&a=get_like_user",
            type: 'remote',
            getValue: function (item) {
                return item.title
            },
            ajax: {
                dataType: 'json'
            }
        }]
    });

    $("select[name=checkp]").on("change",function(){
	switch ($(this).val()){
		case "0":
			$(".form-control").addClass("none");
			$(".form-control.emp").removeClass("none");
			$("input[name=action]").val("charts_item");
			break;
		case "1":
			$(".form-control").addClass("none");
			$(".form-control.usergroup").removeClass("none");
//                $("select[name=u_ug_id] option").eq(0).attr("selected","selected");
			$("#remote_input").val("");
			$("input[name=action]").val("charts_item_ug");
			break;
		case "2":
			$(".form-control").addClass("none");
			$("#remote_input").removeClass("none");
			$("input[name=action]").val("charts_item_user");
//                $("select[name=u_ug_id]").val("NULL");
			$(".xdsoft_autocomplete").show();
			break;
	}
    });
    $("select[name=checkdate]").on("change",function(){
        switch ($(this).val()){
            case "0":
                $(".datepickerreport").addClass("none");
                $(".datepickerreport.year").removeClass("none");
                break;
            case "1":
                $(".datepickerreport").addClass("none");
                $(".datepickerreport.month").removeClass("none");
                break;
            case "2":
                $(".datepickerreport").addClass("none");
                $(".datepickerreport.week").removeClass("none");
                break;
            case "3":
                $(".datepickerreport").addClass("none");
                $(".datepickerreport.day").removeClass("none");
                break;
        }
    });
	
	$("a.export-excel").on("click",function(){
		$('table.base.full').table2excel({
			exclude: ".noExl",
			name: "Excel Document Name",
			filename: "GDS_CHARTS",
			exclude_img: true,
			exclude_links: true,
			exclude_inputs: true

		});
		
	});
	
});

