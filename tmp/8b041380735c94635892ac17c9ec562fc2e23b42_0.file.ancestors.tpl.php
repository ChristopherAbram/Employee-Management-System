<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:17:07
  from "/var/www/html/app/views/ancestors.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c151134f2042_65114136',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b041380735c94635892ac17c9ec562fc2e23b42' => 
    array (
      0 => '/var/www/html/app/views/ancestors.tpl',
      1 => 1482765670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c151134f2042_65114136 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="position">
    <ul>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['home']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['home']->value['title'];?>
</a></li>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ancestors']->value, 'ancestor_link', false, 'ancestor_label');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ancestor_label']->value => $_smarty_tpl->tpl_vars['ancestor_link']->value) {
?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['ancestor_link']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['ancestor_label']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['ancestor_label']->value;?>
</a></li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </ul>
</nav><?php }
}
