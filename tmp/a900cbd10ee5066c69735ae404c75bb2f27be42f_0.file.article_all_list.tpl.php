<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:37:43
  from "/var/www/html/app/views/article_all_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0a79f36a4_87689105',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a900cbd10ee5066c69735ae404c75bb2f27be42f' => 
    array (
      0 => '/var/www/html/app/views/article_all_list.tpl',
      1 => 1475427139,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:admin_article_card.tpl' => 1,
  ),
),false)) {
function content_59c3c0a79f36a4_87689105 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['articles']->value)) {?>
<section class="item_list">
    <form id="article_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/article/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articles']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:admin_article_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
        
    </form>
</section>
<?php } else { ?>
<div class="no_results">No results</div> 
<?php }
}
}
