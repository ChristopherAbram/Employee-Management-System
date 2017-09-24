<div class="item">
    <div class="left">
        <input class="check" type="checkbox" name="article[{$data.id}]" value="1" />
        <div class="functions">
        <input class="{if $data.hide eq 1}hide_button_active{else}hide_button{/if}" title="hide" type="submit" name="{if $data.hide eq 1}unhide{else}hide{/if}[{$data.id}]" value="" />
        <input class="{if $data.mark eq 1}mark_button_active{else}mark_button{/if}" title="mark" type="submit" name="{if $data.mark eq 1}unmark{else}mark{/if}[{$data.id}]" value="" />
        </div>
        <figure class="image">
            {if isset($data.picture.miniature) and !empty($data.picture.miniature)}
            <img src="{$data.picture.miniature}" width="150" height="150" alt="image" />
            {else}
            <img src="{$home.link}/{$path.img}/article_default_square.jpg" width="150" height="150" alt="image" />
            {/if}
        </figure>
    </div>
    <div class="center">
        <span class="item_title">{$data.title|truncate:128}</span>
        <a class="preview_button" title="Preview" href="{$home.link}/article/{$data.namepath}" target="_blank"></a>
        <a class="edit_button" href="{$panel.link}/articleeditor/{$data.namepath}">edit</a>
        <div class="info">
            {if !empty($data.parents)}
            <div class="keys">
                {foreach from=$data.parents item=$page}
                <a href="{$home.link}/page/{$page.namepath}" target="_blank">{$page.title}</a>
                {/foreach}
            </div>
            {/if}
            <div class="user">
                {if !empty($data.user) and isset($current_user.role.access_level) and ($current_user.role.access_level eq 0)}
                    by: <a href="{$panel.link}/member/{$data.user.id}">{$data.user.firstname} {$data.user.lastname}</a>
                {/if} 
                {if !empty($data.cdate)}
                    on {$data.cdate|date_format:"%d %b %Y at %H:%M"}
                {/if}
            </div>
            <div class="edate">{if !empty($data.edate)}modified: {$data.edate|date_format:"%d %b %Y at %H:%M"}{/if}</div>
        </div>
        <div class="description">
            {$data.description|truncate:250}
        </div>
    </div>
    <div class="right">
        <span class="item_info" title="See statistics"></span>
        <input class="ord_input" type="number" name="ord[{$data.id}]" value="{$data.ord}" />
    </div>
</div>