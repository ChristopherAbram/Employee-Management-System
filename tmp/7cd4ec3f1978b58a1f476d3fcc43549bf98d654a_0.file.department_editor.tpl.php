<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-22 17:56:06
  from "/var/www/html/app/views/department_editor.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c53296831a65_37883556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cd4ec3f1978b58a1f476d3fcc43549bf98d654a' => 
    array (
      0 => '/var/www/html/app/views/department_editor.tpl',
      1 => 1506095764,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c53296831a65_37883556 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/plugins/ckeditor/basic/ckeditor.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/plugins/ckeditor/basic/sample.js"><?php echo '</script'; ?>
>

<style type="text/css">
    #department_title {
        width: 98%;
    }
</style>

<section class="form">
    
    <form id="departmenteditor" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/departmenteditor">
    
    <div class="field <?php if ($_smarty_tpl->tpl_vars['name']->value['input']->error()) {?>error<?php }?>">
        <span><?php echo $_smarty_tpl->tpl_vars['name']->value['title'];?>
</span>
        <?php echo $_smarty_tpl->tpl_vars['name']->value['input'];?>

        <span class="description"><?php echo $_smarty_tpl->tpl_vars['name']->value['description'];?>
</span>
    </div>
    
    <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
    <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

    <span class="description"><?php echo $_smarty_tpl->tpl_vars['desc']->value['description'];?>
</span>
    
    <table>
        <tr>
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['city']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['city']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['city']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['city']->value['description'];?>
</span>
                </div>
            </td>
            
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['zip']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['zip']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['zip']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['zip']->value['description'];?>
</span>
                </div>
            </td>
            
        </tr>
        
        <tr>
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['street']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['street']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['street']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['street']->value['description'];?>
</span>
                </div>
            </td>
            
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['house']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['house']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['house']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['house']->value['description'];?>
</span>
                </div>
            </td>
            
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['flat']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['flat']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['flat']->value['input'];?>

                    <span class="description"><?php echo $_smarty_tpl->tpl_vars['flat']->value['description'];?>
</span>
                </div>
            </td>
        </tr>
    </table>
    
    </form>
</section>
    
<?php echo '<script'; ?>
>
    initSample();
<?php echo '</script'; ?>
><?php }
}
