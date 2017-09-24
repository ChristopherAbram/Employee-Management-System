<section class="title">{$title}</section>
<section class="content">
    {$description}
</section>

<section class="form">
    
    <form id="articleoptions" method="post" action="{$panel.link}/articleoptions">
    
    <div class="field {if $keywords_.input->error()}error{/if}">
        <span>{$keywords_.title}</span>
        {$keywords_.input}
        <span class="description">{$keywords_.description}</span>
    </div>
    
    <div class="field {if $ord.input->error()}error{/if}">
        <span>{$ord.title}</span>
        {$ord.input}
        <span class="description">{$ord.description}</span>
    </div>
    
    <div class="field {if $mark.input->error() or $hide.input->error()}error{/if}" style="overflow: hidden;">
        <div style="float: left; width: 150px;">
            <span>{$hide.title}</span>
            {$hide.input}
            <span class="description">{$hide.description}</span>
        </div>
        
        <div style="float: left; width: 150px;">
            <span>{$mark.title}</span>
            {$mark.input}
            <span class="description">{$mark.description}</span>
        </div>
    </div>
    
    </form>
</section>