<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 14:59:42
  from "/var/www/html/app/views/account.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c2663e2d5094_45134833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '077305c7c545fcfab68a90406211d6240f634c7b' => 
    array (
      0 => '/var/www/html/app/views/account.tpl',
      1 => 1481727819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c2663e2d5094_45134833 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="userdata" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/userdata">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['firstname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['firstname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['firstname']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['firstname']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['lastname']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['lastname']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['lastname']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['lastname']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['email']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['email']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['email']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['email']->value['description'];?>
</span>
    </div>
    
    <div class="field">
        <span><?php echo $_smarty_tpl->tpl_vars['sex']->value['title'];?>
</span>
        <div style="width: 100%; overflow: hidden;">
            <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['male'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['male_title'];?>
</div>
            <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['female'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['female_title'];?>
</div>
        </div>
        <div class="description"><?php echo $_smarty_tpl->tpl_vars['sex']->value['description'];?>
</div>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['bdate']->value['input']->error()) {?>error<?php }?>" style="width: 100%;">
        <span><?php echo $_smarty_tpl->tpl_vars['bdate']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['bdate']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['bdate']->value['description'];?>
</span>
    </div>
    
    <div class="field">
    <?php if (isset($_smarty_tpl->tpl_vars['toolbar_left']->value[0])) {?>
        <?php echo $_smarty_tpl->tpl_vars['toolbar_left']->value[0];?>

    <?php }?>
    </div>
    
</form>
<?php }
}
