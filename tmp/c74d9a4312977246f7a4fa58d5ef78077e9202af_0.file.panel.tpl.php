<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 13:58:35
  from "/var/www/html/app/layouts/panel.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c257eb5ab869_04272019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c74d9a4312977246f7a4fa58d5ef78077e9202af' => 
    array (
      0 => '/var/www/html/app/layouts/panel.tpl',
      1 => 1482770243,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:informer.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:user_avatar.tpl' => 1,
    'file:module_menu.tpl' => 1,
    'file:toolbar.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_59c257eb5ab869_04272019 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/all.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/font.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/general.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/menu.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/informer.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/form.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/account.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/header.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/menu.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/modulemenu.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/toolbar.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/main.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/message.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/footer.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/userupload.style.css" rel="stylesheet">
        
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['styles']->value, 'style');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['style']->value) {
?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
" rel="stylesheet">
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        
        <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/logo/Icon/LogoSquareBlack.png">
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/jquery-ui.min.js"><?php echo '</script'; ?>
>
        
    </head>
    <body>
        <?php $_smarty_tpl->_subTemplateRender("file:informer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        
        <header>
            <div class="belt"></div>
            
            <figure class="logo section"></figure>
            
            <nav class="section">
                <div style="position: absolute; bottom: 0;">
                <?php $_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </div>
            </nav>
            
            <div class="section" id="extra">
                <div class="account">
                    <?php if ($_smarty_tpl->tpl_vars['user_identified']->value) {?>
                    <a class="button" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/logout">Log out</a>
                    <?php }?>
                </div>
            </div>
        </header>
        
        <main>
            <nav id="module_menu">
                <div id="theme_img">
                <?php $_smarty_tpl->_subTemplateRender("file:user_avatar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </div>
                <?php $_smarty_tpl->_subTemplateRender("file:module_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            </nav>
            
            <?php $_smarty_tpl->_subTemplateRender("file:toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            
            <?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            
            <article>
                <?php echo $_smarty_tpl->tpl_vars['__content__']->value;?>

            </article>
        </main>
        
        <footer>
            <div class="belt"></div>
            
            <div class="foot">
                &COPY; <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 Christopher John Abram.<br>
                All Right Reserved.
            </div>
        </footer>
    </body>
</html><?php }
}
