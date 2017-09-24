<section class="title">{$title}</section>
<section class="content">
    {$description}
</section>

<script src="{$home.link}/plugins/ckeditor/basic/ckeditor.js"></script>
<script src="{$home.link}/plugins/ckeditor/basic/sample.js"></script>

<section class="form">
    
    <form id="pageeditor" method="post" action="{$panel.link}/pageeditor">
    
    <div class="field {if $tit.input->error()}error{/if}">
        <span>{$tit.title}</span>
        {$tit.input}
        <span class="description">{$tit.description}</span>
    </div>
    
    <span>{$desc.title}</span>
    {$desc.input}
    <span class="description">{$desc.description}</span>
    
    <div class="field {if $namepath.input->error()}error{/if}">
        <span>{$namepath.title}</span>
        {$namepath.input}
        <span class="description">{$namepath.description}</span>
    </div>
    
    <div class="field {if $link.input->error()}error{/if}">
        <span>{$link.title}</span>
        {$link.input}
        <span class="description">{$link.description}</span>
    </div>
    
    </form>
</section>
    
<script>
    initSample();
</script>