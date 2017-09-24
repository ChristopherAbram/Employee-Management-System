<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-24 18:24:53
  from "/var/www/html/app/views/admin_address.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c7dc55b83258_52697759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cfcc30dc398488dd0782b0a8bfe806aeebde5370' => 
    array (
      0 => '/var/www/html/app/views/admin_address.tpl',
      1 => 1506270286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c7dc55b83258_52697759 (Smarty_Internal_Template $_smarty_tpl) {
?>

<section class="form" style="margin: -30px 0 40px 0;">
    <form id="cancel" method="post" action=""></form>
    <form id="address" method="post" action="">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['country']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['country']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['country']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['country']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['city']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['city']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['city']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['city']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['zip']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['zip']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['zip']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['zip']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['street']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['street']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['street']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['street']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['house']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['house']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['house']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['house']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['flat']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['flat']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['flat']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['flat']->value['description'];?>
</span>
    </div>
    
    </form>
    
</section><?php }
}
