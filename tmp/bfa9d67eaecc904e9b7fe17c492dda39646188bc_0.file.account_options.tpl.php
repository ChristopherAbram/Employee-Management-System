<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:16:52
  from "/var/www/html/app/views/account_options.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15104e6c949_01931061',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfa9d67eaecc904e9b7fe17c492dda39646188bc' => 
    array (
      0 => '/var/www/html/app/views/account_options.tpl',
      1 => 1482932125,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15104e6c949_01931061 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="account">
    <?php if (!$_smarty_tpl->tpl_vars['user_identified']->value) {?>
    <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/registration">Join</a>
    <span class="button" id="login_button">Sign in</span>
    <?php } else { ?>
    <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/panel">Your account</a>
    <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/logout?url=<?php echo urlencode($_smarty_tpl->tpl_vars['path']->value['current']);?>
">Log out</a>
    <?php }?>
</div><?php }
}
