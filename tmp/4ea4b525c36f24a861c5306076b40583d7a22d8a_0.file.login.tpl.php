<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 10:18:08
  from "/var/www/html/app/views/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c224406922e7_44090482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ea4b525c36f24a861c5306076b40583d7a22d8a' => 
    array (
      0 => '/var/www/html/app/views/login.tpl',
      1 => 1505895483,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c224406922e7_44090482 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="welcome">
    <div id="subs">
        <span class="huge">Welcome to the best employee management system</span><br>
        <span class="small">Together we can change the world.</span>
    </div>

    <div id="login">
        <form id="signin" method="post" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/login">

            <div class="field <?php if ($_smarty_tpl->tpl_vars['error_login']->value) {?>error<?php }?>">
                <span>Email</span>
                <input type="email" id="email" form="signin" name="email" value="" required="required"/>
                <span class="description"></span>
            </div>

            <div class="field <?php if ($_smarty_tpl->tpl_vars['error_login']->value) {?>error<?php }?>">
                <span>Password</span>
                <input type="password" id="password" form="signin" name="password" value="" required="required"/>
                <span class="description"></span>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['login_message']->value != '') {?>
            <div class="field error" style="overflow: hidden;">
                <div class="message" style="padding: 0"><?php echo $_smarty_tpl->tpl_vars['login_message']->value;?>
</div>
            </div>
            <?php }?>
                
            <div class="field" style="overflow: hidden">
                <input id="submit" type="submit" form="signin" name="confirm" value="Sign in"/>
            </div>

        </form>
    </div>
</div><?php }
}
