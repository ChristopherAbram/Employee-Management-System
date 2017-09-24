
<section class="form" style="margin: -30px 0 40px 0;">
    <form id="cancel" method="post" action=""></form>
    <form id="address" method="post" action="{$panel.link}/address">
    
    <div class="field {if $country.input->error()}error{/if}">
        <span>{$country.title}</span>
        {$country.input}
        <span class="description">{$country.description}</span>
    </div>
    
    <div class="field {if $city.input->error()}error{/if}">
        <span>{$city.title}</span>
        {$city.input}
        <span class="description">{$city.description}</span>
    </div>
    
    <div class="field {if $zip.input->error()}error{/if}">
        <span>{$zip.title}</span>
        {$zip.input}
        <span class="description">{$zip.description}</span>
    </div>
    
    <div class="field {if $street.input->error()}error{/if}">
        <span>{$street.title}</span>
        {$street.input}
        <span class="description">{$street.description}</span>
    </div>
    
    <div class="field {if $house.input->error()}error{/if}">
        <span>{$house.title}</span>
        {$house.input}
        <span class="description">{$house.description}</span>
    </div>
    
    <div class="field {if $flat.input->error()}error{/if}">
        <span>{$flat.title}</span>
        {$flat.input}
        <span class="description">{$flat.description}</span>
    </div>
    
    </form>
    
</section>