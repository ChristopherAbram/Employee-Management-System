<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:17:07
  from "/var/www/html/app/layouts/general.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c151134de579_86046192',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02b3a50ed4d38a7f01950c12a2517ed8b026a3ce' => 
    array (
      0 => '/var/www/html/app/layouts/general.tpl',
      1 => 1487080663,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:informer.tpl' => 1,
    'file:noscript.tpl' => 1,
    'file:cookie.tpl' => 1,
    'file:identification.tpl' => 1,
    'file:header.tpl' => 1,
    'file:messages.tpl' => 1,
    'file:ancestors.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_59c151134de579_86046192 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="<?php if (isset($_smarty_tpl->tpl_vars['keywords']->value)) {
echo $_smarty_tpl->tpl_vars['keywords']->value;
}?>">
        <meta name="author" content="<?php if (isset($_smarty_tpl->tpl_vars['author']->value)) {
echo $_smarty_tpl->tpl_vars['author']->value;
}?>">
        <meta name="description" content="<?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo $_smarty_tpl->tpl_vars['meta_description']->value;
}?>">
        
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
/header.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/login.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/main.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/article.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/content.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/message.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/footer.style.css" rel="stylesheet">
        
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

        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/slider.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/front.style.css" rel="stylesheet">
        
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/plugins.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/script.js"><?php echo '</script'; ?>
>
        
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/highlight/styles/darcula.css" rel="stylesheet">
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/highlight/highlight.min.js"><?php echo '</script'; ?>
>
        
        <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/logo/Icon/LogoSquareBlack.png">
        
    </head>
    <body>
        <div id="page">
            <div id="container">
                <!-- Information board -->
                <?php $_smarty_tpl->_subTemplateRender("file:informer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                
                <!-- No script info -->
                <?php $_smarty_tpl->_subTemplateRender("file:noscript.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <!-- Cookie info -->
                <?php $_smarty_tpl->_subTemplateRender("file:cookie.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                <!-- Login bar -->
                <?php $_smarty_tpl->_subTemplateRender("file:identification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                
                <header>
                    <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </header>
                
                
                
                <?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


                <main>
                    <?php $_smarty_tpl->_subTemplateRender("file:ancestors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


                    <?php echo $_smarty_tpl->tpl_vars['__content__']->value;?>

                </main>
            </div>
                    
            <footer>
                <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            </footer>
        </div>
    </body>
</html><?php }
}
