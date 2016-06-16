$("a.gprs_charts").on("click",function(){
    $("div.select_time").addClass("none");
   $("div.content").addClass("none");
   $("div.charts18").removeClass("none");
   $("div.charts19").removeClass("none");
   $("a.charts_nav").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("gprs_charts");
   //$("div.bissness_data").removeClass("none");
    var od=1;
    var ld=7;
    var bd=10;
   $("div.open_data input[type=checkbox]").each(function(){
        if($(this).is(":checked")){
            $(this).removeAttr("checked");
        }
         $("div.charts"+od).addClass("none");
        od++;
    });
    $("div.bissness_data input[type=checkbox]").each(function(){
        if($(this).is(":checked")){
            $(this).removeAttr("checked");
        }
         $("div.charts"+bd).addClass("none");
        bd++;
    });
    $("div.live_data input[type=checkbox]").each(function(){
        if($(this).is(":checked")){
            $(this).removeAttr("checked");
        }
         $("div.charts"+ld).addClass("none");
        ld++;
    });
    $("div.open_data").addClass("none");
   $("div.live_data").addClass("none");
   $("div.bissness_data").addClass("none");
   $("div.terminal_data").addClass("none");
   send();
});

function get_gprs_type(obj){
    $.ajax({
            url:"?m=report&a=get_gprs_type",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                //date_type:"month",
                date_type:"year",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                title:{
                      name1:"<%'商用'|L%>",
                      name2:"<%'测试'|L%>",
                      name3:"<%'总数'|L%>",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<%'总数'|L%>",
                index:"18",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val(),
                this_start:$("input[name=this_start]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
function get_gprs_agents(obj){
    $.ajax({
            url:"?m=report&a=get_gprs_agents",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_gprs_type",
                table_type:"gprs_type_table",
                title:{
                      name1:"<%'商用'|L%>",
                      name2:"<%'测试'|L%>",
                      name3:"<%'总数'|L%>",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<%'总数'|L%>",
                index:"19",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val(),
                this_start:$("input[name=this_start]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
