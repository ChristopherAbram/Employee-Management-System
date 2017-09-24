<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-21 15:39:10
  from "/var/www/html/app/views/admin_browse_upload.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c3c0fe86d004_62967333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6045936c79fe702a174ea55077799032d246eec' => 
    array (
      0 => '/var/www/html/app/views/admin_browse_upload.tpl',
      1 => 1481900088,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c3c0fe86d004_62967333 (Smarty_Internal_Template $_smarty_tpl) {
?>
<form id="uploadForm" class="uploadForm" action="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/save" method="post" enctype="multipart/form-data">
    
    <div class="panel">
        <div class="uploadFileButton" id="uploadFileButton" style="margin: 10px;">Upload File &gt;</div>
        <input type="file" id="getFile" name="files[]" multiple="multiple" />
    </div>

    <section id="file_area">
        <section id="no_results" style="display: none; padding: 20px 0;" class="no_results">Select files and upload</section>
    </section>
    
</form>
    
    <div id="wait" style="display: none; margin: 20px 0 10px 0;">
        <img src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/loading_small.gif" style="position: relative; left: 50%; margin-left: -25px;" />
    </div>
    
    <div id="more">More &gt;</div>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/informer.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/ListLoader.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/ListRunner.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/addprogress.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/scripts/js/upload/uploader.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
    
    var runner = new ListRunner({
        
        // Html blocks:
        morebutton:     $('#more'),
        noresults:      $('#no_results'),
        element:        $('#file_area'),
        info:           $('#info'),
        wait:           $('#wait'),
        
        // Define action for each result block:
        classifier:     '.tile',
        action:         function(index, e){ 
            //e.s
        },
        
        // Request parameters:
        count:          10,
        results:        '<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/getfilelist',
        resultsexist:   '<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/nextfilepageexists',
        parameters:     { removeable: 'false', input: '' }
        
    });
    
    // Run:
    runner.run();
    
    
    // Uploader:
    var up = Uploader({
        
        // HTML blocks:
        form:           $('#uploadForm'),
        filebutton:     $('#uploadFileButton'),
        fileinput:      $('#getFile'),
        element:        $('#file_area'),
        info:           $('#info'),
        
        // Request params:
        delete:         '<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/delete',
        save:           '<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/connector/save',
        input:          '', // an input type
        removeable:     false
        
    });
    
    // Run uploader:
    up.run();
    
});
<?php echo '</script'; ?>
><?php }
}
