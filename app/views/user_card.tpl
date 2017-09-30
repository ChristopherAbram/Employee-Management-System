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
    <div class="center" style="width: 70%; max-width: 400px;">
        <a href="{$panel.link}/member/{$data.id}">{$data.firstname} {$data.lastname}</a>
        <div class="info">
            <div class="user">
                {$data.role.name} {if $data.phone neq ''}, {$data.phone}{/if}
                <br><b>{$data.email}</b>
                <div style="margin: 5px 0 5px 0;">
                {if $data.employeed eq 1 and !empty($data.departments)}
                    <div>
                    {foreach from=$data.departments item=depart}
                        <span style="border-radius: 5px; border: solid 1px #ccc; color: #0060ff; padding: 2px 4px; font-size: 11px;">{$depart.name}</span>
                    {/foreach}
                    </div>
                    {if !empty($data.responsibilities)}
                        <div style="margin-top: 5px;">
                       {foreach from=$data.responsibilities item=res}
                           <span style="border-radius: 5px; border: solid 1px #ccc; color: #888; padding: 0px 4px; font-size: 10px;">{$res.name}</span>
                       {/foreach}
                        </div>
                    {/if}
                    
                {else}
                    <span style="color: #f00; font-size: 13px;">Not employed</span>
                {/if}
                </div>
            </div>
        </div>
    </div>
    <div class="right" style="margin: 0; width: 200px;">
        <div class="" style="font-size: 10px; margin: 5px 0 0 0;">Registered: {$data.cdate|date_format:"%B %e, %Y"}</div>

        {if $data.employeed eq 1 and !empty($data.money)}
        <div class="money" style="margin: 20px 0 0 0;">
            <div><span style="font-size: 11px;">Job:</span>&nbsp;<span style="color: #0060ff; font-weight: bold;">{$data.money.job}</span>&nbsp;<span style="font-size: 10px;">EUR</span></div>
            <div><span style="font-size: 11px;">Contracts:</span>&nbsp;<span style="color: #0060ff">{$data.money.contract}</span>&nbsp;<span style="font-size: 10px;">EUR</span></div>
        </div>
        {/if}
    </div>
</div>