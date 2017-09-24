<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 13:58:35
  from "/var/www/html/app/views/dashboard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c257eb572e64_38351997',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12fd9a969dc2ac89c028a5215b5da8205e4bef5a' => 
    array (
      0 => '/var/www/html/app/views/dashboard.tpl',
      1 => 1481717307,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c257eb572e64_38351997 (Smarty_Internal_Template $_smarty_tpl) {
?>
<span style="font-size: 2em; margin-top: 10px;">Welcome <b><?php echo $_smarty_tpl->tpl_vars['current_user']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['current_user']->value['lastname'];?>
</b></span>
<br><br>

<?php if (isset($_smarty_tpl->tpl_vars['current_user']->value['role']['access_level']) && $_smarty_tpl->tpl_vars['current_user']->value['role']['access_level'] == 2) {?>
<span class="info">Your account allows you to load avatar image, change profile data, read your recently added comments.</span>
<?php }
}
}
