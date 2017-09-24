<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:41:29
  from "/var/www/html/app/views/admin_registration.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c189625f20_71525617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b420dd6a3bd44641c718e90ebcc3893aa52c344' => 
    array (
      0 => '/var/www/html/app/views/admin_registration.tpl',
      1 => 1475503715,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c189625f20_71525617 (Smarty_Internal_Template $_smarty_tpl) {
?>

<section class="form" style="margin: -30px 0 40px 0;">
    <form id="cancel" method="post" action=""></form>
    <form id="registration" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/registration">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['firstname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['firstname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['firstname']->value['input'];?>

    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['lastname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['lastname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['lastname']->value['input'];?>

    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['email']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['email']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['email']->value['input'];?>

    </div>
    
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
    
    <?php if (!$_smarty_tpl->tpl_vars['password_med']->value->correct()) {?>
        <div class="field error">
            <span class="message">Incorrect passwords. Must be the same.</span>
        </div>
    <?php }?>
    
    <div class="field">
        <span><?php echo $_smarty_tpl->tpl_vars['sex']->value['title'];?>
</span>
        <span class="description"><?php echo $_smarty_tpl->tpl_vars['sex']->value['description'];?>
</span>
        <div style="float: left; width: 150px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['male'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['male_title'];?>
</div>
        <div style="float: left; width: 150px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['female'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['female_title'];?>
</div>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['bdate']->value['input']->error()) {?>error<?php }?>" style="width: 100%; margin: 30px 0 0 0;">
        <span><?php echo $_smarty_tpl->tpl_vars['bdate']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['bdate']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['bdate']->value['description'];?>
</span>
    </div>
    
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['captcha']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['captcha']->value['title'];?>
</span>
        <span class="description"><?php echo $_smarty_tpl->tpl_vars['captcha']->value['description'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['captcha']->value['input'];?>

    </div>
    
    </form>
    
</section><?php }
}
