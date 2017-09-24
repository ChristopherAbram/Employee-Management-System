<div class="item">
    <div class="center" style="text-align: left;">
        <div class="logo">
            {if isset($data.user.avatar.miniature) && !empty($data.user.avatar.miniature)}
            <img src="{$data.user.avatar.miniature}" alt="avatar" width="50" height="50">
            {else}
            <img src="{$path.avatar}" width="50" height="50" alt="image" />
            {/if}
        </div>
        <div class="info">
            {if isset($data.article)}<i>commented</i> <span class="keys"><a href="{$home.link}/article/{$data.article.namepath}" target="_blank">{$data.article.title}</a></span>{/if}<br> 
            <span class="date">on {$data.cdate|date_format:"%d %b %Y at %H:%M"}</span>
        </div>
        <div class="content">
            <p>{$data.content}</p>
        </div>
    </div>
</div>