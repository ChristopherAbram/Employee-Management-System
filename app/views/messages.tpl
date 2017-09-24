{if $error|@count gt 0}
<aside class="board center">
    <div class="message error">
        {foreach from=$error item=message}
        <span>{$message}</span><br>
        {/foreach}
    </div>
</aside>
{/if}

{if $warning|@count gt 0}
<aside class="board center">
    <div class="message warning">
        {foreach from=$warning item=message}
        <span>{$message}</span><br>
        {/foreach}
    </div>
</aside>
{/if}

{if $correct|@count gt 0}
<aside class="board center">
    <div class="message correct">
        {foreach from=$correct item=message}
        <span>{$message}</span><br>
        {/foreach}
    </div>
</aside>
{/if}