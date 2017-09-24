<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:38:04
  from "/var/www/html/app/views/admin_member_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0bc44b325_36262714',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a883a1121d6f763900175fabda27540ee7cbae7' => 
    array (
      0 => '/var/www/html/app/views/admin_member_list.tpl',
      1 => 1475492720,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0bc44b325_36262714 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.date_format.php';
if (!empty($_smarty_tpl->tpl_vars['members']->value)) {?>
<section class="item_list">
    <form id="user_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/members/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['members']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
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
                <div class="center">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/member/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];?>
</a>
                    <div class="info">
                        <div class="user">
                            e-mail: <?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
<br>
                            role: <?php echo $_smarty_tpl->tpl_vars['data']->value['role']['name'];?>

                        </div>
                        <div class="edate">Registered: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['cdate'],"%B %e, %Y");?>
</div>
                    </div>
                </div>
            </div>
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
