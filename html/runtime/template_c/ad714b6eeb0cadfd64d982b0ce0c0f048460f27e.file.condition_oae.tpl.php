<?php /* Smarty version Smarty-3.1.11, created on 2016-05-27 18:28:33
         compiled from "..\template\modules\report\condition_oae.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213865748215184e848-73354002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad714b6eeb0cadfd64d982b0ce0c0f048460f27e' => 
    array (
      0 => '..\\template\\modules\\report\\condition_oae.tpl',
      1 => 1463735792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213865748215184e848-73354002',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574821518c3b62_98932280',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574821518c3b62_98932280')) {function content_574821518c3b62_98932280($_smarty_tpl) {?><div class="left"><?php echo L("选择目标");?>
：</div>
            <div style="float:left;" class="select-portal">
                <select name='checkp' class="select-condition" style="height:26px; margin-left: 1px;">
                    <option value="0" selected="selected">平台</option>
                    <option value="1">Server</option>
                </select>
            </div>
                <div style="float:left;">
                    <input type="text" class="form-control nothing" id="remote_input" value="OMP" style="width:191px;" placeholder="<?php echo L("输入名称");?>
">
                </div>
                <div style="float:left;margin-top: 4px;">
                        <span class="input-group-btn">
                            <a tabindex="0" class="fg-button fg-button-icon-right ui-widget ui-state-default ui-corner-all" id="flyout">
                                <span class="ui-icon ui-icon-triangle-1-s"></span>
                                <span class="select_enterprise"></span>
                            </a>
                            <button id="open" class="btn btn-default none" type="button"><span class="caret"></span></button>
                        </span>
            </div>


<script>
	$("input[name=ep_id]").val("");
$('#remote_input').autocomplete({
    valueKey:'title',
    source:[{
            url:"?m=report&a=get_ep_ag_list",
            type:'remote',
            getValue:function(item){
                    return item.title
            },
            ajax:{
                    dataType : 'json'
            }
    }]
});
        $.ajax({
                        url:"?m=report&a=getagep",
                        dataType:"html",
                        async:false,
                        success:function(data){
                            $('#flyout').menu({ content: data, flyOut: true });
                        }
                });
        $("select.select-condition").on("change",function(event){
            var condition=$(this).val();
            if(condition==1){
                $("input[name=page]").val("0");
                $("div.positionHelper").remove();
                $.ajax({
                        url:"?m=report&a=con_server",
                        dataType:"html",
                        async:false,
                        success:function(html){
                            $("div.condition-seacher").html(html);
                        }
                });
            }else if(condition==0){
                $("input[name=page]").val("0");
                $("div.positionHelper").remove();
               $.ajax({
                        url:"?m=report&a=con_oae",
                        dataType:"html",
                        async:false,
                        success:function(html){
                            $("div.condition-seacher").html(html);
                        }
                });
            }
        });
        $("input.xdsoft_input").on("blur",function(){
              if($("#remote_input").val()==""){
                    $("input[name=ep_id]").val("");
                }else{
                    $("div.xdsoft_autocomplete_dropdown div").each(function(){
                           if($("#remote_input").val()==decodeURIComponent($(this).attr("data-value"))){
                                $("input[name=ep_id]").val($(this).attr("data-number"));
                           }
                    });
                    if($("input[name=ep_id]").val() == '' && $("#remote_input").val()!="")
                    {
                        $("input[name=ep_id]").val($("#remote_input").val());
                    }

                }
        });
</script>       <?php }} ?>