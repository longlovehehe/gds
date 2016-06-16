$("a.terminal").on("click",function(){
   $("div.select_time").removeClass("none");
   $("div.content").addClass("none");
   $("div.charts16").removeClass("none");
   $("div.charts17").removeClass("none");

   //get_term_type($("div.charts16"));
   //$("div.charts18").removeClass("none");
   $("a.charts_nav").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("terminal");
   //$("div.terminal_data").removeClass("none");
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
   $("div.gprs_data").addClass("none");
   send();
});

function get_term_type(obj){
    $.ajax({
            url:"?m=report&a=get_term_type",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"year",
                //date_type:"month",
                //date_type:"week",
                //date_type:"day",
                data_type:"_term_type",
                table_type:"term_type_table",
                title:{
                      name1:"<%'商用'|L%>",
                      name2:"<%'测试'|L%>",
                      name3:"<%'总数'|L%>",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<%'总数'|L%>",
                index:"16",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}
function get_term_agents(obj){
    $.ajax({
            url:"?m=report&a=get_term_agents",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"month",
                data_type:"_term_type",
                table_type:"term_type_table",
                title:{
                      name1:"<%'商用'|L%>",
                      name2:"<%'测试'|L%>",
                      name3:"<%'总数'|L%>",
                      color1:'#CCE198',
                      color2:'#FF8888',
                      color3:'#B0DE09'
                },
                total:"<%'总数'|L%>",
                index:"17",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                $("div.content").removeClass("loading _301_1_gif");
                obj.html(res);
            }
        });
}