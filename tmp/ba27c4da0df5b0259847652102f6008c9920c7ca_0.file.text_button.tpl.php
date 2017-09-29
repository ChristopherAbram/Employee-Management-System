<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-29 23:22:58
  from "/var/www/html/app/views/text_button.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59ceb9b2452761_09630054',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba27c4da0df5b0259847652102f6008c9920c7ca' => 
    array (
      0 => '/var/www/html/app/views/text_button.tpl',
      1 => 1506720132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ceb9b2452761_09630054 (Smarty_Internal_Template $_smarty_tpl) {
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
" class="switchList_<?php echo $_smarty_tpl->tpl_vars['option']->value['class'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
"/>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </form>
            
            <form action="" method="POST" enctype="multipart/form-data">
            <span class="expTitle">Text filters</span>
            <ul class="expand">
                <li>
                    Specify the conditions:
                    <div class="field">
                        <select name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1equals">is equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1notequals">is not equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isgreaterthan">is greater then</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isgreaterthanorequal">is greater then or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1islessthan">is lower then</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1islessthanorequal">is lower then or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1beginsfrom">starts from</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1notbeginsfrom">does not start from</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1endsat">ends with</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1notendsat">does not end with</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1contains">includes</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1notcontains">does not include</option>
                        </select>
                        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1input" style="float: left; width: 47%;" />
                    </div>
                    <div class="field">
                        <div style="float: left;">
                        	<input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_logic" id="And" value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_and" checked="checked" />
                            <label for="And">And</label>
                        </div>
                        <div style="float: left;">
                        	<input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_logic" id="Or" value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_or" />
                            <label for="Or">Or</label>
                        </div>
                    </div>
                    <div class="field">
                        <select name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2equals">is equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2notequals">is not equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isgreaterthan">is greater then</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isgreaterthanorequal">is greater then or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2islessthan">is lower then</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2islessthanorequal">is lower then or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2beginsfrom">starts from</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2notbeginsfrom">does not start from</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2endsat">ends with</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2notendsat">does not end with</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2contains">includes</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2notcontains">does not include</option>
                        </select>
                        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2input" style="float: left; width: 47%;" />
                    </div>
                    <div class="field">
                        Sign ? represents any single character.<br />
                        Sign * represents any string.
                    </div>
                </li>
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1submit" value="Show results" style="text-align: right;" />
            </ul>
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
                         <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['table'];?>
_<?php echo $_smarty_tpl->tpl_vars['button']->value['column'];?>
_" 
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
