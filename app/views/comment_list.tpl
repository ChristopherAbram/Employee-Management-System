{foreach from=$comments item=comment}
<section class="comment">
    <div class="logo">
        {if isset($comment.user.avatar.miniature) && !empty($comment.user.avatar.miniature)}
        <img src="{$comment.user.avatar.miniature}" alt="avatar">
        {else}
        <img src="{$path.avatar}" alt="avatar">
        {/if}
    </div>
    <div class="info">
        <span>
            <span class="author">{if isset($comment.user.role.name)}{$comment.user.role.name}:{/if} {if isset($comment.user.profile) and $comment.user.profile == 1}<a href="{$home.link}/member/{$comment.user.id}">{else}<b>{/if}{$comment.user.firstname} {$comment.user.lastname}{if isset($comment.user.profile) and $comment.user.profile == 1}</a>{else}</b>{/if}</span><br>
            <span class="cdate">on {$comment.cdate|date_format:"%d %b %Y at %H:%M"}</span>
        </span>
    </div>
    <div class="content">
        <div class="p">{$comment.content}</div>
    </div>
</section>
{/foreach}