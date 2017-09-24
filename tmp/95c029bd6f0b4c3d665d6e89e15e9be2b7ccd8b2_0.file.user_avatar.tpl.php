<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-20 13:58:35
  from "/var/www/html/app/views/user_avatar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c257eb5cafb5_54821275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95c029bd6f0b4c3d665d6e89e15e9be2b7ccd8b2' => 
    array (
      0 => '/var/www/html/app/views/user_avatar.tpl',
      1 => 1481900636,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c257eb5cafb5_54821275 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="user_avatar">
    
    <div id="avatar">
        <img id="loading_avatar" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/loading_small.gif" width="50px" height="50px" style="display: none; width: 50px; height: 50px; position: absolute; left: 50%; top: 50%; margin-left: -25px; margin-top: -25px;" />
        <div class="progressbar"></div>
        <?php ob_start();
echo $_smarty_tpl->tpl_vars['current_user']->value['avatar']['miniature'];
$_prefixVariable1=ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['current_user']->value['avatar']['miniature'];
$_prefixVariable2=ob_get_clean();
if (isset($_prefixVariable1) && !empty($_prefixVariable2)) {?>
        <img id="avatar_image" src="<?php echo $_smarty_tpl->tpl_vars['current_user']->value['avatar']['miniature'];?>
" alt="avatar">
        <?php } else { ?>
        <img id="avatar_image" src="<?php echo $_smarty_tpl->tpl_vars['path']->value['avatar'];?>
" alt="avatar">
        <?php }?>
        <input type="hidden" name="response" value="" />
    </div>
    
    <form id="uploadAvatar" class="uploadAvatar" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/save" method="post" >
        
        <div id="upload_panel" class="avatar_panel">
            <?php ob_start();
echo $_smarty_tpl->tpl_vars['current_user']->value['avatar']['miniature'];
$_prefixVariable3=ob_get_clean();
ob_start();
echo $_smarty_tpl->tpl_vars['current_user']->value['avatar']['miniature'];
$_prefixVariable4=ob_get_clean();
if (!isset($_prefixVariable3) || empty($_prefixVariable4)) {?>
            <div class="uploadAvatarButton" id="uploadAvatarButton">Upload Image</div>
            <input type="file" id="getAvatar" name="files[]" />
            <?php } else { ?>
            <div class="uploadAvatarButton" id="deletebutton">Delete</div>
            <?php }?>
        </div>
        
    </form>
    
</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/informer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/avatar_uploader.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">  
$(document).ready(function(){
    
    // Uploader:
    var up2 = AvatarUploader({
        
        // HTML blocks:
        form:           $('#uploadAvatar'),
        filebutton:     $('#uploadAvatarButton'),
        fileinput:      $('#getAvatar'),
        deletebutton:   $('#deletebutton'),
        loading:        $('#loading_avatar'),
        element:        $('#avatar'),
        info:           $('#info'),
        
        // Request params:
        domain:         '<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
',
        delete:         '<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/delete',
        save:           '<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/imageconnector/save',
        input:          '', // an input type
        removeable:     false
        
    });
    
    // Run uploader:
    up2.run();
    
});
<?php echo '</script'; ?>
><?php }
}
