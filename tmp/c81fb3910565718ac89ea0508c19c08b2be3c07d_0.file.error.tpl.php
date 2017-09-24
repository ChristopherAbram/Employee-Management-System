<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 10:16:27
  from "/var/www/html/app/layouts/error.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c0d25b9f6578_07581096',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c81fb3910565718ac89ea0508c19c08b2be3c07d' => 
    array (
      0 => '/var/www/html/app/layouts/error.tpl',
      1 => 1474810686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c0d25b9f6578_07581096 (Smarty_Internal_Template $_smarty_tpl) {
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
/header.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/main.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/error.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/article.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/content.style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['style'];?>
/footer.style.css" rel="stylesheet">
        
        <link rel="icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/logo/Icon/LogoSquareBlack.png">
        
    </head>
    <body>
        
        <header>
            <div class="belt"></div>
            <figure class="logo section"></figure>
        </header>
        
        <main>
            
            <?php echo $_smarty_tpl->tpl_vars['__content__']->value;?>

            
            <aside></aside>
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
</html>
<?php }
}
