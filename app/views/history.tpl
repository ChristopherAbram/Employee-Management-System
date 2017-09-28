
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

{if !empty($results)}
<table style="width: 100%; margin: 20px 0 0 0;">
    <tr>
        <th>Month</th>
        <th>Month salary</th>
        <th>Contract salary</th>
        <th>Job</th>
        <th>Contracts</th>
        <th>Total</th>
    </tr>
    
    {foreach from=$results item=data}
    <tr>
        <td>{$data.month}</td>
        <td>{$data.month_salary}</td>
        <td>0.00</td>
        <td>{$data.total_job}</td>
        <td>{$data.total_contract}</td>
        <td>{$data.total}</td>
    </tr>
    {/foreach}
</table>
{else}
No results
{/if}