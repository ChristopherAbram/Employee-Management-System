<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:50:24
  from "/var/www/html/app/views/file_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c3a0971b73_49328916',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a08bb14fd07f1464f782f97f015b093160113a47' => 
    array (
      0 => '/var/www/html/app/views/file_list.tpl',
      1 => 1478773563,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c3a0971b73_49328916 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'file');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['file']->value) {
?>
<div class="tile">
    <div class="imgContener">
        <div class="cross">
            <input type="text" name="file_name[<?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
" class="file_name" readonly="readonly" />
            <?php if ($_smarty_tpl->tpl_vars['removeable']->value == 'true') {?><input type="submit" name="remove[]" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
" class="close" title="Remove" /><?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['input']->value)) {?><input type="<?php echo $_smarty_tpl->tpl_vars['input']->value;?>
" name="file[]" value="<?php echo $_smarty_tpl->tpl_vars['file']->value['id'];?>
" /><?php }?>
        </div>
        <img class="thumb" src="<?php echo $_smarty_tpl->tpl_vars['file']->value['miniature'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
" />
    </div>
    <div class="progress">
        <div class="bar"></div>
        <input type="hidden" name="response" value="" />
        <div class="responseMessage"><?php echo $_smarty_tpl->tpl_vars['file']->value['name'];?>
</div>
    </div>
</div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
}
