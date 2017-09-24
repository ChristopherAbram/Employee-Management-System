<div id="welcome">
    <div id="subs">
        <span class="huge">Welcome to the best employee management system</span><br>
        <span class="small">Together we can change the world.</span>
    </div>

    <div id="login">
        <form id="signin" method="post" action="{$home.link}/login">

            <div class="field {if $error_login}error{/if}">
                <span>Email</span>
                <input type="email" id="email" form="signin" name="email" value="" required="required"/>
                <span class="description"></span>
            </div>

            <div class="field {if $error_login}error{/if}">
                <span>Password</span>
                <input type="password" id="password" form="signin" name="password" value="" required="required"/>
                <span class="description"></span>
            </div>

            {if $login_message neq ''}
            <div class="field error" style="overflow: hidden;">
                <div class="message" style="padding: 0">{$login_message}</div>
            </div>
            {/if}
                
            <div class="field" style="overflow: hidden">
                <input id="submit" type="submit" form="signin" name="confirm" value="Sign in"/>
            </div>

        </form>
    </div>
</div>