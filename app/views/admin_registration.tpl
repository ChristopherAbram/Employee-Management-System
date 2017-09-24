
<section class="form" style="margin: -30px 0 40px 0;">
    <form id="cancel" method="post" action=""></form>
    <form id="registration" method="post" action="{$panel.link}/registration">
    
    <div class="field {if $firstname.input->error()}error{/if}">
        <span>{$firstname.title}</span>
        {$firstname.input}
    </div>
    
    <div class="field {if $lastname.input->error()}error{/if}">
        <span>{$lastname.title}</span>
        {$lastname.input}
    </div>
    
    <div class="field {if $email.input->error()}error{/if}">
        <span>{$email.title}</span>
        {$email.input}
    </div>
    
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
    
    {if !$password_med->correct()}
        <div class="field error">
            <span class="message">Incorrect passwords. Must be the same.</span>
        </div>
    {/if}
    
    <div class="field">
        <span>{$sex.title}</span>
        <span class="description">{$sex.description}</span>
        <div style="float: left; width: 150px;">{$sex.male} {$sex.male_title}</div>
        <div style="float: left; width: 150px;">{$sex.female} {$sex.female_title}</div>
    </div>
    
    <div class="field {if $bdate.input->error()}error{/if}" style="width: 100%; margin: 30px 0 0 0;">
        <span>{$bdate.title}</span>
        {$bdate.input}
        <span class="description">{$bdate.description}</span>
    </div>
    
    
    <div class="field {if $captcha.input->error()}error{/if}">
        <span>{$captcha.title}</span>
        <span class="description">{$captcha.description}</span>
        {$captcha.input}
    </div>
    
    </form>
    
</section>