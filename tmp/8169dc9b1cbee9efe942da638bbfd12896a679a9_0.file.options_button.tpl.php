<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 12:23:14
  from "/var/www/html/app/views/options_button.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cf7092bd6e24_47918627',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8169dc9b1cbee9efe942da638bbfd12896a679a9' => 
    array (
      0 => '/var/www/html/app/views/options_button.tpl',
      1 => 1506766957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cf7092bd6e24_47918627 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="buttonContener <?php echo $_smarty_tpl->tpl_vars['button']->value['side'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
">
    <div class="button"><?php echo $_smarty_tpl->tpl_vars['button']->value['name'];?>
</div>
    <div class="button-panel">
        <div class="button-arrow"></div>
        <ul class="button-list">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_sortAZ" value="Sort from A to Z"/>
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_sortZA" value="Sort from Z to A"/>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['button']->value['options'], 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['option']->value['name'];?>
" class="working-option switchList_<?php echo $_smarty_tpl->tpl_vars['option']->value['class'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
"/>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </form>
            
            
            <form action="" method="POST" enctype="multipart/form-data">
            <span class="expTitle">Choose options</span>
            <ul class="expand">
                <li class="optionsList">
                     <div class="field">
                        <input type="checkbox" name="all" id="all" checked="checked" /><label for="all">Select all</label>
                     </div>
                     <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['button']->value['list'], 'element', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['element']->value) {
?>
                     <div class="field">
                         <?php $_smarty_tpl->_assignInScope('ending', preg_replace('@[.,\s-]*@i','',$_smarty_tpl->tpl_vars['element']->value['value']));
?>
                         <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['table'];?>
_<?php echo $_smarty_tpl->tpl_vars['button']->value['column'];?>
_<?php echo $_smarty_tpl->tpl_vars['ending']->value;?>
}" 
                         id="check_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['element']->value['value'];?>
" <?php echo $_smarty_tpl->tpl_vars['element']->value['checked'];?>
 />
                         <label for="check_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value['value'];?>
</label>
                     </div>
                     <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </li>
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2submit" value="Show results" style="text-align: right;" />
            </ul>
            </form>
        </ul>
    </div>
</div><?php }
}
