{if !empty($files)}
<section class="item_list">
    <form id="file_list" method="post" action="{$panel.link}/files/{$page_number}">

        <div class="list level0">
            {foreach from=$files item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="file[{$data.id}]" value="1" />
                    <div class="functions">
                    <input class="{if $data.hide eq 1}hide_button_active{else}hide_button{/if}" title="hide" type="submit" name="{if $data.hide eq 1}unhide{else}hide{/if}[{$data.id}]" value="" />
                    <input class="{if $data.locked eq 1}lock_button_active{else}lock_button{/if}" title="lock" type="submit" name="{if $data.locked eq 1}unlock{else}lock{/if}[{$data.id}]" value="" />
                    </div>
                    <figure class="image">
                        <img src="{if isset($data.miniature)}{$data.miniature}{else}{$home.link}/connector/miniature/{$data.id}{/if}" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    <input class="filename" type="text" value="{$data.name}" name="name[{$data.id}]">
                    <div class="info">
                        <div class="user">
                            Owner: {$data.user.role.name} {$data.user.firstname} {$data.user.lastname}<br> 
                            Size: {$data.size|filesize}<br>
                            File: <a href="{$home.link}/connector/get/{$data.id}">{$home.link}/connector/get/{$data.id}</a><br>
                            Miniture: <a href="{$data.miniature}">{$data.miniature}</a>
                        </div>
                        <div class="edate">Uploaded: {$data.cdate|date_format:"%B %e, %Y %I:%M %p"}</div>
                    </div>
                    <div class="description">
                        {*$data.description|truncate:250*}
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}