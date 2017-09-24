<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-23 21:35:48
  from "/var/www/html/app/views/responsibilities.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59c6b794bf5265_99557939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4f64892eb86b8685fc2fe3093850ee30f34fd18' => 
    array (
      0 => '/var/www/html/app/views/responsibilities.tpl',
      1 => 1506195346,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:responsibility_card.tpl' => 1,
  ),
),false)) {
function content_59c6b794bf5265_99557939 (Smarty_Internal_Template $_smarty_tpl) {
?>

<style type="text/css">
    #responsibility_name, #responsibility_desc {
        width: 90%;
    }
    
    .title {
        font-family: 'OpenSansLight';
        font-size: 1em;
        font-weight: bold;
        border: none;
    }
    
    .item:hover .title, .item:hover .desc {
        background: #f9f9f9;
    }
    
    .desc {
        font-family: 'OpenSansLight';
        font-size: 13px;
        border: none;
    }
</style>

<form id="add_responsibility" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/addresponsibility">
    <table style="width: 100%; margin: -30px 0 0 0;">
        <tr>
            <td style="width: 300px;">
                <div class="field <?php if ($_smarty_tpl->tpl_vars['name']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['name']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['name']->value['input'];?>

                </div>
            </td>
            
            <td>
                <div class="field <?php if ($_smarty_tpl->tpl_vars['desc']->value['input']->error()) {?>error<?php }?>">
                    <span><?php echo $_smarty_tpl->tpl_vars['desc']->value['title'];?>
</span>
                    <?php echo $_smarty_tpl->tpl_vars['desc']->value['input'];?>

                </div>
            </td>
            
            <td style="width: 100px;">
                <div class="field" style="position: relative; top: 27px;">
                    <?php echo $_smarty_tpl->tpl_vars['add']->value['input'];?>

                </div>
            </td>
        </tr>
    </table>
</form>

<?php if (!empty($_smarty_tpl->tpl_vars['responsibilities']->value)) {?>
Responsibilities list:
<section class="item_list">
    <form id="responsibility_list" method="post" action="<?php echo $_smarty_tpl->tpl_vars['panel']->value['link'];?>
/responsibilities/<?php echo $_smarty_tpl->tpl_vars['page_number']->value;?>
">

        <div class="list level0">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['responsibilities']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
            <?php $_smarty_tpl->_subTemplateRender("file:responsibility_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </div>
        
    </form>
</section>
<?php }
}
}
