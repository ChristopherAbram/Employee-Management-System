<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-23 20:43:02
  from "/var/www/html/app/layouts/home.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c6ab365e1ed4_70923616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea282c8aa1a33ed4db26b1557094a655a3ff5f6a' => 
    array (
      0 => '/var/www/html/app/layouts/home.tpl',
      1 => 1506192167,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:informer.tpl' => 1,
    'file:noscript.tpl' => 1,
    'file:cookie.tpl' => 1,
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_59c6ab365e1ed4_70923616 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
">
        <meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['author']->value;?>
">
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta_description']->value;?>
">
        
        <!-- Facebook -->
        <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
        <meta property="og:type" content="website">
        <meta property="article:author" content="<?php if (isset($_smarty_tpl->tpl_vars['author']->value)) {
echo $_smarty_tpl->tpl_vars['author']->value;
}?>">
        <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
">
        <meta property="og:description" content="<?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo $_smarty_tpl->tpl_vars['meta_description']->value;
}?>">
        <meta property="og:site_name" content="Krzysztof Abram">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
        <meta name="twitter:description" content="<?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo $_smarty_tpl->tpl_vars['meta_description']->value;
}?>">
        
        <!-- Styles -->
        <link href="app/style/general.style.css" rel="stylesheet" media="screen">
        <link href="app/style/font.style.css" rel="stylesheet" media="screen">
        <link href="app/style/all.style.css" rel="stylesheet" media="screen">
        <link href="app/style/front.style.css" rel="stylesheet" media="screen">
        
        <link rel="icon" type="image/png" href="app/img/solteq.png">
        
        <!-- Scripts -->
        <?php echo '<script'; ?>
 type="text/javascript" src="scripts/js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="scripts/js/start.js"><?php echo '</script'; ?>
>
        
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

        
        <style type="text/css">
            #loading {
                width: 100%;height: 100%;position: fixed;top: 0;z-index: 9999;background: #191919;
            }
            #load-img {
                width: 800px;height: 600px;position: absolute;top: 50%;left: 50%;margin: -300px 0 0 -400px;background: url('app/img/loader.gif') no-repeat; 
            }
        </style>
        
    </head>
    <body>
        
        <!-- Information board -->
        <?php $_smarty_tpl->_subTemplateRender("file:informer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


        <!-- No script info -->
        <?php $_smarty_tpl->_subTemplateRender("file:noscript.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        
        <!-- Cookie info -->
        <?php $_smarty_tpl->_subTemplateRender("file:cookie.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        
        <!-- Loading block - preloader -->
        <div id="loading">
            <div id="load-img"></div>
        </div>
        
        <!-- Picture -->
        <div id="picture"></div>
        
        <header>
            <?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </header>

        <main>
            <?php echo $_smarty_tpl->tpl_vars['__content__']->value;?>

        </main>

        <footer>
            <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </footer>
              
    </body>
</html>
<?php }
}
