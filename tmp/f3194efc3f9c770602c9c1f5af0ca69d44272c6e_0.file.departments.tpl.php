<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-22 16:26:55
  from "/var/www/html/app/views/departments.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c51dafda9e75_81525985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3194efc3f9c770602c9c1f5af0ca69d44272c6e' => 
    array (
      0 => '/var/www/html/app/views/departments.tpl',
      1 => 1506090373,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:department_card.tpl' => 1,
  ),
),false)) {
function content_59c51dafda9e75_81525985 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['departments']->value)) {?>
<section class="item_list">
    <form id="department_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/departments/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['departments']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:department_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
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
