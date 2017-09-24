{if !$user_identified}
<div id="login_bar" style="display: {if $error_login}block{else}none{/if};">
    <div class="close_button" id="login_bar_close"></div>
    <div class="login_area">
        <form id="login" method="post" action="{$home.link}/login?url={$path.current|urlencode}">
            <div class="title">Log into your account</div>
            <div class="field {if $error_login}error{/if}" style="overflow: hidden">
                <div id="email">
                    <span class="label">E-mail:</span>
                    <input type="email" name="email" value="" required="required"/>
                </div>
                <div id="password">
                    <span class="label">Password:</span>
                    <input type="password" name="password" value="" required="required"/>
                </div>
            </div>
            {if $login_message neq ''}
            <div class="field error" style="overflow: hidden;">
                <div class="message" style="padding: 0 0 0 30px">{$login_message}</div>
            </div>
            {/if}

            <div style="position: relative; overflow: hidden; height: 50px;">

                <div id="remember">
                    <input type="checkbox" name="remember"/> Remember me
                </div>

                <div id="login_button_area" class="field">
                    <input id="login_submit" type="submit" name="login_submition" value="Log in"/>
                </div>

            </div>

        </form>
    </div>
</div>

<script type="text/javascript">
    
    function show_login_bar(){
        var login_bar = document.getElementById('login_bar');
        var login_button = document.getElementById('login_button');
        var close_button = document.getElementById('login_bar_close');

        if(login_button && close_button){
            login_button.onclick = function(){
                login_bar.style.display = 'block';
            };

            close_button.onclick = function(){
                login_bar.style.display = 'none';
            };
        }
    }
    
    if(window.addEventListener){
        window.addEventListener('load', show_login_bar)
    }
    else if(window.attachEvent){
        window.attachEvent('onload', show_login_bar)
    }
</script>
{/if}