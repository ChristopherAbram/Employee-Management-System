<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:16:52
  from "/var/www/html/app/views/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15104e89362_71828601',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd18df4978d4f1bb3a51a626641d5593cc0450479' => 
    array (
      0 => '/var/www/html/app/views/index.tpl',
      1 => 1482923706,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15104e89362_71828601 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="index">
    <div class="content">
        <figure class="logo section"></figure>

        <div class="menu">
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value, 'option', false, 'name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['option']->value) {
?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['option']->value['href'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['active']) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
</a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </ul>
        </div>
    </div>
</div><?php }
}
