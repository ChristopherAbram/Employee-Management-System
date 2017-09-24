{if !empty($comments)}
    
<div class="field" style="width: 100%; overflow: hidden;">
{if isset($toolbar_right[0])}
    {$toolbar_right[0]}
{/if}
</div>

<section class="item_list">
    <form id="comment_list" method="post" action="{$panel.link}/yourcomments/{$page_number}">

        <div class="list level0">
            {foreach from=$comments item=data}
            {include file="user_comment_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>

<div class="field" style="width: 100%; overflow: hidden;">
{if isset($toolbar_right[0])}
    {$toolbar_right[0]}
{/if}
</div>
            
{else}
<div class="no_results">No results</div> 
{/if}