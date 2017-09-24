<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 13:58:42
  from "/var/www/html/app/views/account_address.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c257f26072c6_28373831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7d8f696feae4b8df507a4b7d8a54117e8216644' => 
    array (
      0 => '/var/www/html/app/views/account_address.tpl',
      1 => 1481727770,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c257f26072c6_28373831 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="address" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/useraddress">
    <div id="country_select_box" class="field <?php if ($_smarty_tpl->tpl_vars['country']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['country']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['country']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['country']->value['description'];?>
</span>
    </div>
    
    <style type="text/css">
        #country_select_box select {
            max-width: 230px;
        }
    </style>
    
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

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['zip']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['street']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['street']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['street']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['street']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['house']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['house']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['house']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['house']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['flat']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['flat']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['flat']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['flat']->value['description'];?>
</span>
    </div>
    
    <div class="field">
    <?php if (isset($_smarty_tpl->tpl_vars['toolbar_left']->value[0])) {?>
        <?php echo $_smarty_tpl->tpl_vars['toolbar_left']->value[0];?>

    <?php }?>
    </div>
    
</form><?php }
}
