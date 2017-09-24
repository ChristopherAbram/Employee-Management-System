<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-24 17:43:47
  from "/var/www/html/app/views/admin_member.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c7d2b39b2812_94471970',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba8420971fe817aa9a5bf97069170eaccaa57e7e' => 
    array (
      0 => '/var/www/html/app/views/admin_member.tpl',
      1 => 1506267395,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59c7d2b39b2812_94471970 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section class="title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</section>

<section class="form">
    <form id="member" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/member/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
        
        <table style="width: 100%;">
            <tr>
                <td style="float: left; width: 250px;">
                    <div style="border: solid 1px #ddd; height: 250px;">
                    <?php if (isset($_smarty_tpl->tpl_vars['user']->value['avatar']) && isset($_smarty_tpl->tpl_vars['user']->value['avatar']['miniature'])) {?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['user']->value['avatar']['miniature'];?>
" alt="avatar" width="250" height="250">
                    <?php } else { ?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['home']->value['link'];?>
/<?php echo $_smarty_tpl->tpl_vars['path']->value['img'];?>
/users.png" alt="avatar" width="250" height="250">
                    <?php }?>
                    </div>
                </td>
                
                <td style="float: left; padding: 0px 0 0 20px;">
                    <div class="field">
                        <span><?php echo $_smarty_tpl->tpl_vars['firstname']->value['title'];?>
</span>
                        <?php echo $_smarty_tpl->tpl_vars['firstname']->value['input'];?>

                        <span class="description"><?php echo $_smarty_tpl->tpl_vars['firstname']->value['description'];?>
</span>
                    </div>

                    <div class="field">
                        <span><?php echo $_smarty_tpl->tpl_vars['lastname']->value['title'];?>
</span>
                        <?php echo $_smarty_tpl->tpl_vars['lastname']->value['input'];?>

                        <span class="description"><?php echo $_smarty_tpl->tpl_vars['lastname']->value['description'];?>
</span>
                    </div>

                    <div class="field">
                        <span><?php echo $_smarty_tpl->tpl_vars['email']->value['title'];?>
</span>
                        <?php echo $_smarty_tpl->tpl_vars['email']->value['input'];?>

                        <span class="description"><?php echo $_smarty_tpl->tpl_vars['email']->value['description'];?>
</span>
                    </div>
                </td>
            </tr>
        </table>
    
        <?php if ($_smarty_tpl->tpl_vars['citation']->value['input']->value() != '') {?>
        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['citation']->value['title'];?>
</span>
            <span class="description"><?php echo $_smarty_tpl->tpl_vars['citation']->value['input']->value();?>
</span>
        </div>
        <?php }?>
    
        <?php if ($_smarty_tpl->tpl_vars['description_']->value['input']->value() != '') {?>
        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['description_']->value['title'];?>
</span>
            <span class="description"><?php echo $_smarty_tpl->tpl_vars['description_']->value['input']->value();?>
</span>
        </div>
        <?php }?>
        
        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['sex']->value['title'];?>
</span>
            <div style="width: 100%; overflow: hidden;">
                <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['male'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['male_title'];?>
</div>
                <div style="float: left; width: 90px;"><?php echo $_smarty_tpl->tpl_vars['sex']->value['female'];?>
 <?php echo $_smarty_tpl->tpl_vars['sex']->value['female_title'];?>
</div>
            </div>
            <div class="description"><?php echo $_smarty_tpl->tpl_vars['sex']->value['description'];?>
</div>
        </div>
    
        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['bdate']->value['title'];?>
</span>
            <?php echo $_smarty_tpl->tpl_vars['bdate']->value['input'];?>

            <span class="description"><?php echo $_smarty_tpl->tpl_vars['bdate']->value['description'];?>
</span>
        </div>

        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['cdate']->value['title'];?>
</span>
            <?php echo $_smarty_tpl->tpl_vars['cdate']->value['input'];?>

            <span class="description"><?php echo $_smarty_tpl->tpl_vars['cdate']->value['description'];?>
</span>
        </div>

        <div class="field">
            <span><?php echo $_smarty_tpl->tpl_vars['phone']->value['title'];?>
</span>
            <?php echo $_smarty_tpl->tpl_vars['phone']->value['input'];?>

            <span class="description"><?php echo $_smarty_tpl->tpl_vars['phone']->value['description'];?>
</span>
        </div>
    
        <div class="field">
            <span>User role</span>
            <div style="overflow: hidden;">
                <div style="float: left; width: 200px;"><?php echo $_smarty_tpl->tpl_vars['administrator']->value['input'];?>
 <?php echo $_smarty_tpl->tpl_vars['administrator']->value['title'];?>
</div>
                <div style="float: left; width: 200px;"><?php echo $_smarty_tpl->tpl_vars['plain']->value['input'];?>
 <?php echo $_smarty_tpl->tpl_vars['plain']->value['title'];?>
</div>
            </div>
            <span class="description"><?php echo $_smarty_tpl->tpl_vars['plain']->value['description'];?>
</span>
        </div>
    
    </form>
</section><?php }
}
