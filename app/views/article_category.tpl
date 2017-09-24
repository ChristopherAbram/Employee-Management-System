<section class="title">{$title}</section>
<section class="content">
    {$description}
</section>

<section class="form">
    
    <form id="articlecategory" method="post" action="{$panel.link}/articlecategory">
        <div class="list level0">
            {foreach from=$pages item=$page}
            <div class="item">
                <div class="left"><input type="checkbox" name="page[]" value="{$page.id}" {if $page.checked}checked="checked"{/if}/></div>
                <div class="center">{$page.title}</div>
                <div class="right"></div>
            </div>
            {/foreach}
        </div>
    </form>
    
</section>