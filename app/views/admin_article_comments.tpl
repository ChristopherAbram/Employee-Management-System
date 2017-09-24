{if !empty($articles)}
<section class="item_list">
    
    <div class="list level0">
        {foreach from=$articles item=data}
        <div class="item">
            <div class="left"></div>
            <div class="center">
                <a href="{$panel.link}/comments/{$data.namepath}">{$data.title}</a>
            </div>
            <div class="right" style="width: 50px;">
                <span class="item_count">{$data.comments_count}</span>
            </div>
        </div>
        {/foreach}
    </div>
    
</section>
{else}
<div class="no_results">No results</div> 
{/if}