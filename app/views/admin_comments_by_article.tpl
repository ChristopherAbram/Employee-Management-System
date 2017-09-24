{if !empty($comments)}
<section class="category_label">
    {$article.title}
</section>
<section class="item_list">
    <form id="comment_list" method="post" action="{$panel.link}/comments/{$category}/{$page_number}">

        <div class="list level0">
            {foreach from=$comments item=data}
            {include file="admin_comment_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}