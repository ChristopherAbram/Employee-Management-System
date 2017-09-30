<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 15:41:59
  from "/var/www/html/app/views/admin_recycle.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cf9f27dcfcf8_27727412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6f214c829461c44df0a4e843ff1af634be00f7bb' => 
    array (
      0 => '/var/www/html/app/views/admin_recycle.tpl',
      1 => 1506778910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cf9f27dcfcf8_27727412 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_filesize')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.filesize.php';
?>

<?php if ((isset($_smarty_tpl->tpl_vars['files']->value,$_smarty_tpl->tpl_vars['members']->value) && (!empty($_smarty_tpl->tpl_vars['files']->value) || !empty($_smarty_tpl->tpl_vars['members']->value)))) {?>
<section class="item_list">
    <form id="list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/recycle">
        <div class="list level0">
        
        <?php if (isset($_smarty_tpl->tpl_vars['files']->value) && !empty($_smarty_tpl->tpl_vars['files']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="file[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['miniature'])) {?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['miniature'];?>
" width="100" height="100" alt="image" />
                        <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/image_default.png" width="100" height="100" alt="image" />
                        <?php }?>
                    </figure>
                </div>
                <div class="center">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>

                    <div class="user">
                        Size: <?php echo smarty_modifier_filesize($_smarty_tpl->tpl_vars['data']->value['size']);?>
<br>
                    </div>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['members']->value) && !empty($_smarty_tpl->tpl_vars['members']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['members']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="member[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/users.png" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lastname'];?>

                    <div class="user">
                        e-mail: <?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
<br>
                    </div>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php }?>
        
        </div>
    </form>
</section>
<?php } else { ?>
<div class="no_results">No results</div> 
<?php }
}
}
