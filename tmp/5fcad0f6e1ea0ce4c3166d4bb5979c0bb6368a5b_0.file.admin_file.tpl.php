<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:39:07
  from "/var/www/html/app/views/admin_file.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0fb247205_76670774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fcad0f6e1ea0ce4c3166d4bb5979c0bb6368a5b' => 
    array (
      0 => '/var/www/html/app/views/admin_file.tpl',
      1 => 1475425708,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0fb247205_76670774 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_filesize')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.filesize.php';
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.date_format.php';
if (!empty($_smarty_tpl->tpl_vars['files']->value)) {?>
<section class="item_list">
    <form id="file_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/file/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="file[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="1" />
                    <div class="functions">
                    <input class="<?php if ($_smarty_tpl->tpl_vars['data']->value['hide'] == 1) {?>hide_button_active<?php } else { ?>hide_button<?php }?>" title="hide" type="submit" name="<?php if ($_smarty_tpl->tpl_vars['data']->value['hide'] == 1) {?>unhide<?php } else { ?>hide<?php }?>[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="" />
                    <input class="<?php if ($_smarty_tpl->tpl_vars['data']->value['locked'] == 1) {?>lock_button_active<?php } else { ?>lock_button<?php }?>" title="lock" type="submit" name="<?php if ($_smarty_tpl->tpl_vars['data']->value['locked'] == 1) {?>unlock<?php } else { ?>lock<?php }?>[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]" value="" />
                    </div>
                    <figure class="image">
                        <img src="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['miniature'])) {
echo $_smarty_tpl->tpl_vars['data']->value['miniature'];
} else {
echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/miniature/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];
}?>" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    <input class="filename" type="text" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" name="name[<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
]">
                    <div class="info">
                        <div class="user">
                            Size: <?php echo smarty_modifier_filesize($_smarty_tpl->tpl_vars['data']->value['size']);?>
<br>
                            File: <a href="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/get/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/get/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
</a><br>
                            Miniture: <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['miniature'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['miniature'];?>
</a>
                        </div>
                        <div class="edate">Uploaded: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['data']->value['cdate'],"%B %e, %Y %I:%M %p");?>
</div>
                    </div>
                    <div class="description">
                        
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
