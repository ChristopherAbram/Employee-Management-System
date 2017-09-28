<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-28 14:48:28
  from "/var/www/html/app/layouts/userpanel.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59ccef9c8fd970_05214687',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe74e8c7a96f328e47ae6193daf80d8f90621319' => 
    array (
      0 => '/var/www/html/app/layouts/userpanel.tpl',
      1 => 1506602904,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:informer.tpl' => 1,
    'file:noscript.tpl' => 1,
    'file:cookie.tpl' => 1,
    'file:user_header.tpl' => 1,
    'file:messages.tpl' => 1,
    'file:user_avatar.tpl' => 1,
    'file:module_menu.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_59ccef9c8fd970_05214687 (Smarty_Internal_Template $_smarty_tpl) {
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
/panel/userform.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/account.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/header.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/usermain.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/useravatar.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/panel/usermodulemenu.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/message.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/footer.style.css" rel="stylesheet">
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

        
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/addprogress.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/plugins.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/script.js"><?php echo '</script'; ?>
>
        
        <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/logo/Icon/LogoSquareBlack.png">
        
        <style type="text/css">
            
            #headbar {
                margin: 0 auto;
                width: 700px;
            }
            
            #logo {
                float: left;
                 margin: 15px 0 0 0;
            }
            
            #menu {
                float: right;
                margin: 15px 0 0 20px;
                width: 200px;
                text-align: right;
            }
            
            #menu a {
                display: inline;
            }
            
            footer {
                display: none;
                color: #fff;
                font-size: 12px;
                padding: 10px 0;
                text-align: center;
            }
        </style>
        
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


                <header>
                    <?php $_smarty_tpl->_subTemplateRender("file:user_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                </header>

                <?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                
                <main>
                    <div id="module_option">
                        <?php $_smarty_tpl->_subTemplateRender("file:user_avatar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                        <nav id="module_menu">
                        <?php $_smarty_tpl->_subTemplateRender("file:module_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                        </nav>
                    </div>
                            
                    <div id="module_content">
                        <?php echo $_smarty_tpl->tpl_vars['__content__']->value;?>

                    </div>
                </main>
            </div>
                    
            <footer>
                <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            </footer>
        </div>
    </body>
</html>

<?php }
}
