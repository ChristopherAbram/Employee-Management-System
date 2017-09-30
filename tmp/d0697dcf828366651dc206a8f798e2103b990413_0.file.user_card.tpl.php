<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 14:25:26
  from "/var/www/html/app/views/user_card.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cf8d36766818_64565451',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0697dcf828366651dc206a8f798e2103b990413' => 
    array (
      0 => '/var/www/html/app/views/user_card.tpl',
      1 => 1506774152,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cf8d36766818_64565451 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.date_format.php';
?>
<div class="item">
    <div class="left">
        <input class="check" type="checkbox" name="user[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" />
        <div class="functions">
        <input class="<?php if ($_smarty_tpl->tpl_vars['data']->value['isactive'] == 0) {?>lock_button_active<?php } else { ?>lock_button<?php }?>" title="isactive" type="submit" name="<?php if ($_smarty_tpl->tpl_vars['data']->value['isactive'] == 0) {?>activate<?php } else { ?>deactivate<?php }?>[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="" />
        </div>
        <figure class="image">
            <img src="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['avatar']) && isset($_smarty_tpl->tpl_vars['data']->value['avatar']['miniature'])) {
echo $_smarty_tpl->tpl_vars['data']->value['avatar']['miniature'];
} else {
echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/users.png<?php }?>" width="100" height="100" alt="image" />
        </figure>
    </div>
    <div class="center" style="width: 70%; max-width: 400px;">
        <a href="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/member/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];?>
</a>
        <div class="info">
            <div class="user">
                <?php echo $_smarty_tpl->tpl_vars['data']->value['role']['name'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['phone'] != '') {?>, <?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];
}?>
                <br><b><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</b>
                <div style="margin: 5px 0 5px 0;">
                <?php if ($_smarty_tpl->tpl_vars['data']->value['employeed'] == 1 && !empty($_smarty_tpl->tpl_vars['data']->value['departments'])) {?>
                    <div>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['departments'], 'depart');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['depart']->value) {
?>
                        <span style="border-radius: 5px; border: solid 1px #ccc; color: #0060ff; padding: 2px 4px; font-size: 11px;"><?php echo $_smarty_tpl->tpl_vars['depart']->value['name'];?>
</span>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </div>
                    <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['responsibilities'])) {?>
                        <div style="margin-top: 5px;">
                       <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['responsibilities'], 'res');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['res']->value) {
?>
                           <span style="border-radius: 5px; border: solid 1px #ccc; color: #888; padding: 0px 4px; font-size: 10px;"><?php echo $_smarty_tpl->tpl_vars['res']->value['name'];?>
</span>
                       <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </div>
                    <?php }?>
                    
                <?php } else { ?>
                    <span style="color: #f00; font-size: 13px;">Not employed</span>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="right" style="margin: 0; width: 200px;">
        <div class="" style="font-size: 10px; margin: 5px 0 0 0;">Registered: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['cdate'],"%B %e, %Y");?>
</div>

        <?php if ($_smarty_tpl->tpl_vars['data']->value['employeed'] == 1 && !empty($_smarty_tpl->tpl_vars['data']->value['money'])) {?>
        <div class="money" style="margin: 20px 0 0 0;">
            <div><span style="font-size: 11px;">Job:</span>&nbsp;<span style="color: #0060ff; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['data']->value['money']['job'];?>
</span>&nbsp;<span style="font-size: 10px;">EUR</span></div>
            <div><span style="font-size: 11px;">Contracts:</span>&nbsp;<span style="color: #0060ff"><?php echo $_smarty_tpl->tpl_vars['data']->value['money']['contract'];?>
</span>&nbsp;<span style="font-size: 10px;">EUR</span></div>
        </div>
        <?php }?>
    </div>
</div><?php }
}
