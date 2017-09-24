<form id="changepassword" method="post" action="{$panel.link}/changepassword">
    
    <div class="field {if $password.input->error()}error{/if}">
        <span>{$password.title}</span>
        {$password.input}
        <span class="description">{$password.description}</span>
    </div>
    
    <div class="field {if $confirm_password.input->error()}error{/if}">
        <span>{$confirm_password.title}</span>
        {$confirm_password.input}
        <span class="description">{$confirm_password.description}</span>
    </div>
    
    <div class="field {if $old_password.input->error()}error{/if}">
        <span>{$old_password.title}</span>
        {$old_password.input}
        <span class="description">{$old_password.description}</span>
    </div>
    
    {if !$password_med->correct()}
        <div class="field error">
            <span class="message">Error, passwords must be the same. Old password must match to your current password.</span>
        </div>
    {/if}
    
    <div class="field">
    {if isset($toolbar_left[0])}
        {$toolbar_left[0]}
    {/if}
    </div>
    
</form>
