<?php
/* Smarty version 3.1.31-dev/4, created on 2017-09-27 18:38:29
  from "/var/www/html/app/views/money.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31-dev/4',
  'unifunc' => 'content_59cbd405d6d075_15051355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16f9669d9caca6ce53a4a8ac9edc3c161b032553' => 
    array (
      0 => '/var/www/html/app/views/money.tpl',
      1 => 1506530306,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59cbd405d6d075_15051355 (Smarty_Internal_Template $_smarty_tpl) {
?>

<span style="font-size: 2em;"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</span>

<div class="description" style="margin: 20px 0 0 0; color: #666; font-style: italic;">
    Below data informs you about total balance that you have earned in our company since you had been employed.<br>
    You may also distinguish regular job money from contract's money.
</div> 

<div style="margin-top: 20px;">
    <span style="font-size: 1.5em;">Money earned in total: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total']->value;?>
</span> EUR</span>
    <div style="margin-left: 50px;">
        <span>Job: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total_job']->value;?>
</span> EUR</span><br>
        <span>Contracts: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['total_contract']->value;?>
</span> EUR</span>
    </div>
</div>
    
<div class="description" style="margin: 20px 0 0 0; color: #666; font-style: italic;">
    Month salary is the sum of all your salaries coming from active agreement per month (actual status).<br>
    However the contract salary tells you the sum of all your active (not terminated yet) contracts, like casual, freelance, contract work.
</div> 
   
<div style="margin: 20px 0 0 0;">
    <span>Month salary: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['month_salary']->value;?>
</span> EUR</span><br>
    <span>Contract salary: <span style="color: #0060ff;"><?php echo $_smarty_tpl->tpl_vars['contract_salary']->value;?>
</span> EUR</span>
</div><?php }
}
