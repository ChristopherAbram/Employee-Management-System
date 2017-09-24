
<style type="text/css">
#desc_input {
    min-width: 80%;
    min-height: 150px;
}
#citation {
    min-width: 80%;
}
</style>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="ext" method="post" action="{$panel.link}/extra">
    
    <div class="field {if $desc.input->error()}error{/if}">
        <span>{$desc.title}</span>
        {$desc.input}
        <span class="description">{$desc.description}</span>
    </div>
    
    <div class="field {if $citation.input->error()}error{/if}">
        <span>{$citation.title}</span>
        {$citation.input}
        <span class="description">{$citation.description}</span>
    </div>
    
    <div class="field {if $phone.input->error()}error{/if}">
        <span>{$phone.title}</span>
        {$phone.input}
        <span class="description">{$phone.description}</span>
    </div>
    
    <div class="field" style="overflow: hidden;">
        <span>{$role.title}</span>
        <div>
        {$role.input1} {$role.title1}
        </div>
        <div>
        {$role.input2} {$role.title2}
        </div>
    </div>
    
    </form>
</section>