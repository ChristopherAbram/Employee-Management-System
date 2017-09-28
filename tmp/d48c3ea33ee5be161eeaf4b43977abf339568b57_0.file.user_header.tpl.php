<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-28 14:54:43
  from "/var/www/html/app/views/user_header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59ccf113ef08d0_16746198',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd48c3ea33ee5be161eeaf4b43977abf339568b57' => 
    array (
      0 => '/var/www/html/app/views/user_header.tpl',
      1 => 1506603251,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ccf113ef08d0_16746198 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="headbar">
    <div id="logo">EMS</div>
    <nav id="menu">
        <?php if ($_smarty_tpl->tpl_vars['user_identified']->value) {?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/logout" rel="stylesheet">Logout</a>
        
        <?php }?>
    </nav>
</div><?php }
}
