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
                {$data.department.name}
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
</div>