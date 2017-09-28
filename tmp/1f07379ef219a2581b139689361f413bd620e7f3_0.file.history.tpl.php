<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-28 19:35:37
  from "/var/www/html/app/views/history.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cd32e96212f5_70313528',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f07379ef219a2581b139689361f413bd620e7f3' => 
    array (
      0 => '/var/www/html/app/views/history.tpl',
      1 => 1506620133,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cd32e96212f5_70313528 (Smarty_Internal_Template $_smarty_tpl) {
?>

<style>
    th, td {
        border-right: solid 1px #000;
        border-bottom: solid 1px #ddd;
        margin: 0;
    }
    td {
        text-align: right;
        padding: 3px 5px;
        
    }
</style>

<div style="font-size: 2em;">History</div>

<?php if (!empty($_smarty_tpl->tpl_vars['results']->value)) {?>
<table style="width: 100%; margin: 20px 0 0 0;">
    <tr>
        <th>Month</th>
        <th>Month salary</th>
        <th>Contract salary</th>
        <th>Job</th>
        <th>Contracts</th>
        <th>Total</th>
    </tr>
    
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['month'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['month_salary'];?>
</td>
        <td>0.00</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['total_job'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['total_contract'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['data']->value['total'];?>
</td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>
<?php } else { ?>
No results
<?php }
}
}
