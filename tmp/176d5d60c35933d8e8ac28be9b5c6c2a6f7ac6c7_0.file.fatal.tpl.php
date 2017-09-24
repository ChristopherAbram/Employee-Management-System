<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-19 10:16:27
  from "/var/www/html/app/views/fatal.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c0d25b9d6430_67959762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '176d5d60c35933d8e8ac28be9b5c6c2a6f7ac6c7' => 
    array (
      0 => '/var/www/html/app/views/fatal.tpl',
      1 => 1473182369,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c0d25b9d6430_67959762 (Smarty_Internal_Template $_smarty_tpl) {
?>

<article>
    <section class="title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</section>
                
    <section class="content">
                    
    <h1><?php echo $_smarty_tpl->tpl_vars['head']->value['description'];?>
</h1>
    <p><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</p>
                    
    <?php
$__section_err_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_err']) ? $_smarty_tpl->tpl_vars['__smarty_section_err'] : false;
$__section_err_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['messages']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_err_0_total = min(($__section_err_0_loop - 0), $__section_err_0_loop);
$_smarty_tpl->tpl_vars['__smarty_section_err'] = new Smarty_Variable(array());
if ($__section_err_0_total != 0) {
for ($__section_err_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index'] = 0; $__section_err_0_iteration <= $__section_err_0_total; $__section_err_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index']++){
?>
    <h1><?php echo $_smarty_tpl->tpl_vars['head']->value['error'];?>
</h1>
    <p>
    <b><?php echo $_smarty_tpl->tpl_vars['head']->value['message'];?>
:</b> <?php echo $_smarty_tpl->tpl_vars['messages']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_err']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index'] : null)]['message'];?>
<br>
    <b><?php echo $_smarty_tpl->tpl_vars['head']->value['file'];?>
:</b> <?php echo $_smarty_tpl->tpl_vars['messages']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_err']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index'] : null)]['file'];?>
<br>
    <b><?php echo $_smarty_tpl->tpl_vars['head']->value['line'];?>
:</b> <?php echo $_smarty_tpl->tpl_vars['messages']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_err']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index'] : null)]['line'];?>
<br>
    <b><?php echo $_smarty_tpl->tpl_vars['head']->value['code'];?>
:</b> <?php echo $_smarty_tpl->tpl_vars['messages']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_err']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_err']->value['index'] : null)]['code'];?>
<br>
    </p>
    <?php
}
}
if ($__section_err_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_err'] = $__section_err_0_saved;
}
?>
                    
    </section>
</article><?php }
}
