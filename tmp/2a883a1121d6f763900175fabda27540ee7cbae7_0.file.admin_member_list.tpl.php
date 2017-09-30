<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 12:54:06
  from "/var/www/html/app/views/admin_member_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cf77ceb15994_35566826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a883a1121d6f763900175fabda27540ee7cbae7' => 
    array (
      0 => '/var/www/html/app/views/admin_member_list.tpl',
      1 => 1506768804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:text_button_noopt.tpl' => 3,
    'file:date_button.tpl' => 1,
    'file:options_button.tpl' => 1,
    'file:user_card.tpl' => 1,
  ),
),false)) {
function content_59cf77ceb15994_35566826 (Smarty_Internal_Template $_smarty_tpl) {
?>

<div style="margin: 0 auto; width: 100%; border-bottom: solid 1px #bbb;  padding: 5px 0; position: fixed; top: 91px; left: 0; background: #e1e1e1;">

    <div class="left" style="position: relative; left: 270px;">
    <?php $_smarty_tpl->_assignInScope('button', $_smarty_tpl->tpl_vars['firstname_button']->value);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:text_button_noopt.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
    <?php $_smarty_tpl->_assignInScope('button', $_smarty_tpl->tpl_vars['lastname_button']->value);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:text_button_noopt.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    
    <?php $_smarty_tpl->_assignInScope('button', $_smarty_tpl->tpl_vars['email_button']->value);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:text_button_noopt.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    
    <?php $_smarty_tpl->_assignInScope('button', $_smarty_tpl->tpl_vars['reg_button']->value);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:date_button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
    <?php $_smarty_tpl->_assignInScope('button', $_smarty_tpl->tpl_vars['role_button']->value);
?>
    <?php $_smarty_tpl->_subTemplateRender("file:options_button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
</div>

<div style="margin-top: 8px;">
<?php if (!empty($_smarty_tpl->tpl_vars['members']->value)) {?>
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
            <?php $_smarty_tpl->_subTemplateRender("file:user_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

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
<?php }?>
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/smart_button/functions.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
var button1 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['firstname_button']->value['id'];?>
" ).init( );
var button2 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['lastname_button']->value['id'];?>
" ).init( );
var button3 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['email_button']->value['id'];?>
" ).init( );
var button4 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['reg_button']->value['id'];?>
" ).init( );
var button5 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['role_button']->value['id'];?>
" ).init( );
<?php echo '</script'; ?>
><?php }
}
