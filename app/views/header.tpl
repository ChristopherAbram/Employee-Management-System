<div id="headbar">
    <div id="logo">Solteq Assignment</div>
    <nav id="menu">
        {if $user_identified}
            <a href="{$home.link}/panel" rel="stylesheet">Panel</a>
        {else}
        {foreach from=$front_menu key=link item=name}
            <a href="{$home.link}/{$link}" rel="stylesheet">{$name}</a>
        {/foreach}
        {/if}
    </nav>
</div>