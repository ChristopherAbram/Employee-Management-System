
<script src="{$home.link}/plugins/ckeditor/basic/ckeditor.js"></script>
<script src="{$home.link}/plugins/ckeditor/basic/sample.js"></script>

<style type="text/css">
    #department_title {
        width: 98%;
    }
</style>

<section class="form">
    
    <form id="departmenteditor" method="post" action="{$panel.link}/departmenteditor">
    
    <div class="field {if $name.input->error()}error{/if}">
        <span>{$name.title}</span>
        {$name.input}
        <span class="description">{$name.description}</span>
    </div>
    
    <span>{$desc.title}</span>
    {$desc.input}
    <span class="description">{$desc.description}</span>
    
    <table>
        <tr>
            <td>
                <div class="field {if $city.input->error()}error{/if}">
                    <span>{$city.title}</span>
                    {$city.input}
                    <span class="description">{$city.description}</span>
                </div>
            </td>
            
            <td>
                <div class="field {if $zip.input->error()}error{/if}">
                    <span>{$zip.title}</span>
                    {$zip.input}
                    <span class="description">{$zip.description}</span>
                </div>
            </td>
            
        </tr>
        
        <tr>
            <td>
                <div class="field {if $street.input->error()}error{/if}">
                    <span>{$street.title}</span>
                    {$street.input}
                    <span class="description">{$street.description}</span>
                </div>
            </td>
            
            <td>
                <div class="field {if $house.input->error()}error{/if}">
                    <span>{$house.title}</span>
                    {$house.input}
                    <span class="description">{$house.description}</span>
                </div>
            </td>
            
            <td>
                <div class="field {if $flat.input->error()}error{/if}">
                    <span>{$flat.title}</span>
                    {$flat.input}
                    <span class="description">{$flat.description}</span>
                </div>
            </td>
        </tr>
    </table>
    
    </form>
</section>
    
<script>
    initSample();
</script>