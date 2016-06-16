<script type="text/javascript"> 
function fixupFirstRow(tab) { 
var div=tab.parent(); 

if(div.attr("class")=="freezediv"){

tab.children().children().eq(0).css("zIndex","999");
tab.children().children().eq(0).css("position","absolute");
div.scroll(function(){ 
var tr = tab.children().children().eq(0); 
tr.css("top" , div.scrollTop-20); 
{*tr.css("left",-1); *}
}); 
} 
} 
$(function(){
 var tab=$("#freezedivTable"); 
 if(tab){
        fixupFirstRow(tab); 
    } 
});

</script> 
<div style="width: 100%;height: 35px;background: #ccc;">
    <div class="left">已开户数：10000</div>
    <div class="right">
        <div class="right month"><a href="javascript:void(0);">月</a></div>
        <div class="right week"><a href="javascript:void(0);">周</a></div>
        <div class="right day"><a href="javascript:void(0);">日</a></div>
        <div class="right">&nbsp;&nbsp;</div>
        <div class="right table"><a href="javascript:void(0);">表</a></div>
        <div class="right picture active"><a href="javascript:void(0);">图</a></div>
        
    </div>
</div>
<div class="freezediv" style="overflow-y: scroll;overflow-x: hidden; width: 100%;height: 399px;">
<table  id="freezedivTable" class="base full">
        <tr class='head' style="width:730px;">
            {*<th width="25px"><input autocomplete="off"  type="checkbox" id="checkall" /></th>*}
            <th width="375px">{"日期"|L}</th>
            <th width="375px;">{"个数"|L}</th>
        </tr>
        <tr  class='head'>
            <th width="375px">{"日期"|L}</th>
            <th width="375px">{"个数"|L}</th>
        </tr>
        {foreach name=list item=item from=$list}
        <tr>
            {*<td><input autocomplete="off"  type="checkbox" name="checkbox" value="{if $item.om_id  neq 'admin'}{$item.om_id}{/if}" class="cb" {if $item.om_id  eq 'admin'}disabled{/if}/></td>*}
            <td width="375px">{$item.create_time}</td>
            <td width="375px">{$item.user_num}</td>
        </tr>
        {/foreach}

    </table>
    {if !$list}
        <div style="width:100%;line-height: 100%;text-align:center;font-size:14px;margin-top:140px;">【{"暂无数据"|L}】</div>
    {/if}
</div>