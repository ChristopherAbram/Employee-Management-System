<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-24 11:33:13
  from "/var/www/html/app/views/extra_1.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c77bd980bbd6_97719881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ecd597755bd16d6e2a92717d9d3785c9da56e2c1' => 
    array (
      0 => '/var/www/html/app/views/extra_1.tpl',
      1 => 1506245583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c77bd980bbd6_97719881 (Smarty_Internal_Template $_smarty_tpl) {
?>

<style type="text/css">
#desc_input {
    min-width: 80%;
    min-height: 150px;
}
#citation {
    min-width: 80%;
}
</style>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="ext" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/extra">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['desc']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['desc']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['citation']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['citation']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['citation']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['citation']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['phone']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['phone']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['phone']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['phone']->value['description'];?>
</span>
    </div>
    
    <div class="field" style="overflow: hidden;">
        <span><?php echo $_smarty_tpl->tpl_vars['role']->value['title'];?>
</span>
        <div>
        <?php echo $_smarty_tpl->tpl_vars['role']->value['input1'];?>
 <?php echo $_smarty_tpl->tpl_vars['role']->value['title1'];?>

        </div>
        <div>
        <?php echo $_smarty_tpl->tpl_vars['role']->value['input2'];?>
 <?php echo $_smarty_tpl->tpl_vars['role']->value['title2'];?>

        </div>
    </div>
    
    </form>
</section><?php }
}
