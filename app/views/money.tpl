
<span style="font-size: 2em;">{$title}</span>

<div class="description" style="margin: 20px 0 0 0; color: #666; font-style: italic;">
    Below data informs you about total balance that you have earned in our company since you had been employed.<br>
    You may also distinguish regular job money from contract's money.
</div> 

<div style="margin-top: 20px;">
    <span style="font-size: 1.5em;">Money earned in total: <span style="color: #0060ff;">{$total}</span> EUR</span>
    <div style="margin-left: 50px;">
        <span>Job: <span style="color: #0060ff;">{$total_job}</span> EUR</span><br>
        <span>Contracts: <span style="color: #0060ff;">{$total_contract}</span> EUR</span>
    </div>
</div>
    
<div class="description" style="margin: 20px 0 0 0; color: #666; font-style: italic;">
    Month salary is the sum of all your salaries coming from active agreement per month (actual status).<br>
    However the contract salary tells you the sum of all your active (not terminated yet) contracts, like casual, freelance, contract work.
</div> 
   
<div style="margin: 20px 0 0 0;">
    <span>Month salary: <span style="color: #0060ff;">{$month_salary}</span> EUR</span><br>
    <span>Contract salary: <span style="color: #0060ff;">{$contract_salary}</span> EUR</span>
</div>