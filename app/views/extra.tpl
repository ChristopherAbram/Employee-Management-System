<article>
<section class="title">{$title}</section>
<section class="content">
    {$description}
</section>

<section class="form">
    
    <form id="cancel" method="post" action=""></form>
    
    <form id="ext" method="post" action="{$home.link}/extra">
    
    <div class="field {if $desc.input->error()}error{/if}">
        <span>{$desc.title}</span>
        {$desc.input}
        <span class="description"><span class="optional">(optional)</span>{$desc.description}</span>
    </div>
    
    <div class="field {if $citation.input->error()}error{/if}">
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
    
    <div class="field" style="overflow: hidden;">
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