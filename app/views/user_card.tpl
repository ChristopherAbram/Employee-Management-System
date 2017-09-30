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






{*
{assign var="invalid" value=!empty($data.to_date) and ($data.to_date <= $date)}
{assign var="waiting" value=!empty($data.from_date) and ($data.from_date > $date)}
<div class="item" style="{if $invalid}color: #666; background: #f4f4f4;{/if} position: relative;">
    <div class="left" style="width: {if $current_user.role.access_level eq 0}50px{else}10px{/if};">
        {if $current_user.role.access_level eq 0}
        <input class="check" type="checkbox" name="agreement[{$data.id}]" value="1" style="margin: 5px 0 0 10px;" />
        {/if}
    </div>
    <div class="center" style="text-align: left;">
        
        {if $current_user.role.access_level neq 0}
        <div class="right" style="padding: 0 10px 0 0; width: 200px; position: absolute; bottom: 0; right: 0; color: {if $invalid}#666;{else}#0060ff;{/if} font-size: 25px; text-align: right;">
            {$data.salary} EUR
        </div>
        {/if}
        
        <span class="item_title">
            {if $invalid}<span style="color: red;">[TERMINATED]</span> {/if}
            {if !$invalid and $waiting}<span style="color: #0060ff;">[WAITING]</span> {/if}
            {$data.responsibility.name|truncate:128}</span>
        
        <div class="info">
            
            <div class="user">
                {if $current_user.role.access_level eq 0}
                <a href="{$panel.link}/departmenteditor/{$data.department.namepath}">{$data.department.name}</a>
                {else}
                {assign var='google_link' value="{$data.department.city}, {$data.department.street}, {$data.department.house}"}
                <a href="https://www.google.com/maps/search/?api=1&query={$google_link|urlencode}" target="_blank">{$data.department.name}</a>
                {/if}
                <br>
                <span>{$data.working_time.name} job</span><br>
                <span>{$data.from_date|date_format:"%B %e, %Y"} {if !empty($data.to_date)}until {$data.to_date|date_format:"%B %e, %Y"}{/if}</span>
            </div>
            
        </div>
        <div class="description" style="font-style: italic; color: #666;">
            {$data.description|truncate:250}
        </div>
    </div>
    {if $current_user.role.access_level eq 0}
    <div class="right" style="padding: 0 10px 0 0; width: 200px;color: {if $invalid}#666;{else}#0060ff;{/if} font-size: 25px; text-align: right;">
        {$data.salary} EUR
    </div>
    {/if}
</div>*}