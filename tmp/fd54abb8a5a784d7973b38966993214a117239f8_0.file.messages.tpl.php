<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 19:16:52
  from "/var/www/html/app/views/messages.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c15104e7c933_86171507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd54abb8a5a784d7973b38966993214a117239f8' => 
    array (
      0 => '/var/www/html/app/views/messages.tpl',
      1 => 1482764028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c15104e7c933_86171507 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['error']->value) > 0) {?>
<aside class="board center">
    <div class="message error">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['error']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
        <span><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><br>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
</aside>
<?php }?>

<?php if (count($_smarty_tpl->tpl_vars['warning']->value) > 0) {?>
<aside class="board center">
    <div class="message warning">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['warning']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
        <span><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><br>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
</aside>
<?php }?>

<?php if (count($_smarty_tpl->tpl_vars['correct']->value) > 0) {?>
<aside class="board center">
    <div class="message correct">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['correct']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
        <span><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</span><br>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
</aside>
<?php }
}
}
