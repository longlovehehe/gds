<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:14:00
         compiled from "..\template\modules\report\show_item_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5252576243a8623998-18018467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c463a73ebc18ebd5ef5e47f85ee26bc2c91e3bcc' => 
    array (
      0 => '..\\template\\modules\\report\\show_item_user.tpl',
      1 => 1466056717,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5252576243a8623998-18018467',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'sum' => 0,
    'json' => 0,
    'OneUserInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_576243a885a091_09246487',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_576243a885a091_09246487')) {function content_576243a885a091_09246487($_smarty_tpl) {?><form class="data">
    <div class="freezediv3" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
        <table id="" class="base full" >
		<tr class="none">
			<th></th>
			<th><?php echo L("上线总人次");?>
<br>(<?php echo L("人次");?>
)</th>
			<th><?php echo L("上线总时长");?>
<br>(<?php echo L("时/分/秒");?>
)</th>
			<th><?php echo L("语音通话");?>
<br>(<?php echo L("时/分/秒");?>
)</th>
			<th><?php echo L("视频通话");?>
<br>(<?php echo L("时/分/秒");?>
)</th>
			<th><?php echo L("对讲通话");?>
<br>(<?php echo L("时/分/秒");?>
)</th>
			<th><?php echo L("短信");?>
<br>(<?php echo L("条");?>
)</th>
			<th><?php echo L("图片拍传");?>
<br>(<?php echo L("条");?>
)</th>
		</tr>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <tr class="charts" u_number="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_number'];?>
">
                    <td title="<?php echo $_smarty_tpl->tpl_vars['item']->value['u_name'];?>
" class="rich"><?php echo mbsubstr($_smarty_tpl->tpl_vars['item']->value['u_name'],11);?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_online_count'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_online_time'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_audio_time'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_video_time'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_ptt_time'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_send_sm_count'];?>
</td>
		<td class="rich"><?php echo $_smarty_tpl->tpl_vars['item']->value['sdr_send_pic_count'];?>
</td>
                </tr>
            <?php } ?>
        </table>
    </div>
	<br />
	<div class="select-info"><?php echo $_smarty_tpl->tpl_vars['list']->value[0]['ug_name'];?>
</div>
    <style>
        @font-face {
            font-family: 'Covered By Your Grace';
            font-style: normal;
            font-weight: 400;
            src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
        }
    </style>
<script>
	var OnetrObj=$("table.base.full tr.charts").eq(0);
	OnetrObj.addClass("visted");
	$("table.base.full tr.charts").on("click",function(){
		$("table.base.full tr.charts").removeClass("visted");
		$(this).addClass("visted");
		var u_number=$(this).attr("u_number");
		var checkp=$("select[name=checkp]").val();
		var checkdate=$("select[name=checkdate]").val();
		var day=$("input.datepickerreport.year").val();
		switch(checkdate){
			case '0'://年
				day=$("input.datepickerreport.year").val();
				break;
			case '1'://月
				day=$("input.datepickerreport.month").val();
				break;
			case '2'://周
				day=$("input.datepickerreport.week").val();
				break;
			case '3'://日
				day=$("input.datepickerreport.day").val();
				break;
		}
		var title=$(this).children().eq(0).attr("title");
		$("div.select-info").html(title);
		$.ajax({
			type:"POST",
			url:"?m=enterprise&a=get_data",
			data:{
				day:day,
				e_id:$("input[name=e_id]").val(),
				type:"user",
				u_number:u_number,
				checkdate:checkdate,
			},
			success:function(html){
				$("div.show-charts").html(html);
			}
		});
	});

</script>
<div class="show-charts">
    <div class="get_call_time" style="width: 370px;float: left;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title"><?php echo L("通话时长");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
        </div>
        <!-- <div style="padding-top:12px;"><?php echo L("总数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div> -->
        <div id="get_call_time" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
            var get_call_time;
            makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                // column chart
                get_call_time = AmCharts.makeChart("get_call_time", {
                    type: "pie",
                    theme: theme,
                    dataProvider: [{
                        "country": "语音",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['OneUserInfo']->value['sdr_audio_time'];?>
"
                    }, {
                        "country": "视频",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['OneUserInfo']->value['sdr_video_time'];?>
"
                    }, {
                        "country": "对讲",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['OneUserInfo']->value['sdr_ptt_time'];?>
"
                    }],
                    titleField: "country",
                    valueField: "litres",
                    labelText:"",
                    colors:["#7ECEF4","#4CA3FC","#227BD6"],
                    outlineColor:"#ffffff",
                    outlineAlpha:1,
                    outlineThickness:0,
                    creditsPosition:"top-left",
                    startDuration:0,
                    
                    legend: {
                        position:"top",
                        valueText:"",
                        align: "left",
                        markerType: "square",
                    }
                });

            }

        </script>
    </div>
    <div class="get_call" style="width: 370px;float: right;">
        <div style="width: 100%;height: 35px;background: #ccc;">
            <div class="left charts-title"><?php echo L("短信条数");?>
：<span id="sum"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</span></div>
        </div>
        <div id="get_call" style="height: 400px;width:350px;overflow-x: auto;"></div>
        <input type="hidden" name="json" value='<?php echo $_smarty_tpl->tpl_vars['json']->value;?>
'>
        <script>
            var get_call;
            makeCharts("light", "#E5E5E5",eval($("input[name=json]").val()));

            function makeCharts(theme, bgColor,data){
                // background
                if(document.body){
                    document.body.style.backgroundColor = bgColor;
                }
                get_call = AmCharts.makeChart("get_call", {
                    type: "pie",
                    theme: theme,
                     dataProvider: [{
                        "country": "短信",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['OneUserInfo']->value['sdr_send_sm_count'];?>
"
                    }, {
                        "country": "彩信",
                        "litres": "<?php echo $_smarty_tpl->tpl_vars['OneUserInfo']->value['sdr_send_pic_count'];?>
"
                    }],
                    titleField: "country",
                    valueField: "litres",
                    labelText:"",
                    colors:["#56BA8A","#95E07E"],
                    outlineColor:"#ffffff",
                    outlineAlpha:1,
                    outlineThickness:0,
                    startDuration:0,
                    legend: {
                        position:"top",
                        valueText:"",
                        align: "left",
                        markerType: "square",
                    }
                });

            }
           
        </script>
    </div>
    <div style="clear: both;"></div>
</div>
</form>
<script>
	 function fixupFirstRow3(tab) {
                var div=tab.parent();

                if(div.attr("class")=="freezediv3"){
                    tab.children().children().eq(0).css("zIndex","1");
                    tab.children().children().eq(0).css("position","absolute");
                    tab.children().children().eq(0).css("width","735px");
                    div.scroll(function(){
                        var tr = tab.children().children().eq(0);
                        tr.css("top" , div.scrollTop-20);
                        
                    });
                }
            }
            $(function(){
                var tab=$("#freezedivTable3");
                if(tab){
                    fixupFirstRow3(tab);
                }
            });
</script><?php }} ?>