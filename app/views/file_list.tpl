{foreach from=$files item=file}
<div class="tile">
    <div class="imgContener">
        <div class="cross">
            <input type="text" name="file_name[{$file.id}]" value="{$file.name}" class="file_name" readonly="readonly" />
            {if $removeable eq 'true'}<input type="submit" name="remove[]" value="{$file.id}" class="close" title="Remove" />{/if}
            {if !empty($input)}<input type="{$input}" name="file[]" value="{$file.id}" />{/if}
        </div>
        <img class="thumb" src="{$file.miniature}" title="{$file.name}" />
    </div>
    <div class="progress">
        <div class="bar"></div>
        <input type="hidden" name="response" value="" />
        <div class="responseMessage">{$file.name}</div>
    </div>
</div>
{/foreach}