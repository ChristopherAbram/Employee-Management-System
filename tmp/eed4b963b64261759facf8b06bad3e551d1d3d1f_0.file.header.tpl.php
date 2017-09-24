<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-23 21:48:17
  from "/var/www/html/app/views/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c6ba819a0bb8_79189277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eed4b963b64261759facf8b06bad3e551d1d3d1f' => 
    array (
      0 => '/var/www/html/app/views/header.tpl',
      1 => 1506196095,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c6ba819a0bb8_79189277 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="headbar">
    <div id="logo">Solteq Assignment</div>
    <nav id="menu">
        <?php if ($_smarty_tpl->tpl_vars['user_identified']->value) {?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/panel" rel="stylesheet">Panel</a>
        <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['front_menu']->value, 'name', false, 'link');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['link']->value => $_smarty_tpl->tpl_vars['name']->value) {
?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" rel="stylesheet"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php }?>
    </nav>
</div><?php }
}
