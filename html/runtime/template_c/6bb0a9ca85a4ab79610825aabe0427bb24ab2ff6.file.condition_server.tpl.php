<?php /* Smarty version Smarty-3.1.11, created on 2016-05-27 18:28:30
         compiled from "..\template\modules\report\condition_server.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151485748214eb479c1-60890517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bb0a9ca85a4ab79610825aabe0427bb24ab2ff6' => 
    array (
      0 => '..\\template\\modules\\report\\condition_server.tpl',
      1 => 1463377654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151485748214eb479c1-60890517',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5748214ebbcce2_43450777',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5748214ebbcce2_43450777')) {function content_5748214ebbcce2_43450777($_smarty_tpl) {?>            <div class="left"><?php echo L("选择目标");?>
：</div>
            <div style="float:left;" class="select-portal">
                <select name='checkp' class="select-condition" style="height:26px; margin-left: 1px;">
                    <option value="0">平台</option>
                    <option value="1" selected="selected">Server</option>
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
    $("input[name=page]").val("0");
$('#remote_input').autocomplete({
        valueKey:'title',
        source:[{
                    url:"?m=report&a=get_server_list",
                    type:'remote',
                    getValue:function(item){
                            return item.title
                    },
                    ajax:{
                            dataType : 'json'
                    }
                }]
        });
        $("#remote_input").val("");
        $.ajax({
                        url:"?m=report&a=getserver",
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