<div class="buttonContener {$button.side}" id="{$button.id}">
    <div class="button">{$button.name}</div>
    <div class="button-panel">
        <div class="button-arrow"></div>
        <ul class="button-list">
        	<form action="" method="POST" enctype="multipart/form-data">
            <input type="submit" name="{$button.id}_sortLS" value="Sort largest to smallest"/>
            <input type="submit" name="{$button.id}_sortSL" value="Sort smallest to largest"/>
            {foreach from=$button.options item=option}
            <input type="submit" name="{$option.name}" class="switchList_{$option.class}" value="{$option.value}"/>
            {/foreach}
            </form>
            <form action="" method="POST" enctype="multipart/form-data">
            <span class="expTitle">Number filters</span>
            <ul class="expand">
                <li>
                    Specify the conditions:
                    <div class="field">
                        <select name="{$button.id}_1options" style="float: left; width: 47%; margin: 0 10px 0 0;">
                            <option value=""></option>
                            <option value="{$button.id}_1equals">is equal</option>
                            <option value="{$button.id}_1notequals">is not equal</option>
                            <option value="{$button.id}_1isgreaterthan">is greater then</option>
                            <option value="{$button.id}_1isgreaterthanorequal">is greater then or equal</option>
                            <option value="{$button.id}_1islessthan">is lower then</option>
                            <option value="{$button.id}_1islessthanorequal">is lower then or equal</option>
                            <option value="{$button.id}_1beginsfrom">starts from</option>
                            <option value="{$button.id}_1notbeginsfrom">does not start from</option>
                            <option value="{$button.id}_1endsat">ends with</option>
                            <option value="{$button.id}_1notendsat">does not end with</option>
                            <option value="{$button.id}_1contains">includes</option>
                            <option value="{$button.id}_1notcontains">does not include</option>
                        </select>
                        <input type="text" name="{$button.id}_1input" style="float: left; width: 47%;" />
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
                            <option value="{$button.id}_2isgreaterthan">is greater then</option>
                            <option value="{$button.id}_2isgreaterthanorequal">is greater then or equal</option>
                            <option value="{$button.id}_2islessthan">is lower then</option>
                            <option value="{$button.id}_2islessthanorequal">is lower then or equal</option>
                            <option value="{$button.id}_2beginsfrom">starts from</option>
                            <option value="{$button.id}_2notbeginsfrom">does not start from</option>
                            <option value="{$button.id}_2endsat">ends with</option>
                            <option value="{$button.id}_2notendsat">does not end with</option>
                            <option value="{$button.id}_2contains">includes</option>
                            <option value="{$button.id}_2notcontains">does not include</option>
                        </select>
                        <input type="text" name="{$button.id}_2input" style="float: left; width: 47%;" />
                    </div>
                    <div class="field">
                        Sign ? represents any single character.<br />
                        Sign * represents any string.
                    </div>
                </li>
                <input type="submit" name="{$button.id}_1submit" value="Show results" style="text-align: right;" />
            </ul>
            </form>
        </ul>
    </div>
</div>