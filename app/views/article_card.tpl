<section class="item">
    <figure class="photo">
        {if isset($article.picture, $article.picture.miniature) and !empty($article.picture.miniature)}
        <img src="{$article.picture.miniature}" alt="picture">
        {else}
        <img src="{$home.link}/{$path.img}/article_default.jpg" alt="picture">
        {/if}
    </figure>
    <div class="content">
        <section class="title"><a href="{if !empty($article.link)}{$article.link}{else}{$home.link}/article/{$article.namepath}{/if}">{$article.title|truncate:50}</a></section>
        <section class="description">
            {$article.description|truncate:150}
        </section>
        <footer>
            <div class="author left">
                <div class="logo left">
                    {if isset($article.user.avatar.miniature) && !empty($article.user.avatar.miniature)}
                    <img src="{$article.user.avatar.miniature}" alt="avatar" width="50" height="50">
                    {else}
                    <img src="{$path.avatar}" alt="avatar" width="50" height="50">
                    {/if}
                </div>
                <div class="info left">
                    {if !empty($article.user.firstname) and !empty($article.user.lastname)}
                    <span>{if isset($article.user.role.name)}{$article.user.role.name}:{/if} {if isset($article.user.profile) and $article.user.profile == 1}<a href="{$home.link}/member/{$article.user.id}">{else}<b>{/if}{$article.user.firstname} {$article.user.lastname}{if isset($article.user.profile) and $article.user.profile == 1}</a>{else}</b>{/if}<br>
                        {if !empty($article.cdate)}{$article.cdate|date_format:"%d %b %Y"}{/if}</span>
                    {/if}
                </div>
            </div>
            <div class="more right">
                <a href="{if !empty($article.link)}{$article.link}{else}{$home.link}/article/{$article.namepath}{/if}">Read more...</a>
            </div>
        </footer>
    </div>
</section>