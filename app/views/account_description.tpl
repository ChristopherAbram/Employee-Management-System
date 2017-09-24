<form id="ext" method="post" action="{$panel.link}/userdescription">
    
    <style type="text/css">
        #description_area textarea#desc_input {
            width: 95%;
            min-width: 240px;
            height: 250px;
        }
        
        #citation input {
            width: 95%;
        }
        
        @media screen and (max-width: 700px) {
            #description_area textarea#desc_input {
                width: 230px;
                min-width: 230px;
                height: 250px;
            }
            
            #citation input {
                width: 230px;
            }
        }
        
    </style>
    
    <div id="description_area" class="field {if $desc.input->error()}error{/if}">
        <span>{$desc.title}</span>
        {$desc.input}
        <span class="description"><span class="optional">(optional)</span>{$desc.description}</span>
    </div>
    
    <div id="citation" class="field {if $citation.input->error()}error{/if}">
        <span>{$citation.title}</span>
        {$citation.input}
        <span class="description"><span class="optional">(optional)</span>{$citation.description}</span>
    </div>
    
    <div class="field {if $phone.input->error()}error{/if}">
        <span>{$phone.title}</span>
        {$phone.input}
        <span class="description"><span class="optional">(optional)</span>{$phone.description}</span>
    </div>
    
    <div class="field {if $profile.input->error()}error{/if}">
        <span>{$profile.title}</span>
        {$profile.input}
        <span class="description"><span class="optional">(optional)</span>{$profile.description}</span>
    </div>
    
    <div class="field">
    {if isset($toolbar_left[0])}
        {$toolbar_left[0]}
    {/if}
    </div>
    
</form>