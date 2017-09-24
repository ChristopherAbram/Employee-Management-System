<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 09:44:17
  from "/var/www/html/app/views/cookie.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c21c514a7178_59576532',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42e9e316047b9a08793fc8112c7fc5e62692d923' => 
    array (
      0 => '/var/www/html/app/views/cookie.tpl',
      1 => 1505893454,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c21c514a7178_59576532 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['cookie_confirmed']->value) {?>
<div id="cookie_info" style="overflow: hidden;">
    <div style="float: left; padding: 5px 20px;"><?php echo $_smarty_tpl->tpl_vars['cookie']->value;?>
</div> 
    <div id="cookie_button">Agree!</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/cookies.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
    
    function show_cookie_bar(){
        var cookie_info = document.getElementById('cookie_info');
        var cookie_button = document.getElementById('cookie_button');

        cookie_button.onclick = function(){
            setCookie('cookie_info', 1, 365*24*60*60);
            cookie_info.style.display = 'none';
        };
    }
    
    if(window.addEventListener){
        window.addEventListener('load', show_cookie_bar);
    }
    else if(window.attachEvent){
        window.attachEvent('onload', show_cookie_bar);
    }
<?php echo '</script'; ?>
>
<?php }
}
}
