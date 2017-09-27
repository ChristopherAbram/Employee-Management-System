<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-27 12:58:05
  from "/var/www/html/app/views/agreements.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cb843d699de8_07090231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14de7ace66f0aec564e0b3c24c677310f025761b' => 
    array (
      0 => '/var/www/html/app/views/agreements.tpl',
      1 => 1506509881,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:agreement_card.tpl' => 1,
  ),
),false)) {
function content_59cb843d699de8_07090231 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['agreements']->value)) {?>
<section class="item_list">
    <form id="agreement" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/agreements/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['agreements']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:agreement_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
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
