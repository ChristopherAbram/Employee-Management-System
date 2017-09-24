<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:37:40
  from "/var/www/html/app/views/page_admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0a4e3a254_80842505',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9edf43d7a28c64cf90c48563a9df92c0b819194' => 
    array (
      0 => '/var/www/html/app/views/page_admin.tpl',
      1 => 1474453719,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0a4e3a254_80842505 (Smarty_Internal_Template $_smarty_tpl) {
?>

<section class="item_list">
    <form id="page_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/page">
    
    <?php echo $_smarty_tpl->tpl_vars['page_tree']->value;?>

    
    </form>
</section><?php }
}
