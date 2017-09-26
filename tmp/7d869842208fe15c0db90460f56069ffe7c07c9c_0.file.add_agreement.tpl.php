<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-26 19:46:37
  from "/var/www/html/app/views/add_agreement.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59ca927d105d28_93876689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d869842208fe15c0db90460f56069ffe7c07c9c' => 
    array (
      0 => '/var/www/html/app/views/add_agreement.tpl',
      1 => 1506447995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ca927d105d28_93876689 (Smarty_Internal_Template $_smarty_tpl) {
?>
<style type="text/css">
    
    #departments, #responsibilities, #working-times {
        width: 300px;
    }
    
    #salary {
        width: 250px;
        font-size: 35px;
        color: #0060ff;
        border: none;
    }
    
    #salary:focus {
        box-shadow: none;
    }
    
    #desc_input {
        min-width: 80%;
        min-height: 150px;
    }
    
    #curr {
        display: block;
        font-size: 35px;
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
    
    <table>
        <tr>
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['salary']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['salary']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['salary']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['salary']->value['description'];?>
</span>
                </div>
            </td>
            <td><div class="field" id="curr"><span style="position: relative; top: 43px;">EUR</span></div></td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td style="width: 200px;">
                <div class="field <?php if ($_smarty_tpl->tpl_vars['from_date']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['from_date']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['from_date']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['from_date']->value['description'];?>
</span>
                </div>
            </td>
            
            <td style="width: 200px; padding-left: 30px;">
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
                
    <div class="field <?php if ($_smarty_tpl->tpl_vars['desc']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['desc']->value['description'];?>
</span>
    </div>
    
    </form>
</section><?php }
}
