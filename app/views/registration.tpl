<article>
<section class="title">{$title}</section>
<section class="content">
    {$description}
</section>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="registration" method="post" action="{$home.link}/registration">
    
    <div class="field {if $firstname.input->error()}error{/if}">
        <span>{$firstname.title}</span>
        {$firstname.input}
        <span class="description">{$firstname.description}</span>
    </div>
    
    <div class="field {if $lastname.input->error()}error{/if}">
        <span>{$lastname.title}</span>
        {$lastname.input}
        <span class="description">{$lastname.description}</span>
    </div>
    
    <div class="field {if $email.input->error()}error{/if}">
        <span>{$email.title}</span>
        {$email.input}
        <span class="description">{$email.description}</span>
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
        <div style="width: 100%; overflow: hidden;">
        <div style="float: left; width: 90px;">{$sex.male} {$sex.male_title}</div>
        <div style="float: left; width: 90px;">{$sex.female} {$sex.female_title}</div>
        </div>
        <span class="description">{$sex.description}</span>
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
    
    <div class="field" style="overflow: hidden">
        <div style="float: right;">
        {$submit}
        </div>
        
        <div style="float: right; margin: 0 10px;">
        {$cancel}
        </div>
    </div>
    
    </form>
    
</section>
</article>