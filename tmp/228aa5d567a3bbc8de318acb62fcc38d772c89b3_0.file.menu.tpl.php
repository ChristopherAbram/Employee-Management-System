<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:16:52
  from "/var/www/html/app/views/menu.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15104e623b1_64666766',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '228aa5d567a3bbc8de318acb62fcc38d772c89b3' => 
    array (
      0 => '/var/www/html/app/views/menu.tpl',
      1 => 1482769716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15104e623b1_64666766 (Smarty_Internal_Template $_smarty_tpl) {
?>
<ul>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value, 'option', false, 'name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['option']->value) {
?>
    <li <?php if (count($_smarty_tpl->tpl_vars['option']->value['menu']) != 0) {?>class="roll"<?php }?>>
        <a href="<?php echo $_smarty_tpl->tpl_vars['option']->value['href'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['active']) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</a>
        <?php if (count($_smarty_tpl->tpl_vars['option']->value['menu']) != 0) {?>
        <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['option']->value['menu'], 'option', false, 'name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['option']->value) {
?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['option']->value['href'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['active']) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</a></li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </ul>
        <?php }?>
    </li>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</ul><?php }
}
