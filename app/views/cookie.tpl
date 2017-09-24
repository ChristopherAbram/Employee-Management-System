{if !$cookie_confirmed}
<div id="cookie_info" style="overflow: hidden;">
    <div style="float: left; padding: 5px 20px;">{$cookie}</div> 
    <div id="cookie_button">Agree!</div>
</div>
<script type="text/javascript" src="{$home.link}/scripts/js/cookies.js"></script>
<script type="text/javascript">
    
    function show_cookie_bar(){
        var cookie_info = document.getElementById('cookie_info');
        var cookie_button = document.getElementById('cookie_button');

        cookie_button.onclick = function(){
            setCookie('cookie_info', 1, 365*24*60*60);
            cookie_info.style.display = 'none';
        };
    }
    
    if(window.addEventListener){
        window.addEventListener('load', show_cookie_bar);
    }
    else if(window.attachEvent){
        window.attachEvent('onload', show_cookie_bar);
    }
</script>
{/if}