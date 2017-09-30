<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 12:07:52
  from "/var/www/html/app/views/date_button.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cf6cf8dbfef2_80764499',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e90855a2af6e2a3692cc3d22e1cb1221ae463663' => 
    array (
      0 => '/var/www/html/app/views/date_button.tpl',
      1 => 1506766070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cf6cf8dbfef2_80764499 (Smarty_Internal_Template $_smarty_tpl) {
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
_sortSN" value="Sort oldest to newest"/>
            <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_sortNS" value="Sort newest to oldest"/>
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
            <span class="expTitle">Date filters</span>
            <ul class="expand">
                <li>
                    Specify the conditions:
                    <div class="field" style="overflow: hidden;">
                        <select name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1equals">is equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1notequals">is not equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isafter">is after</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isafterorequal">is after or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isbefore">is before</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1isbeforeorequal">is before or equal</option>
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
_1input" id="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1input" style="float: left; width: 40%;" />
                    </div>
                     <div class="field" style="overflow: hidden;">
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
                    <div class="field" style="overflow: hidden;">
                        <select name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2equals">is equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2notequals">is not equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isafter">is after</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isafterorequal">is after or equal</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isbefore">is before</option>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2isbeforeorequal">is before or equal</option>
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
_2input" id="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_2input" style="float: left; width: 40%;" />
                    </div>
                    <div class="field explain" style="overflow: hidden;">
                        Sign ? represents any single character.<br>
                        Sign * represents any string.<br><br>
                        <span style="font-size: 11px; font-style: italic;">Notice that very often date is save in 'YYYY-MM-DD hh:mm:ss' format. 
                            Applying 'is equal' filter with date only is not working in such cases.</span><br>
                        <span style="font-size: 11px; font-style: italic;">Notice that in filters: is after, is before ( or equal ) signs like " ?, * " are ignored.</span>
                    </div>
                </li>
                <input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['button']->value['id'];?>
_1submit" value="Show results" style="text-align: right;"/>
            </ul>
            </form>
            
        </ul>
    </div>
</div><?php }
}
