<div class="account">
    {if !$user_identified}
    <a class="button" href="{$home.link}/registration">Join</a>
    <span class="button" id="login_button">Sign in</span>
    {else}
    <a class="button" href="{$home.link}/panel">Your account</a>
    <a class="button" href="{$home.link}/logout?url={$path.current|urlencode}">Log out</a>
    {/if}
</div>