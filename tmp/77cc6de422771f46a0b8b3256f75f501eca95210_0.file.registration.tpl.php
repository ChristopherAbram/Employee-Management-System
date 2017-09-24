<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:17:07
  from "/var/www/html/app/views/registration.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15113493623_37306616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77cc6de422771f46a0b8b3256f75f501eca95210' => 
    array (
      0 => '/var/www/html/app/views/registration.tpl',
      1 => 1481896574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15113493623_37306616 (Smarty_Internal_Template $_smarty_tpl) {
?>
<article>
<section class="title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</section>
<section class="content">
    <?php echo $_smarty_tpl->tpl_vars['description']->value;?>

</section>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="registration" method="post" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/registration">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['firstname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['firstname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['firstname']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['firstname']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['lastname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['lastname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['lastname']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['lastname']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['email']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['email']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['email']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['email']->value['description'];?>
</span>
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
        <div style="width: 100%; overflow: hidden;">
        <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['male'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['male_title'];?>
</div>
        <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['female'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['female_title'];?>
</div>
        </div>
        <span class="description"><?php echo $_smarty_tpl->tpl_vars['sex']->value['description'];?>
</span>
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
    
    <div class="field" style="overflow: hidden">
        <div style="float: right;">
        <?php echo $_smarty_tpl->tpl_vars['submit']->value;?>

        </div>
        
        <div style="float: right; margin: 0 10px;">
        <?php echo $_smarty_tpl->tpl_vars['cancel']->value;?>

        </div>
    </div>
    
    </form>
    
</section>
</article><?php }
}
