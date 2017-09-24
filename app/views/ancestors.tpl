<nav class="position">
    <ul>
        <li><a href="{$home.link}" title="{$home.title}">{$home.title}</a></li>
        {foreach from=$ancestors key=ancestor_label item=ancestor_link}
        <li><a href="{$ancestor_link}" title="{$ancestor_label}">{$ancestor_label}</a></li>
        {/foreach}
    </ul>
</nav>