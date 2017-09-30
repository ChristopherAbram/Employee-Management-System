
<div style="margin: 0 auto; width: 100%; border-bottom: solid 1px #bbb;  padding: 5px 0; position: fixed; top: 91px; left: 0; background: #e1e1e1;">

    <div class="left" style="position: relative; left: 270px;">
    {assign var="button" value=$firstname_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$lastname_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$email_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$reg_button}
    {include file="date_button.tpl"}
    
    {assign var="button" value=$role_button}
    {include file="options_button.tpl"}
    </div>
</div>

<div style="margin-top: 8px;">
{if !empty($members)}
<section class="item_list">
    <form id="user_list" method="post" action="{$panel.link}/members/{$page_number}">

        <div class="list level0">
            {foreach from=$members item=data}
            {include file="user_card.tpl"}
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}
</div>

<script type="text/javascript" src="{$home.link}/scripts/js/smart_button/functions.js"></script>

<script>
var button1 = new smartButton( "{$firstname_button.id}" ).init( );
var button2 = new smartButton( "{$lastname_button.id}" ).init( );
var button3 = new smartButton( "{$email_button.id}" ).init( );
var button4 = new smartButton( "{$reg_button.id}" ).init( );
var button5 = new smartButton( "{$role_button.id}" ).init( );
</script>