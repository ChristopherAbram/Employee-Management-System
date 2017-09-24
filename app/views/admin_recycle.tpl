
{if (isset($pages, $articles, $files, $members) and (!empty($pages) or !empty($articles) or !empty($files) or !empty($members)))}
<section class="item_list">
    <form id="list" method="post" action="{$panel.link}/recycle">
        <div class="list level0">
           
        {if isset($pages) and !empty($pages)}
            {foreach from=$pages item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="page[{$data.id}]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        <img src="{$home.link}/{$path.img}/image_default.png" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    {$data.title}
                </div>
            </div>
            {/foreach}
        {/if}
            
        {if isset($articles) and !empty($articles)}
            {foreach from=$articles item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="article[{$data.id}]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        {if isset($data.picture.miniature)}
                        <img src="{$data.picture.miniature}" width="100" height="100" alt="image" />
                        {else}
                        <img src="{$home.link}/{$path.img}/image_default.png" width="100" height="100" alt="image" />
                        {/if}
                    </figure>
                </div>
                <div class="center">
                    {$data.title}
                </div>
            </div>
            {/foreach}
        {/if}
        
        {if isset($files) and !empty($files)}
            {foreach from=$files item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="file[{$data.id}]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        {if isset($data.miniature)}
                        <img src="{$data.miniature}" width="100" height="100" alt="image" />
                        {else}
                        <img src="{$home.link}/{$path.img}/image_default.png" width="100" height="100" alt="image" />
                        {/if}
                    </figure>
                </div>
                <div class="center">
                    {$data.name}
                    <div class="user">
                        Size: {$data.size|filesize}<br>
                    </div>
                </div>
            </div>
            {/foreach}
        {/if}
        
        {if isset($members) and !empty($members)}
            {foreach from=$members item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="member[{$data.id}]" value="1" />
                    <figure class="image" style="margin: 0 0 0 5px;">
                        <img src="{$home.link}/{$path.img}/users.png" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    {$data.firstname} {$data.lastname}
                    <div class="user">
                        e-mail: {$data.email}<br>
                    </div>
                </div>
            </div>
            {/foreach}
        {/if}
        
        </div>
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}
