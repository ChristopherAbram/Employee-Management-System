<article>
    <section class="title">{$page.title}</section>
    <section class="info">
        <span class="left">
            {if isset($page.user.avatar.miniature) and !empty($page.user.avatar.miniature)}
            <img id="author_avatar" src="{$page.user.avatar.miniature}">
            <span style="display: block; float: left; margin: 3px 0 0 0;">
                by {if isset($page.user.role.name)}{$page.user.role.name}:{/if} {if isset($page.user.profile) and $page.user.profile == 1}<a href="{$home.link}/member/{$page.user.id}">{else}<b>{/if}{$page.user.firstname} {$page.user.lastname}{if isset($page.user.profile) and $page.user.profile == 1}</a>{else}</b>{/if}<br>
                on {$page.cdate|date_format:"%B %e, %Y"}
            </span>
            {else}
            by {if isset($page.user.role.name)}{$page.user.role.name}:{/if} {if isset($page.user.profile) and $page.user.profile == 1}<a href="{$home.link}/member/{$page.user.id}">{else}<b>{/if}{$page.user.firstname} {$page.user.lastname}{if isset($page.user.profile) and $page.user.profile == 1}</a>{else}</b>{/if}<br>
            on {$page.cdate|date_format:"%B %e, %Y"}
            {/if}
        </span>
        <span class="right" id="modification_date">{$last_modified}: {$page.edate|date_format:"%B %e, %Y"}</span>
    </section>
    <section class="keywords">
        <span class="right" id="keywords_right">
            <span style="display: block; float: right; margin-top: -2px;">
                <span id="visit_count" title="{$visits}">
                    <span class="ico"></span>
                    <span class="count">{$page.visits}</span>
                </span>
                <span id="articles_count" title="articles">
                    <span class="ico"></span>
                    <span class="count">{$page.articles}</span>
                </span>
            </span>
        </span>
    </section>
    <br>
    <section class="content">
        {if !empty($page.description)}
        <section class="article-description" style="margin-bottom: 40px; margin-top: 20px;">
            {$page.description}
        </section>
        {/if}
        {$page.body}
        
        {if !empty($list)}
        <section class="list">
            <section class="title">Articles</section>
            <div class="list-container">
            {foreach from=$list item=article}
            {include file="article_card.tpl"}
            {/foreach}
            </div>
        </section>
        
        <section class="switch center">
            {$result_switcher}
        </section>
        {/if}
    </section>
    
</article>
