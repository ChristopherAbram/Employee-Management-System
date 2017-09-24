<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:49:47
  from "/var/www/html/app/views/yourcomments.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c37ba320d7_53855089',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e454a6f262ca83b6959ae945ecb0e5d43661fbcc' => 
    array (
      0 => '/var/www/html/app/views/yourcomments.tpl',
      1 => 1481728083,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:user_comment_card.tpl' => 1,
  ),
),false)) {
function content_59c3c37ba320d7_53855089 (Smarty_Internal_Template $_smarty_tpl) {
if (!empty($_smarty_tpl->tpl_vars['comments']->value)) {?>
    
<div class="field" style="width: 100%; overflow: hidden;">
<?php if (isset($_smarty_tpl->tpl_vars['toolbar_right']->value[0])) {?>
    <?php echo $_smarty_tpl->tpl_vars['toolbar_right']->value[0];?>

<?php }?>
</div>

<section class="item_list">
    <form id="comment_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/yourcomments/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:user_comment_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
        
    </form>
</section>

<div class="field" style="width: 100%; overflow: hidden;">
<?php if (isset($_smarty_tpl->tpl_vars['toolbar_right']->value[0])) {?>
    <?php echo $_smarty_tpl->tpl_vars['toolbar_right']->value[0];?>

<?php }?>
</div>
            
<?php } else { ?>
<div class="no_results">No results</div> 
<?php }
}
}
