<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-22 16:01:13
  from "/var/www/html/app/views/department_card.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c517a9db1bd4_10073069',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98f41c49d7e0e1009d5bbde0801ca6d2c03fc66a' => 
    array (
      0 => '/var/www/html/app/views/department_card.tpl',
      1 => 1506088869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c517a9db1bd4_10073069 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.truncate.php';
?>
<div class="item">
    <div class="left" style="width: 50px;">
        <input class="check" type="checkbox" name="department[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" style="margin: 18px 0 0 10px;" />
    </div>
    <div class="center">
        <span class="item_title"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['data']->value['name'],128);?>
</span>
        <a class="edit_button" href="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/departmenteditor/<?php echo $_smarty_tpl->tpl_vars['data']->value['namepath'];?>
">edit</a>
        
        <div class="info">
            
            <div class="user">
                <?php $_smarty_tpl->_assignInScope('google_link', ((string)$_smarty_tpl->tpl_vars['data']->value['zip']).", ".((string)$_smarty_tpl->tpl_vars['data']->value['city']).", ".((string)$_smarty_tpl->tpl_vars['data']->value['street']).", ".((string)$_smarty_tpl->tpl_vars['data']->value['house']));
?>
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($_smarty_tpl->tpl_vars['google_link']->value);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['zip'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['city'];?>
, <?php echo $_smarty_tpl->tpl_vars['data']->value['street'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['house'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['flat'];?>
</a>
            </div>
        </div>
        <div class="description">
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['data']->value['description'],250);?>

        </div>
    </div>
</div><?php }
}
