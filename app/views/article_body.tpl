
<script src="{$home.link}/plugins/ckeditor/full/ckeditor.js"></script>
<script src="{$home.link}/plugins/ckeditor/full/sample.js"></script>

<section class="form">
    
    <form id="articlebody" method="post" action="{$panel.link}/articlebody">
    
    <span>{$body.title}</span>
        {$body.input}
    <span class="description">{$body.description}</span>
    
    </form>
</section>
    
<script>
    initSample();
</script>