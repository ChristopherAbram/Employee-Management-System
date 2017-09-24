{if !empty($departments)}
<section class="item_list">
    <form id="department_list" method="post" action="{$panel.link}/departments/{$page_number}">

        <div class="list level0">
            {foreach from=$departments item=data}
            {include file="department_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}