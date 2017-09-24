
<article>
    
    <form id="upload" method="POST" action="{$home.link}/connector/save" enctype="multipart/form-data">
    <div class="field">
        {$file}
    </div>
    
    <div class="field">
        {$submit}
    </div>
    </form>
    
    <form id="delete" method="POST" action="{$home.link}/connector/delete" enctype="multipart/form-data">
    {section loop=104 name=imgs start=96 step=1}
        <div>
            {$smarty.section.imgs.index}
            <input type="checkbox" name="remove[]" value="{$smarty.section.imgs.index}">
            <img src="{$home.link}/connector/miniature/{$smarty.section.imgs.index}" alt="image">
        </div>
    {/section}
    <input type="submit" name="rem" value="remove">
    </form>
    
</article>