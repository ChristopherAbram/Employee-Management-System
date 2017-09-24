{if !empty($toolbar_left) or !empty($toolbar_right)}
<section id="toolbar">
    {if !empty($toolbar_left)}
    <div id="left">
        {foreach from=$toolbar_left item=button}
            {$button}
        {/foreach}
    </div>
    {/if}

    {if !empty($toolbar_right)}
    <div id="right">
        {foreach from=$toolbar_right item=button}
            {$button}
        {/foreach}
    </div>
    {/if}
</section>
{/if}