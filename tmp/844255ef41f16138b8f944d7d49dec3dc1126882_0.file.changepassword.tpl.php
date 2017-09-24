<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:37:54
  from "/var/www/html/app/views/changepassword.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0b28353d5_44983020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '844255ef41f16138b8f944d7d49dec3dc1126882' => 
    array (
      0 => '/var/www/html/app/views/changepassword.tpl',
      1 => 1481727837,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0b28353d5_44983020 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="changepassword" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/changepassword">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['password']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['password']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['password']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['password']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['confirm_password']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['confirm_password']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['confirm_password']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['confirm_password']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['old_password']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['old_password']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['old_password']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['old_password']->value['description'];?>
</span>
    </div>
    
    <?php if (!$_smarty_tpl->tpl_vars['password_med']->value->correct()) {?>
        <div class="field error">
            <span class="message">Error, passwords must be the same. Old password must match to your current password.</span>
        </div>
    <?php }?>
    
    <div class="field">
    <?php if (isset($_smarty_tpl->tpl_vars['toolbar_left']->value[0])) {?>
        <?php echo $_smarty_tpl->tpl_vars['toolbar_left']->value[0];?>

    <?php }?>
    </div>
    
</form>
<?php }
}
