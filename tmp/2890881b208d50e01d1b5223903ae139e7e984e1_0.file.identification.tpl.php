<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:16:52
  from "/var/www/html/app/views/identification.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15104e46847_00237355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2890881b208d50e01d1b5223903ae139e7e984e1' => 
    array (
      0 => '/var/www/html/app/views/identification.tpl',
      1 => 1482931644,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15104e46847_00237355 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['user_identified']->value) {?>
<div id="login_bar" style="display: <?php if ($_smarty_tpl->tpl_vars['error_login']->value) {?>block<?php } else { ?>none<?php }?>;">
    <div class="close_button" id="login_bar_close"></div>
    <div class="login_area">
        <form id="login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/login?url=<?php echo urlencode($_smarty_tpl->tpl_vars['path']->value['current']);?>
">
            <div class="title">Log into your account</div>
            <div class="field <?php if ($_smarty_tpl->tpl_vars['error_login']->value) {?>error<?php }?>" style="overflow: hidden">
                <div id="email">
                    <span class="label">E-mail:</span>
                    <input type="email" name="email" value="" required="required"/>
                </div>
                <div id="password">
                    <span class="label">Password:</span>
                    <input type="password" name="password" value="" required="required"/>
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['login_message']->value != '') {?>
            <div class="field error" style="overflow: hidden;">
                <div class="message" style="padding: 0 0 0 30px"><?php echo $_smarty_tpl->tpl_vars['login_message']->value;?>
</div>
            </div>
            <?php }?>

            <div style="position: relative; overflow: hidden; height: 50px;">

                <div id="remember">
                    <input type="checkbox" name="remember"/> Remember me
                </div>

                <div id="login_button_area" class="field">
                    <input id="login_submit" type="submit" name="login_submition" value="Log in"/>
                </div>

            </div>

        </form>
    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
    
    function show_login_bar(){
        var login_bar = document.getElementById('login_bar');
        var login_button = document.getElementById('login_button');
        var close_button = document.getElementById('login_bar_close');

        if(login_button && close_button){
            login_button.onclick = function(){
                login_bar.style.display = 'block';
            };

            close_button.onclick = function(){
                login_bar.style.display = 'none';
            };
        }
    }
    
    if(window.addEventListener){
        window.addEventListener('load', show_login_bar)
    }
    else if(window.attachEvent){
        window.attachEvent('onload', show_login_bar)
    }
<?php echo '</script'; ?>
>
<?php }
}
}
