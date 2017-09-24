<form id="userdata" method="post" action="{$panel.link}/userdata">
    
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
    
    <div class="field">
        <span>{$sex.title}</span>
        <div style="width: 100%; overflow: hidden;">
            <div style="float: left; width: 90px;">{$sex.male} {$sex.male_title}</div>
            <div style="float: left; width: 90px;">{$sex.female} {$sex.female_title}</div>
        </div>
        <div class="description">{$sex.description}</div>
    </div>
    
    <div class="field {if $bdate.input->error()}error{/if}" style="width: 100%;">
        <span>{$bdate.title}</span>
        {$bdate.input}
        <span class="description">{$bdate.description}</span>
    </div>
    
    <div class="field">
    {if isset($toolbar_left[0])}
        {$toolbar_left[0]}
    {/if}
    </div>
    
</form>
