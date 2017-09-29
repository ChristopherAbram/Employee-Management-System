
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
    
    th {
        background: #1e1e1e;
        color: #ddd;
        padding: 10px 0;
    }
    
    .gray {
        background: #f9f9f9;
    }
    
    .dark {
        border-bottom: solid 1px #bbb;
        background: #ddd;
        color: #0060ff;
        font-weight: bold;
        
    }
</style>

<div style="font-size: 2em;">History</div>

{if !empty($results)}
<table style="width: 100%; margin: 20px 0 0 0;" cellspacing="0" cellpading="0">
    <tr>
        <th>Month</th>
        <th>Month salary</th>
        <th>Contract salary</th>
        <th>Job</th>
        <th>Contracts</th>
        <th>Total [EUR]</th>
    </tr>
    
    {foreach from=$results item=data}
    <tr>
        <td style="width: 70px; background: #ddd; font-style: italic; color: #444;">{$data.month}</td>
        <td style="width: 150px;">{$data.month_salary}</td>
        <td style="width: 150px;">0.00</td>
        <td class="gray">{$data.total_job}</td>
        <td class="gray">{$data.total_contract}</td>
        <td class="dark">{$data.total}</td>
    </tr>
    {/foreach}
</table>
{else}
No results
{/if}