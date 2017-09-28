<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-28 16:10:30
  from "/var/www/html/app/views/report.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cd02d6f41105_23931880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32a3851f141c73c52323845bfa8f5523435dada9' => 
    array (
      0 => '/var/www/html/app/views/report.tpl',
      1 => 1506607828,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cd02d6f41105_23931880 (Smarty_Internal_Template $_smarty_tpl) {
?>
<span style="font-size: 2em;"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</span>

<div style="margin-top: 20px;">
    <span style="font-size: 1.5em;">Money spent in total: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span> EUR</span>
    <div style="margin-left: 50px;">
        <span>Job: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total_job']->value;?>
</span> EUR</span><br>
        <span>Contracts: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total_contract']->value;?>
</span> EUR</span>
    </div>
</div>

<div style="margin: 20px 0 0 0;">
    <span>Sum of month salary: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['month_salary']->value;?>
</span> EUR</span><br>
    <span>Sum of contract salary: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['contract_salary']->value;?>
</span> EUR</span>
</div><?php }
}
