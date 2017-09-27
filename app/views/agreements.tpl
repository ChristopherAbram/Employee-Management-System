{if !empty($agreements)}
<section class="item_list">
    <form id="agreement" method="post" action="{$panel.link}/agreements/{$page_number}">

        <div class="list level0">
            {foreach from=$agreements item=data}
            {include file="agreement_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}