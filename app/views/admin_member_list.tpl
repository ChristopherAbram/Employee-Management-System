
<div style="width: 80%; margin: 0 auto; border: solid 1px #000000; overflow: hidden; padding: 10px 0; position: fixed; top: 80px;">

    {assign var="button" value=$firstname_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$lastname_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$email_button}
    {include file="text_button_noopt.tpl"}
    
    {assign var="button" value=$reg_button}
    {include file="date_button.tpl"}

</div>

{if !empty($members)}
<section class="item_list">
    <form id="user_list" method="post" action="{$panel.link}/members/{$page_number}">

        <div class="list level0">
            {foreach from=$members item=data}
            <div class="item">
                <div class="left">
                    <input class="check" type="checkbox" name="user[{$data.id}]" value="1" />
                    <div class="functions">
                    <input class="{if $data.isactive eq 0}lock_button_active{else}lock_button{/if}" title="isactive" type="submit" name="{if $data.isactive eq 0}activate{else}deactivate{/if}[{$data.id}]" value="" />
                    </div>
                    <figure class="image">
                        <img src="{if isset($data.avatar) and isset($data.avatar.miniature)}{$data.avatar.miniature}{else}{$home.link}/{$path.img}/users.png{/if}" width="100" height="100" alt="image" />
                    </figure>
                </div>
                <div class="center">
                    <a href="{$panel.link}/member/{$data.id}">{$data.firstname} {$data.lastname}</a>
                    <div class="info">
                        <div class="user">
                            e-mail: {$data.email}<br>
                            role: {$data.role.name}
                        </div>
                        <div class="edate">Registered: {$data.cdate|date_format:"%B %e, %Y"}</div>
                    </div>
                </div>
            </div>
            {/foreach}
        </div>
        
    </form>
</section>
{else}
<div class="no_results">No results</div> 
{/if}


<script type="text/javascript" src="{$home.link}/scripts/js/smart_button/functions.js"></script>

<script>

//var button0 = new smartButton( 'tools' ).init( );
var button1 = new smartButton( "{$firstname_button.id}" ).init( );
var button2 = new smartButton( "{$lastname_button.id}" ).init( );
var button3 = new smartButton( "{$email_button.id}" ).init( );
var button4 = new smartButton( "{$reg_button.id}" ).init( );
/*var button2 = new smartButton( 'fnameButton' ).init( );
var button3 = new smartButton( 'lnameButton' ).init( );
var button4 = new smartButton( 'emailButton' ).init( );
var button5 = new smartButton( 'phoneButton' ).init( );
var button6 = new smartButton( 'cityButton' ).init( );
var button6 = new smartButton( 'cdateButton' ).init( );
var button6 = new smartButton( 'dimButton' ).init( );*/

</script>