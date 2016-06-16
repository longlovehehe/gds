$(function(){
  
        $("input.xdsoft_input").on("blur",function(){
              if($("#remote_input").val()==""){
                    $("input[name=ep_id]").val("");
                }else{
                    $("div.xdsoft_autocomplete_dropdown div").each(function(){
                            if($("#remote_input").val()==decodeURIComponent($(this).attr("data-value"))){
                                $("input[name=ep_id]").val($(this).attr("data-number"));
                           }

                    });
                }
        });
});
$("a.liveness").on("click",function(){
    $("div.select_time").removeClass("none");
    $("div.content").addClass("none");
   $("div.charts7").removeClass("none");
   $("div.charts8").removeClass("none");
   $("div.charts9").removeClass("none");
   $("a.charts_nav").each(function(){
       $(this).removeClass("active");
   }); 
   $(this).addClass("active");
   $("input[name=status]").val("liveness");
   $("div.live_data").removeClass("none");
   $("input[name=live_num]").prop("checked","checked");
   var od=1;
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
   $("div.open_data").addClass("none");
   $("div.bissness_data").addClass("none");
   $("div.gprs_data").addClass("none");
   $("div.terminal_data").addClass("none");
   send();
});

    
function get_live_num(obj){
    $.ajax({
            url:"?m=report&a=get_live_num",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_livenum",
                table_type:"live_num_table",
                title:{
                        name1:"<%'在线人数'|L%>",
                        name2:"<%'离线人数'|L%>",
                        name3:"<%'总数'|L%>",
                        color1:'#CCE198',
                        color2:'#FF8888'
                    },
                total:"<%'总数'|L%>",
                index:"7",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_live_sum(obj,online_days){
    var online_days=online_days?online_days:3;
  $("#date_type").val('day');
    $.ajax({
            url:"?m=report&a=get_live_sum",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_livesum",
                table_type:"live_sum_table",
                online_days:online_days,
                title:{
                        name1:"<%'在线人数'|L%>",
                        color1:'#A83A3A'
                    },
                index:"8",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}
function get_liveness(obj){
    $.ajax({
            url:"?m=report&a=get_liveness",
            dataType:"html",
            async:true,
            data:{
                ep_id:$('input[name=ep_id]').val(),
                date_type:"day",
                data_type:"_liveness",
                table_type:"liveness_table",
                title:{
                    name1:"<%'活跃度'|L%>",
                    color1:'#A83A3A'
                },
                unit:"1",
                index:"9",
                start:$("input[name=start]").val(),
                end:$("input[name=end]").val()
            },
            success:function(res){
                obj.html(res);
            }
        });
}

$(function(){
                
        $("input.xdsoft_input").on("blur",function(){
              if($("#remote_input").val()==""){
                    $("input[name=ep_id]").val("");
                }else{
                    $("div.xdsoft_autocomplete_dropdown div").each(function(){
                            if($("#remote_input").val()==decodeURIComponent($(this).attr("data-value"))){
                                $("input[name=ep_id]").val($(this).attr("data-number"));
                           }

                    });
                }
        });
        
});