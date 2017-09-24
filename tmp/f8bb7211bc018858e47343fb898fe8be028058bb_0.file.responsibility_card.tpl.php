<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-23 21:30:41
  from "/var/www/html/app/views/responsibility_card.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c6b66190a960_66142533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8bb7211bc018858e47343fb898fe8be028058bb' => 
    array (
      0 => '/var/www/html/app/views/responsibility_card.tpl',
      1 => 1506195039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c6b66190a960_66142533 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="item">
    <div class="left" style="width: 50px;">
        <input class="check" type="checkbox" name="responsibility[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" style="margin: 18px 0 0 10px;" />
    </div>
    <div class="center">
        <span class="item_title"><input class="title" type="text" name="responsibility[name][<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" style="" /></span>
        <div class="description">
            <textarea class="desc" name="responsibility[description][<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" style="width: 90%; min-height: 50px;"><?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</textarea>
        </div>
    </div>
</div><?php }
}
