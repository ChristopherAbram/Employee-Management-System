<div class="item">
    <div class="left" style="width: 50px;">
        <input class="check" type="checkbox" name="responsibility[{$data.id}]" value="1" style="margin: 18px 0 0 10px;" />
    </div>
    <div class="center">
        <span class="item_title"><input class="title" type="text" name="responsibility[name][{$data.id}]" value="{$data.name}" style="" /></span>
        <div class="description">
            <textarea class="desc" name="responsibility[description][{$data.id}]" style="width: 90%; min-height: 50px;">{$data.description}</textarea>
        </div>
    </div>
</div>