<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-30 00:06:11
  from "/var/www/html/app/views/admin_member_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cec3d3323a76_38723417',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a883a1121d6f763900175fabda27540ee7cbae7' => 
    array (
      0 => '/var/www/html/app/views/admin_member_list.tpl',
      1 => 1506722768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:text_button_noopt.tpl' => 3,
    'file:date_button.tpl' => 1,
  ),
),false)) {
function content_59cec3d3323a76_38723417 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/var/www/html/lib/smarty/libs/plugins/modifier.date_format.php';
?>

<div style="width: 80%; margin: 0 auto; border: solid 1px #000000; overflow: hidden; padding: 10px 0; position: fixed; top: 80px;">

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


</div>

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
<?php }?>


<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/smart_button/functions.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

//var button0 = new smartButton( 'tools' ).init( );
var button1 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['firstname_button']->value['id'];?>
" ).init( );
var button2 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['lastname_button']->value['id'];?>
" ).init( );
var button3 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['email_button']->value['id'];?>
" ).init( );
var button4 = new smartButton( "<?php echo $_smarty_tpl->tpl_vars['reg_button']->value['id'];?>
" ).init( );
/*var button2 = new smartButton( 'fnameButton' ).init( );
var button3 = new smartButton( 'lnameButton' ).init( );
var button4 = new smartButton( 'emailButton' ).init( );
var button5 = new smartButton( 'phoneButton' ).init( );
var button6 = new smartButton( 'cityButton' ).init( );
var button6 = new smartButton( 'cdateButton' ).init( );
var button6 = new smartButton( 'dimButton' ).init( );*/

<?php echo '</script'; ?>
><?php }
}
