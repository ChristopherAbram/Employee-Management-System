<div class="buttonContener {$button.side}" id="{$button.id}">
    <div class="button">{$button.name}</div>
    <div class="button-panel">
        <div class="button-arrow"></div>
        <ul class="button-list">
        	<form action="" method="POST" enctype="multipart/form-data">
            <input type="submit" name="{$button.id}_sortSN" value="Sort oldest to newest"/>
            <input type="submit" name="{$button.id}_sortNS" value="Sort newest to oldest"/>
            {foreach from=$button.options item=option}
            <input type="submit" name="{$option.name}" class="switchList_{$option.class}" value="{$option.value}"/>
            {/foreach}
            </form>
            <form action="" method="POST" enctype="multipart/form-data">
            <span class="expTitle">Date filters</span>
            <ul class="expand">
                <li>
                    Specify the conditions:
                    <div class="field">
                        <select name="{$button.id}_1options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="{$button.id}_1equals">is equal</option>
                            <option value="{$button.id}_1notequals">is not equal</option>
                            <option value="{$button.id}_1isafter">is after</option>
                            <option value="{$button.id}_1isafterorequal">is after or equal</option>
                            <option value="{$button.id}_1isbefore">is before</option>
                            <option value="{$button.id}_1isbeforeorequal">is before or equal</option>
                            <option value="{$button.id}_1beginsfrom">starts from</option>
                            <option value="{$button.id}_1notbeginsfrom">does not start from</option>
                            <option value="{$button.id}_1endsat">ends with</option>
                            <option value="{$button.id}_1notendsat">does not end with</option>
                            <option value="{$button.id}_1contains">includes</option>
                            <option value="{$button.id}_1notcontains">does not include</option>
                        </select>
                        <input type="text" name="{$button.id}_1input" id="{$button.id}_1input" style="float: left; width: 47%;" />
                    </div>
                     <div class="field">
                        <div style="float: left;">
                        	<input type="radio" name="{$button.id}_logic" id="And" value="{$button.id}_and" checked="checked" />
                            <label for="And">And</label>
                        </div>
                        <div style="float: left;">
                        	<input type="radio" name="{$button.id}_logic" id="Or" value="{$button.id}_or" />
                            <label for="Or">Or</label>
                        </div>
                    </div>
                    <div class="field">
                        <select name="{$button.id}_2options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="{$button.id}_2equals">is equal</option>
                            <option value="{$button.id}_2notequals">is not equal</option>
                            <option value="{$button.id}_2isafter">is after</option>
                            <option value="{$button.id}_2isafterorequal">is after or equal</option>
                            <option value="{$button.id}_2isbefore">is before</option>
                            <option value="{$button.id}_2isbeforeorequal">is before or equal</option>
                            <option value="{$button.id}_2beginsfrom">starts from</option>
                            <option value="{$button.id}_2notbeginsfrom">does not start from</option>
                            <option value="{$button.id}_2endsat">ends with</option>
                            <option value="{$button.id}_2notendsat">does not end with</option>
                            <option value="{$button.id}_2contains">includes</option>
                            <option value="{$button.id}_2notcontains">does not include</option>
                        </select>
                        <input type="text" name="{$button.id}_2input" id="{$button.id}_2input" style="float: left; width: 47%;" />
                    </div>
                    <div class="field">
                        Sign ? represents any single character.<br />
                        Sign * represents any string.<br /><br />
                        <span style="font-size: 12px">Notice that in filters: is after, is before ( or equal )<br /> signs like " ?, * " are ignored.</span>
                    </div>
                </li>
                <input type="submit" name="{$button.id}_1submit" value="Show results" style="text-align: right;"/>
            </ul>
            
        </ul>
    </div>
</div>