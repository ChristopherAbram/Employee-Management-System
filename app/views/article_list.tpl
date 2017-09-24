<article>
    <section class="title">{$title}</section>
    <section class="content">
        <section class="list">
            {foreach from=$list item=article}
            {include file="article_card.tpl"}
            {/foreach}
        </section>
        
        <section class="switch center">
            {$result_switcher}
        </section>
        
    </section>
    
</article>
