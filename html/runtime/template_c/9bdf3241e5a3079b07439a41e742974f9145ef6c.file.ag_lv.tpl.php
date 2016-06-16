<?php /* Smarty version Smarty-3.1.11, created on 2016-06-16 14:17:24
         compiled from "..\template\modules\report\ag_lv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103585762447413c533-06398029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bdf3241e5a3079b07439a41e742974f9145ef6c' => 
    array (
      0 => '..\\template\\modules\\report\\ag_lv.tpl',
      1 => 1463709230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103585762447413c533-06398029',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'list' => 0,
    'item' => 0,
    'item1' => 0,
    'item2' => 0,
    'item3' => 0,
    'item4' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_57624474416d51_48439319',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57624474416d51_48439319')) {function content_57624474416d51_48439319($_smarty_tpl) {?><ul>
	<?php if (count($_smarty_tpl->tpl_vars['list']->value)>10){?>
		<li><a class="prev_list" href="javascript:void(0);" style="text-align: center;">▲(<?php echo L("上一页");?>
)</a></li>
		<?php }?>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
			<?php if (is_array($_smarty_tpl->tpl_vars['item']->value['list'])){?>
            <li><a href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ag_name'];?>
</a><ul>
					<?php  $_smarty_tpl->tpl_vars['item1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item1']->key => $_smarty_tpl->tpl_vars['item1']->value){
$_smarty_tpl->tpl_vars['item1']->_loop = true;
?>
						<?php if (count($_smarty_tpl->tpl_vars['item1']->value['list'])!=0){?>
							<li><a  href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item1']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item1']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item1']->value['ag_name'];?>
</a><ul>
									<?php  $_smarty_tpl->tpl_vars['item2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item1']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item2']->key => $_smarty_tpl->tpl_vars['item2']->value){
$_smarty_tpl->tpl_vars['item2']->_loop = true;
?>
										<?php if (count($_smarty_tpl->tpl_vars['item2']->value['list'])!=0){?>
											<li><a href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item2']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item2']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item2']->value['ag_name'];?>
</a><ul>
													<?php  $_smarty_tpl->tpl_vars['item3'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item3']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item2']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item3']->key => $_smarty_tpl->tpl_vars['item3']->value){
$_smarty_tpl->tpl_vars['item3']->_loop = true;
?>
														<?php if (count($_smarty_tpl->tpl_vars['item3']->value['list'])!=0){?>
															<li><a href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item3']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item3']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item3']->value['ag_name'];?>
</a><ul>
																	<?php  $_smarty_tpl->tpl_vars['item4'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item4']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item3']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item4']->key => $_smarty_tpl->tpl_vars['item4']->value){
$_smarty_tpl->tpl_vars['item4']->_loop = true;
?>
																		<?php if (count($_smarty_tpl->tpl_vars['item4']->value['list'])!=0){?>
																			<li><a  href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item4']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item4']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item4']->value['ag_name'];?>
</a></li>
																			<?php }else{ ?>
																			<?php }?>
																		<?php } ?>
																</ul></li>
															<?php }else{ ?>
															<li><a  href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item3']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item3']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item3']->value['ag_name'];?>
</a></li>
															<?php }?>

													<?php } ?>
												</ul></li>
											<?php }else{ ?>
											<li><a  href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item2']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item2']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item2']->value['ag_name'];?>
</a></li>
											<?php }?>
										<?php } ?>
								</ul></li>
							<?php }else{ ?>
							<li><a  href="#"  style="<?php echo set_title($_smarty_tpl->tpl_vars['item1']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item1']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item1']->value['ag_name'];?>
</a></li>
							<?php }?>
						<?php } ?>
				</ul></li>
			<?php }else{ ?>
            <li><a href="#" style="<?php echo set_title($_smarty_tpl->tpl_vars['item']->value['ag_number']);?>
" ag_number="<?php echo $_smarty_tpl->tpl_vars['item']->value['ag_number'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ag_name'];?>
</a></li>
			<?php }?>

	<?php } ?>
	<?php if (count($_smarty_tpl->tpl_vars['list']->value)>10){?>
		<li><a class="next_list" href="javascript:void(0);" style="text-align: center;">▼(<?php echo L("下一页");?>
)</a></li>
		<?php }?>
</ul><?php }} ?>