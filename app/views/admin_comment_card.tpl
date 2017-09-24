<div class="item">
    <div class="left">
        <input class="check" type="checkbox" name="comment[{$data.id}]" value="1" />
        <div class="functions">
        <input class="{if $data.hide eq 1}hide_button_active{else}hide_button{/if}" title="hide" type="submit" name="{if $data.hide eq 1}unhide{else}hide{/if}[{$data.id}]" value="" />
        </div>
    </div>
    <div class="center">
        <div class="logo">
            {if isset($data.user.avatar.miniature) && !empty($data.user.avatar.miniature)}
                <img src="{$data.user.avatar.miniature}" alt="avatar" width="50" height="50">
            {else}
            <img src="{$home.link}/{$path.img}/image_default.png" width="50" height="50" alt="image" />
            {/if}
        </div>
        <div class="info">
            <span class="user">{$data.user.role.name}: <b>{if $current_user.role.access_level==0}<a href="{$panel.link}/member/{$data.user.id}">{$data.user.firstname} {$data.user.lastname}</a>{else}{$data.user.firstname} {$data.user.lastname}{/if}</b></span>
            {if isset($data.article)}<i>commented</i> <span class="keys"><a href="{$home.link}/article/{$data.article.namepath}" target="_blank">{$data.article.title}</a></span>{/if}<br> 
            <span class="date">on {$data.cdate|date_format:"%d %b %Y at %H:%M"}</span>
            
        </div>
        <div class="content">
            <p>{$data.content}</p>
        </div>
    </div>
</div>