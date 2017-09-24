<section class="comment">
    <div class="logo">
        {if isset($user.avatar.miniature) && !empty($user.avatar.miniature)}
        <img src="{$user.avatar.miniature}" alt="avatar">
        {else}
        <img src="{$path.avatar}" alt="avatar">
        {/if}
    </div>
    <div class="info">
        <span>
            <span class="author">{if isset($user.role.name)}{$user.role.name}:{/if} {if isset($user.profile) and $user.profile == 1}<a href="{$home.link}/member/{$user.id}">{else}<b>{/if}{$user.firstname} {$user.lastname}{if isset($user.profile) and $user.profile == 1}</a>{else}</b>{/if}</span><br>
            <span class="cdate">on {$time|date_format:"%d %b %Y at %H:%M"}</span>
        </span>
    </div>
    <div class="content">
        <div class="p">{$content}</div>
    </div>
</section>