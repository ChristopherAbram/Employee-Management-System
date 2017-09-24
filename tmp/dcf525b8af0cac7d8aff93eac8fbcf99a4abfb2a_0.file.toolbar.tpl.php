<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 13:58:35
  from "/var/www/html/app/views/toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c257eb5f0fb5_63044289',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcf525b8af0cac7d8aff93eac8fbcf99a4abfb2a' => 
    array (
      0 => '/var/www/html/app/views/toolbar.tpl',
      1 => 1482769911,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c257eb5f0fb5_63044289 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['toolbar_left']->value) || !empty($_smarty_tpl->tpl_vars['toolbar_right']->value)) {?>
<section id="toolbar">
    <?php if (!empty($_smarty_tpl->tpl_vars['toolbar_left']->value)) {?>
    <div id="left">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['toolbar_left']->value, 'button');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['button']->value) {
?>
            <?php echo $_smarty_tpl->tpl_vars['button']->value;?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['toolbar_right']->value)) {?>
    <div id="right">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['toolbar_right']->value, 'button');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['button']->value) {
?>
            <?php echo $_smarty_tpl->tpl_vars['button']->value;?>

        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
    <?php }?>
</section>
<?php }
}
}
