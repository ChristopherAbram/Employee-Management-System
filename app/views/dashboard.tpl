<span style="font-size: 2em; margin-top: 10px;">Welcome <b>{$current_user.firstname} {$current_user.lastname}</b></span>
<br><br>

{if isset($current_user.role.access_level) and $current_user.role.access_level == 2}
<span class="info">Your account allows you to load avatar image, change profile data, read your recently added comments.</span>
{/if}