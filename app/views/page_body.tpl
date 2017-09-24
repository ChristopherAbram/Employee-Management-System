
<script src="{$home.link}/plugins/ckeditor/full/ckeditor.js"></script>
<script src="{$home.link}/plugins/ckeditor/full/sample.js"></script>

<section class="form">
    
    <form id="pagebody" method="post" action="{$panel.link}/pagebody">
    
    <span>{$body.title}</span>
        {$body.input}
    <span class="description">{$body.description}</span>
        
    <!--<div class="field {if $body.input->error()}error{/if}">
        
        <span>{$body.title}</span>
        {$body.input}
        <span class="description">{$body.description}</span>
    </div>-->
    
    </form>
</section>
    
<script>
    initSample();
</script>