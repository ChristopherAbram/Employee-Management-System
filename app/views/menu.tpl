<ul>
    {foreach from=$menu key=name item=option}
    <li {if $option.menu|@count neq 0}class="roll"{/if}>
        <a href="{$option.href}" {if $option.active}class="active"{/if}>{$option.name}</a>
        {if $option.menu|@count neq 0}
        <ul>
            {foreach from=$option.menu key=name item=option}
            <li><a href="{$option.href}" {if $option.active}class="active"{/if}>{$option.name}</a></li>
            {/foreach}
        </ul>
        {/if}
    </li>
    {/foreach}
</ul>