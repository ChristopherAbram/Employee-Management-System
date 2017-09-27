<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-27 13:43:56
  from "/var/www/html/app/views/agreement_card.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cb8efccb2514_24128151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e439fba19c19db92556bf5e94283a6f9dbb1d535' => 
    array (
      0 => '/var/www/html/app/views/agreement_card.tpl',
      1 => 1506512628,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cb8efccb2514_24128151 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.date_format.php';
$_smarty_tpl->_assignInScope('invalid', !empty($_smarty_tpl->tpl_vars['data']->value['to_date']) && ($_smarty_tpl->tpl_vars['data']->value['to_date'] <= $_smarty_tpl->tpl_vars['date']->value));
$_smarty_tpl->_assignInScope('waiting', !empty($_smarty_tpl->tpl_vars['data']->value['from_date']) && ($_smarty_tpl->tpl_vars['data']->value['from_date'] > $_smarty_tpl->tpl_vars['date']->value));
?>
<div class="item" style="<?php if ($_smarty_tpl->tpl_vars['invalid']->value) {?>color: #666; background: #f4f4f4;<?php }?>">
    <div class="left" style="width: 50px;">
        <?php if ($_smarty_tpl->tpl_vars['current_user']->value['role']['access_level'] == 0) {?>
        <input class="check" type="checkbox" name="agreement[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" style="margin: 5px 0 0 10px;" />
        <?php }?>
    </div>
    <div class="center">
        <span class="item_title">
            <?php if ($_smarty_tpl->tpl_vars['invalid']->value) {?><span style="color: red;">[TERMINATED]</span> <?php }?>
            <?php if (!$_smarty_tpl->tpl_vars['invalid']->value && $_smarty_tpl->tpl_vars['waiting']->value) {?><span style="color: #0060ff;">[WAITING]</span> <?php }?>
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['data']->value['responsibility']['name'],128);?>
</span>
        
        <div class="info">
            
            <div class="user">
                <?php if ($_smarty_tpl->tpl_vars['current_user']->value['role']['access_level'] == 0) {?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/departmenteditor/<?php echo $_smarty_tpl->tpl_vars['data']->value['department']['namepath'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['department']['name'];?>
</a>
                <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['data']->value['department']['name'];?>

                <?php }?>
                <br>
                <span><?php echo $_smarty_tpl->tpl_vars['data']->value['working_time']['name'];?>
 job</span><br>
                <span><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['from_date'],"%B %e, %Y");?>
 <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['to_date'])) {?>until <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['to_date'],"%B %e, %Y");
}?></span>
            </div>
        </div>
        <div class="description" style="font-style: italic; color: #666;">
            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['data']->value['description'],250);?>

        </div>
    </div>
    <div class="right" style="padding: 0 10px 0 0; width: 200px;color: <?php if ($_smarty_tpl->tpl_vars['invalid']->value) {?>#666;<?php } else { ?>#0060ff;<?php }?> font-size: 25px; text-align: right;">
        <?php echo $_smarty_tpl->tpl_vars['data']->value['salary'];?>
 EUR
    </div>
</div><?php }
}
