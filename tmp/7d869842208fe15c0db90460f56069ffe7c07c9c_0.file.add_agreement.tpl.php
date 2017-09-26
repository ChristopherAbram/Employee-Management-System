<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-26 13:14:18
  from "/var/www/html/app/views/add_agreement.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59ca368a442e81_16037010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d869842208fe15c0db90460f56069ffe7c07c9c' => 
    array (
      0 => '/var/www/html/app/views/add_agreement.tpl',
      1 => 1506424265,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ca368a442e81_16037010 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style type="text/css">
    #department_title {
        width: 98%;
    }
</style>

<section class="form">
    
    <form id="agreement" method="post" action="">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['department']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['department']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['department']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['department']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['responsibility']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['responsibility']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['responsibility']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['responsibility']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['working_time']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['working_time']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['working_time']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['working_time']->value['description'];?>
</span>
    </div>
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['salary']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['salary']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['salary']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['salary']->value['description'];?>
</span>
    </div>
    
    <table>
        <tr>
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['from_date']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['from_date']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['from_date']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['from_date']->value['description'];?>
</span>
                </div>
            </td>
            
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['to_date']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['to_date']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['to_date']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['to_date']->value['description'];?>
</span>
                </div>
            </td>
            
        </tr>
        
    </table>
    
    </form>
</section><?php }
}
