<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-24 11:08:06
  from "/var/www/html/app/views/extra.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c775f6de6853_06629403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '122b34265d9e4257b48975d7d3ecc307c79f2927' => 
    array (
      0 => '/var/www/html/app/views/extra.tpl',
      1 => 1481897630,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c775f6de6853_06629403 (Smarty_Internal_Template $_smarty_tpl) {
?>
<article>
<section class="title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</section>
<section class="content">
    <?php echo $_smarty_tpl->tpl_vars['description']->value;?>

</section>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="ext" method="post" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/extra">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['desc']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

        <span class="description"><span class="optional">(optional)</span><?php echo $_smarty_tpl->tpl_vars['desc']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['citation']->value['input']->error()) {?>error<?php }?>">
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
    
    <div class="field" style="overflow: hidden;">
        <div style="float: right;">
        <?php echo $_smarty_tpl->tpl_vars['submit']->value;?>

        </div>
        
        <div style="float: right; margin: 0 10px;">
        <?php echo $_smarty_tpl->tpl_vars['cancel']->value;?>

        </div>
    </div>
    
    </form>
</section>
</article><?php }
}
