{if !empty($members)}
<section class="item_list">
    <form id="user_list" method="post" action="{$panel.link}/members/{$page_number}">

        <div class="list level0">
            {foreach from=$members item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="user[{$data.id}]" value="1" />
                    <div class="functions">
                    <input class="{if $data.isactive eq 0}lock_button_active{else}lock_button{/if}" title="isactive" type="submit" name="{if $data.isactive eq 0}activate{else}deactivate{/if}[{$data.id}]" value="" />
                    </div>
                    <figure class="image">
                        <img src="{if isset($data.avatar) and isset($data.avatar.miniature)}{$data.avatar.miniature}{else}{$home.link}/{$path.img}/users.png{/if}" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    <a href="{$panel.link}/member/{$data.id}">{$data.firstname} {$data.lastname}</a>
                    <div class="info">
                        <div class="user">
                            e-mail: {$data.email}<br>
                            role: {$data.role.name}
                        </div>
                        <div class="edate">Registered: {$data.cdate|date_format:"%B %e, %Y"}</div>
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