<div class="index">
    <div class="content">
        <figure class="logo section"></figure>

        <div class="menu">
            <ul>
                {foreach from=$menu key=name item=option}
                <li><a href="{$option.href}" {if $option.active}class="active"{/if}>{$option.name}</a></li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>