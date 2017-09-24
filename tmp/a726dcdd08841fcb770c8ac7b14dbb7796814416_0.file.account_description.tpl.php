<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:37:58
  from "/var/www/html/app/views/account_description.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0b6acaa00_29631539',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a726dcdd08841fcb770c8ac7b14dbb7796814416' => 
    array (
      0 => '/var/www/html/app/views/account_description.tpl',
      1 => 1481895516,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0b6acaa00_29631539 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="ext" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/userdescription">
    
    <style type="text/css">
        #description_area textarea#desc_input {
            width: 95%;
            min-width: 240px;
            height: 250px;
        }
        
        #citation input {
            width: 95%;
        }
        
        @media screen and (max-width: 700px) {
            #description_area textarea#desc_input {
                width: 230px;
                min-width: 230px;
                height: 250px;
            }
            
            #citation input {
                width: 230px;
            }
        }
        
    </style>
    
    <div id="description_area" class="field <?php if ($_smarty_tpl->tpl_vars['desc']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['desc']->value['description'];?>
</span>
    </div>
    
    <div id="citation" class="field <?php if ($_smarty_tpl->tpl_vars['citation']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['citation']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['citation']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['citation']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['phone']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['phone']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['phone']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['phone']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['profile']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['profile']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['profile']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['profile']->value['description'];?>
</span>
    </div>
    
    <div class="field">
    <?php if (isset($_smarty_tpl->tpl_vars['toolbar_left']->value[0])) {?>
        <?php echo $_smarty_tpl->tpl_vars['toolbar_left']->value[0];?>

    <?php }?>
    </div>
    
</form><?php }
}
