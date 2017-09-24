<div class="item">
    <div class="left" style="width: 50px;">
        <input class="check" type="checkbox" name="department[{$data.id}]" value="1" style="margin: 18px 0 0 10px;" />
    </div>
    <div class="center">
        <span class="item_title">{$data.name|truncate:128}</span>
        <a class="edit_button" href="{$panel.link}/departmenteditor/{$data.namepath}">edit</a>
        
        <div class="info">
            
            <div class="user">
                {assign var='google_link' value="{$data.zip}, {$data.city}, {$data.street}, {$data.house}"}
                <a href="https://www.google.com/maps/search/?api=1&query={$google_link|urlencode}" target="_blank">{$data.zip} {$data.city}, {$data.street} {$data.house} {$data.flat}</a>
            </div>
        </div>
        <div class="description">
            {$data.description|truncate:250}
        </div>
    </div>
</div>