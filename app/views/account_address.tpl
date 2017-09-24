<form id="address" method="post" action="{$panel.link}/useraddress">
    <div id="country_select_box" class="field {if $country.input->error()}error{/if}">
        <span>{$country.title}</span>
        {$country.input}
        <span class="description">{$country.description}</span>
    </div>
    
    <style type="text/css">
        #country_select_box select {
            max-width: 230px;
        }
    </style>
    
    <div class="field {if $city.input->error()}error{/if}">
        <span>{$city.title}</span>
        {$city.input}
        <span class="description">{$city.description}</span>
    </div>
    
    <div class="field {if $zip.input->error()}error{/if}">
        <span>{$zip.title}</span>
        {$zip.input}
        <span class="description"><span class="optional">(optional)</span>{$zip.description}</span>
    </div>
    
    <div class="field {if $street.input->error()}error{/if}">
        <span>{$street.title}</span>
        {$street.input}
        <span class="description"><span class="optional">(optional)</span>{$street.description}</span>
    </div>
    
    <div class="field {if $house.input->error()}error{/if}">
        <span>{$house.title}</span>
        {$house.input}
        <span class="description"><span class="optional">(optional)</span>{$house.description}</span>
    </div>
    
    <div class="field {if $flat.input->error()}error{/if}">
        <span>{$flat.title}</span>
        {$flat.input}
        <span class="description"><span class="optional">(optional)</span>{$flat.description}</span>
    </div>
    
    <div class="field">
    {if isset($toolbar_left[0])}
        {$toolbar_left[0]}
    {/if}
    </div>
    
</form>