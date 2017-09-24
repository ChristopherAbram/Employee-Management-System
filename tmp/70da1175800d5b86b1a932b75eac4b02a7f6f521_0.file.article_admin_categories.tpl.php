<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:48:39
  from "/var/www/html/app/views/article_admin_categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c337daee05_75930423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70da1175800d5b86b1a932b75eac4b02a7f6f521' => 
    array (
      0 => '/var/www/html/app/views/article_admin_categories.tpl',
      1 => 1478802844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c337daee05_75930423 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['pages']->value)) {?>
<section class="item_list">
    
    <div class="list level0">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pages']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
        <div class="item">
            <div class="left"></div>
            <div class="center">
                <a href="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/article/<?php echo $_smarty_tpl->tpl_vars['data']->value['namepath'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a>
            </div>
            <div class="right" style="width: 50px;">
                <span class="item_count"><?php echo $_smarty_tpl->tpl_vars['data']->value['articles_count'];?>
</span>
            </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
    
</section>
<?php } else { ?>
<div class="no_results">No results</div> 
<?php }
}
}
