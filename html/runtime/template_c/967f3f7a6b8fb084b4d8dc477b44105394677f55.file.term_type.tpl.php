<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 11:56:14
         compiled from "..\template\modules\report\terminaldata\term_type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245035762235eea83d4-45504534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '967f3f7a6b8fb084b4d8dc477b44105394677f55' => 
    array (
      0 => '..\\template\\modules\\report\\terminaldata\\term_type.tpl',
      1 => 1464939703,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245035762235eea83d4-45504534',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'total' => 0,
    'com_term' => 0,
    'change_time' => 0,
    'json' => 0,
    'json_type' => 0,
    'res' => 0,
    'arr_list' => 0,
    'num' => 0,
    'sCount' => 0,
    'item' => 0,
    'data_type' => 0,
    'table_type' => 0,
    'item1' => 0,
    'key1' => 0,
    'url' => 0,
    'check_date' => 0,
    'type_arr' => 0,
    'title' => 0,
    'arr' => 0,
    'k' => 0,
    'i' => 0,
    'type_list' => 0,
    'arr_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5762235f66edf2_77260227',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5762235f66edf2_77260227')) {function content_5762235f66edf2_77260227($_smarty_tpl) {?><style>
            @font-face {
              font-family: 'Covered By Your Grace';
              font-style: normal;
              font-weight: 400;
              src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
            }
    </style>
    <div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left"><?php echo L("累计终端数量");?>
：<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
&nbsp;|&nbsp;<?php echo L("累计商用终端数量");?>
：<?php echo $_smarty_tpl->tpl_vars['com_term']->value;?>
</div>
    <div class="right">
      <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['month'];?>
"><a href="javascript:void(0);"><?php echo L("月");?>
</a></div>
        <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['week'];?>
"><a href="javascript:void(0);"><?php echo L("周");?>
</a></div>
        <div class="right_nav <?php echo $_smarty_tpl->tpl_vars['change_time']->value['day'];?>
"><a href="javascript:void(0);"><?php echo L("日");?>
</a></div>
        <div class="right_nav">&nbsp;</div>
        <div class="_term_type right_nav table_term_type"></div>
        <div class="_term_type right_nav picture_term_type active"></div>
    </div>
</div>
    <div class="get_day_info_term_type">
       <div id="_term_type" style="height: 400px;width:750px;overflow-x: auto;"></div>
       
       
        <!--  -->
    <input type="hidden" name="json16" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
' />
    <input type="hidden" name="json_mdt16" value='<?php echo $_smarty_tpl->tpl_vars['json_type']->value;?>
' />
        <script>
            $("input[type=checkbox]").attr("checked","checked");
        var _term_type;
        var _term_type_charts;
        makeCharts(eval($("input[name=json16]").val()));
 function makeCharts(data){
           _term_type = AmCharts.makeChart("_term_type", {
                type: "serial",
                dataProvider: data,
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                categoryField: "date1",
                <?php }else{ ?>
                categoryField: "date",
                <?php }?>
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
                /**/
            chartCursor:{
                   zoomable: false,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },
                categoryAxis: {
                    gridPosition: "middle",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    stackType:"none",
                    //stackType:"<?php echo $_smarty_tpl->tpl_vars['res']->value['stackType'];?>
",
                    gridAlpha:0.1,
                    axisAlpha:0,
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                    <?php if ($_smarty_tpl->tpl_vars['num']->value<$_smarty_tpl->tpl_vars['sCount']->value){?>
                    {
                    title: "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
",
                    type: "column",
                    lineAlpha: 0,
                    fillAlphas: 1,
                    lineColor: "<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    animationPlayed:true,
                    /*balloonText: "<b><span style='color:<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
'>[[title]]</b></span><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",*/
                    balloonText: "<b><span>[[title]]</span></b>：<b>[[value]]</b>",
                    labelPosition: "middle"
                },
                    <?php }?>
                <?php } ?>
                {
                  type: "line",
                    title: "<?php echo $_REQUEST['total'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['sCount']->value;?>
",
                    lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    lineColor:"#B0DE09",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<span style='font-size:13px;'>[[title]]：<b>[[value]]</b></span>"
                }],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }
          /*_term_type.addListener("clickGraphItem",term_type_table);
        function term_type_table(obj){
            console.log(obj);
        }*/
            
        //切换月->周 
        <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']!='day'){?>
        <?php echo $_smarty_tpl->tpl_vars['data_type']->value;?>
.addListener("clickGraphItem",<?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
);
        <?php }?>

        function <?php echo $_smarty_tpl->tpl_vars['table_type']->value;?>
(obj){
            var u = "";
            <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['res']->value['title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
            var c = "<?php echo $_smarty_tpl->tpl_vars['item1']->value;?>
";
            c = c.replace('#','');
            u +=  "<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
_"+c+"__";
            <?php } ?>
             // var time=obj.item.dataContext.month.split("~");
            //layer.alert(obj.item.dataContext.week);
            layer.open({
                type: 2,
                title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
                content: "?<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&time="+obj.item.dataContext.date+"&u="+u
            });
        }


            makeCharts_term(eval($("input[name=json_mdt16]").val()));
        function makeCharts_term(data){
           _term_type_charts = AmCharts.makeChart("_term_type_charts", {
                type: "serial",
                dataProvider: data,
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'||$_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                categoryField: "date1",
                <?php }else{ ?>
                categoryField: "date",
                <?php }?>
                startDuration: 1,
                plotAreaBorderAlpha: 0.2,
                rotate:false,
                columnWidth:0.8,
                ColumnSpacing:4,
                clickGraphItem:{
                    type:"clickGraphItem",
                    graph:"AmGraph",
                    item:"GraphDataItem",
                    index:"Number",
                    chart:"AmChart",
                    event:"MouseEvent"
                },
               init:{
                    type:"init", 
                    chart:"AmChart"
                },
                
            chartCursor:{
                   zoomable: false,
                   cursorAlpha: 0.1,
                   oneBalloonOnly:true,
                },
                categoryAxis: {
                    gridPosition: "middle",
                    gridAlpha: 0.1,
                    axisAlpha: 0,
                    labelRotation:"45",
                },
                valueAxes: [{
                    title: "<?php echo L("单位");?>
(<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['unit']));?>
)",
                    integersOnly:true,
                }],
        chartScrollbar: {
                //updateOnReleaseOnly: true,
                autoGridCount:false,
              },
                graphs: [
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
                    {
                    title: "<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    valueField: "param<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
",
                    type: "line",
                     lineThickness: 2,
                    fillAlphas: 0,
                    lineAlpha:1,
                    //lineColor: "<?php echo $_smarty_tpl->tpl_vars['item']->value['color'];?>
",
                    bullet: "round",
                    animationPlayed:true,
                    bulletSize:4,
                    balloonText: "<b><span style=''>[[title]]</b></span><span>：<b>[[value]]</b></span>",
                    //labelPosition: "middle"     color:<?php echo $_smarty_tpl->tpl_vars['title']->value['color1'];?>

                },
                <?php } ?> 
                ],
                legend: {
                    position:"top",
                    borderAlpha:0.3,
                    horizontalGap:10,
                    switchType:"v",
                    valueText:"",
                },
            });
            }

            
              //选择商用和测试
            var condition='com&test';
            $("input[type=checkbox]").on("click",function(){
                var date_type = "<?php echo $_smarty_tpl->tpl_vars['res']->value['date_type'];?>
";
                if($("input[name=commercial]").is(":checked")&&$("input[name=test]").is(":checked")){
                        condition="com&test";
                    //$("input[name=commercial]").val("comm");
                }else if($("input[name=commercial]").is(":checked")){
                        condition="com";
                }else if($("input[name=test]").is(":checked")){
                        condition="test";
                }else{
                        condition="none";
                }
                $.ajax({
                    url:"?m=report&a=get_term_type_data",
                    dataType:"json",
                    data:{
                        u_attr_type:condition,
                        date_type:"<?php echo $_smarty_tpl->tpl_vars['res']->value['date_type'];?>
",
                        start:$("input[name=start]").val(),
                        end:$("input[name=end]").val(),
                        ep_id:$('input[name=ep_id]').val()
                    },
                    success:function(res){
                        //$("#_term_type_charts").hmtl("");
                        makeCharts_term(res);
                        if(date_type!='day'){
                            _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
                        }
                    }
                });
                
            });

        //终端类型的年 月 周 日 切换
        <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']!='day'){?>
        _term_type_charts.addListener("clickGraphItem",term_type_charts_table);
        <?php }?>

        function term_type_charts_table(obj){
            var ep_id = $("input[name=ep_id]").val();
            var u = "";
            <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['res']->value['title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
            var c = "<?php echo $_smarty_tpl->tpl_vars['item1']->value;?>
";
            c = c.replace('#','');
            u +=  "<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
_"+c+"__";
            <?php } ?>
             // var time=obj.item.dataContext.month.split("~");
            //layer.alert(obj.item.dataContext.week);
            layer.open({
                type: 2,
                title:"<?php echo L(((string)$_smarty_tpl->tpl_vars['change_time']->value['dateType']));?>
<?php echo L('信息');?>
",
                area: ['800px', '500px'],
                fix: false, //不固定
                maxmin: false,
                content: "?m=report&a=next_info_charts&date_type=<?php echo $_smarty_tpl->tpl_vars['change_time']->value['check_date'];?>
&check_date=<?php echo $_smarty_tpl->tpl_vars['check_date']->value;?>
&data_type=_term_type_data&table_type=term_type_data_table&index=666&ep_id="+ep_id+"&stackType=none&total=total&time="+obj.item.dataContext.date
            });
        }
        
        $("input[name=commercial]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-com");
                }else{
                    $(this).parent().removeClass("background-com");
                     $(this).parent().addClass("background-none");
                }
        });
        
        $("input[name=test]").on("click",function(){
                if($(this).is(":checked")){
                     $(this).parent().removeClass("background-none");
                     $(this).parent().addClass("background-test");
                }else{
                    $(this).parent().removeClass("background-test");
                     $(this).parent().addClass("background-none");
                }
        });

        </script>
<div class="term_type_table none">
   <script type="text/javascript"> 
                function fixupFirstRow(tab) {
                    var div=tab.parent(); 

                    if(div.attr("class")=="freezediv"){
                     //
                        tab.children().children().eq(0).css("position","absolute");
                        div.scroll(function(){ 
                            var tr = tab.children().children().eq(0); 
                            tr.css("top" , div.scrollTop-20); 
                            //
                        }); 
                    }
                }
                $(function(){
                 var tab=$("#freezedivTable16"); 
                 if(tab){
                        fixupFirstRow(tab); 
                    } 
                });
             if($("div.picture_term_type").attr("class").indexOf("active") > 0){

                $("#_term_type").removeClass("none");
                $("div.term_type_table").addClass("none");
                $("div.picture_term_type").addClass("charts_picture_hover");
                $("div.table_term_type").addClass("charts_table");
            }else{
                $("#_term_type").addClass("none");
                $("div.term_type_table").removeClass("none");

                $("div.picture_term_type").addClass("charts_picture");
                $("div.table_term_type").addClass("charts_table_hover");
            }
            $("div.table_term_type").bind("click",function(){
                $("div.table_term_type").addClass("charts_table_hover");
                $("div.picture_term_type").addClass("charts_picture");
                $("div.picture_term_type").removeClass("charts_picture_hover");
                $("div.term_type_table").removeClass("none");
                //终端类型的列表、图的切换
                $("#_term_type_data_table").show();
                $("#choose").hide();
                $("#_term_type_charts").hide();

                $("#_term_type").addClass("none");
                /**/
                });
            $("div.picture_term_type").bind("click",function(){
                $("div.picture_term_type").addClass("charts_picture_hover");
                $("div.table_term_type").addClass("charts_table");
                $("div.table_term_type").removeClass("charts_table_hover");
                $("div.term_type_table").addClass("none");
                $("#_term_type").removeClass("none");
                //终端类型的列表、图的切换
                $("#_term_type_data_table").hide();
                $("#choose").show();
                $("#_term_type_charts").show();
               /**/

            });

//切换天
$("div.day_term_type a").bind("click",function(){
    $("div.day_term_type a").css("color","#A83A39");
    $("div.week_term_type a").css("color","#121212");
    $("div.month_term_type a").css("color","#121212");
    //终端数据 #7ECEF4  #BAE4F8
    $.ajax({
        url:"?m=report&a=get_day_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"day",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
            title:{
                    name1:"<?php echo L("商用");?>
",
                    name2:"<?php echo L("测试");?>
",
                    name3:"<?php echo L("总数");?>
",
                    color1:'#CCE198',
                    color2:'#FF8888',
                    color3:'#B0DE09'
                },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
        },
        success:function(res){
            $("div.get_day_info_term_type").html(res);
        }
    });
});

//切换周
$("div.week_term_type a").bind("click",function(){
    $("div.week_term_type a").css("color","#A83A39");
    $("div.day_term_type a").css("color","#121212");
    $("div.month_term_type a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_week_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"week",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
            title:{
                    name1:"<?php echo L("商用");?>
",
                    name2:"<?php echo L("测试");?>
",
                    name3:"<?php echo L("总数");?>
",
                    color1:'#CCE198',
                    color2:'#FF8888',
                    color3:'#B0DE09'
                },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
        },
        success:function(res){
            $("div.get_day_info_term_type").html(res);
        }
    });
});

//切换月
$("div.month_term_type a").bind("click",function(){
    $("div.month_term_type a").css("color","#A83A39");
    $("div.day_term_type a").css("color","#121212");
    $("div.week_term_type a").css("color","#121212");
    $.ajax({
        url:"?m=report&a=get_month_info",
        dataType:"html",
        data:{
            ep_id:$('input[name=ep_id]').val(),
            date_type:"month",
            data_type:"_term_type",
            table_type:"term_type_table",
            index:"16",
            title:{
                    name1:"<?php echo L("商用");?>
",
                    name2:"<?php echo L("测试");?>
",
                    name3:"<?php echo L("总数");?>
",
                    color1:'#CCE198',
                    color2:'#FF8888',
                    color3:'#B0DE09'
                },
            total:"<?php echo L("总数");?>
",
            stackType:"none",
            start:$("input[name=start]").val(),
            end:$("input[name=end]").val()
        },
        success:function(res){
            $("div.get_day_info_term_type").html(res);
        }
    });
});
            $("div._term_type").bind("click",function(){
                $("div._term_type").each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
            });
            
    </script> 
    <div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
        <table  id="freezedivTable16" class="base full">
            <tr class='head' style="width:730px;">
                <th width="375px"><?php echo L("日期");?>
</th>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php echo L($_tmp1);?>
</th>
                <?php } ?>

            </tr>
            <tr  class='head'>
                <th width="375px"><?php echo L("日期");?>
</th>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <th width="375px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp2=ob_get_clean();?><?php echo L($_tmp2);?>
</th>
                <?php } ?>
            </tr>
           <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <tr>
                <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("周");?>
)</td>
                <?php }elseif($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("月");?>
)</td>
                <?php }else{ ?>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
</td>
                <?php }?>
                <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arr_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(("param").($_smarty_tpl->tpl_vars['key1']->value), null, 0);?>
                <td width="375px"><?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
        <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
        <?php }?>
    </div>
</div>
<div style="margin-left:63px;" id="choose">
    <div class="piaochecked background-com on_check">
        <input name="commercial" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
    </div>
    <div class="checked"><?php echo L("商用");?>
</div>
    <div class="piaochecked background-test on_check" style="margin-left:12px">
        <input name="test" type="checkbox" style="height:20px;width:20px;" class="radioclass input">
    </div>
    <div class="checked"><?php echo L("测试");?>
</div>
</div>
<div id="_term_type_charts" style="height: 400px;width:750px;overflow-x: auto;"></div>

<!-- 终端类型 106ZW 120WZ table... -->
<div class="freezediv" id="_term_type_data_table" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;display: none;">
    <table  id="freezedivTable16" class="base full">
        <tr class='head' style="width:730px;">
            <th width="205px"><?php echo L("日期");?>
</th>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <th width="85px"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp3=ob_get_clean();?><?php echo L($_tmp3);?>
</th>
            <?php } ?>

        </tr>
       <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
        <tr>
            <?php if ($_smarty_tpl->tpl_vars['res']->value['date_type']=='week'){?>
            <td width="205px"><?php echo $_smarty_tpl->tpl_vars['arr_type']->value[$_smarty_tpl->tpl_vars['k']->value]['date1'];?>
<br />(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("周");?>
)</td>
            <?php }elseif($_smarty_tpl->tpl_vars['res']->value['date_type']=='month'){?>
            <td width="205px"><?php echo $_smarty_tpl->tpl_vars['arr_type']->value[$_smarty_tpl->tpl_vars['k']->value]['date1'];?>
(<?php echo L("第");?>
<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
<?php echo L("月");?>
)</td>
            <?php }else{ ?>
            <td width="205px"><?php echo $_smarty_tpl->tpl_vars['item']->value['create_time'];?>
</td>
            <?php }?>
            <?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['type_arr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['item1']->key;
?>
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['type_arr']->value[$_smarty_tpl->tpl_vars['key1']->value]['name'], null, 0);?>
            <td width="85px">
                <?php if (!isset($_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value])){?>
                -
                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['item']->value[$_smarty_tpl->tpl_vars['i']->value];?>

                <?php }?>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
    <?php if (!$_smarty_tpl->tpl_vars['type_list']->value){?>
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>
    <?php }?>
</div>


<script type="text/javascript">
$(function(){  
    var checked = "<?php echo $_smarty_tpl->tpl_vars['change_time']->value['checked'];?>
";
    if(checked){
        $("div."+checked+" a").css("color","#A83A39");
    }else{
        $("div.day_term_type a").css("color","#A83A39");
    }
    <?php if (!$_smarty_tpl->tpl_vars['arr']->value){?>
        $("#_term_type").children("div.amcharts-main-div").children("div.amcharts-chart-div").html('<div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【<?php echo L("暂无数据");?>
】</div>');
    <?php }?>
}); 
</script><?php }} ?>