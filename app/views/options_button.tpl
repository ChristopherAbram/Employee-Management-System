<div class="buttonContener {$button.side}" id="{$button.id}">
    <div class="button">{$button.name}</div>
    <div class="button-panel">
        <div class="button-arrow"></div>
        <ul class="button-list">
            
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="submit" name="{$button.id}_sortAZ" value="Sort from A to Z"/>
                <input type="submit" name="{$button.id}_sortZA" value="Sort from Z to A"/>
                {foreach from=$button.options item=option}
                <input type="submit" name="{$option.name}" class="working-option switchList_{$option.class}" value="{$option.value}"/>
                {/foreach}
            </form>
            
            
            <form action="" method="POST" enctype="multipart/form-data">
            <span class="expTitle">Choose options</span>
            <ul class="expand">
                <li class="optionsList">
                     <div class="field">
                        <input type="checkbox" name="all" id="all" checked="checked" /><label for="all">Select all</label>
                     </div>
                     {foreach from=$button.list key=key item=element}
                     <div class="field">
                         {assign var=ending value=preg_replace('@[.,\s-]*@i', '', $element.value)}
                         <input type="checkbox" name="{$button.table}_{$button.column}_{$ending}}" 
                         id="check_{$key}" value="{$element.value}" {$element.checked} />
                         <label for="check_{$key}">{$element.value}</label>
                     </div>
                     {/foreach}
                </li>
                <input type="submit" name="{$button.id}_2submit" value="Show results" style="text-align: right;" />
            </ul>
            </form>
        </ul>
    </div>
</div>