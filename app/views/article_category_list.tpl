{if !empty($articles)}
<section class="category_label">
    {$page.title}
</section>
<section class="item_list">
    <form id="article_list" method="post" action="{$panel.link}/article/{$category}/{$page_number}">

        <div class="list level0">
            {foreach from=$articles item=data}
            {include file="admin_article_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}