
<style type="text/css">
    #responsibility_name, #responsibility_desc {
        width: 90%;
    }
    
    .title {
        font-family: 'OpenSansLight';
        font-size: 1em;
        font-weight: bold;
        border: none;
    }
    
    .item:hover .title, .item:hover .desc {
        background: #f9f9f9;
    }
    
    .desc {
        font-family: 'OpenSansLight';
        font-size: 13px;
        border: none;
    }
</style>

<form id="add_responsibility" method="post" action="{$panel.link}/addresponsibility">
    <table style="width: 100%; margin: -30px 0 0 0;">
        <tr>
            <td style="width: 300px;">
                <div class="field {if $name.input->error()}error{/if}">
                    <span>{$name.title}</span>
                    {$name.input}
                </div>
            </td>
            
            <td>
                <div class="field {if $desc.input->error()}error{/if}">
                    <span>{$desc.title}</span>
                    {$desc.input}
                </div>
            </td>
            
            <td style="width: 100px;">
                <div class="field" style="position: relative; top: 27px;">
                    {$add.input}
                </div>
            </td>
        </tr>
    </table>
</form>

{if !empty($responsibilities)}
Responsibilities list:
<section class="item_list">
    <form id="responsibility_list" method="post" action="{$panel.link}/responsibilities/{$page_number}">

        <div class="list level0">
            {foreach from=$responsibilities item=data}
            {include file="responsibility_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{/if}