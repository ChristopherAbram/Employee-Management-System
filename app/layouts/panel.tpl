<!DOCTYPE html>
<html lang="{$lang}">
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="{$home.link}/{$path.style}/all.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/font.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/general.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/menu.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/informer.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/form.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/account.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/header.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/menu.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/modulemenu.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/toolbar.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/main.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/message.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/footer.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/userupload.style.css" rel="stylesheet">
        
        {foreach from=$styles item=style}
        <link href="{$home.link}/{$path.style}/{$style}" rel="stylesheet">
        {/foreach}
        
        <link rel="icon" type="image/png" href="{$home.link}/{$path.img}/logo/Icon/LogoSquareBlack.png">
        <script type="text/javascript" src="{$home.link}/scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/jquery-ui.min.js"></script>
        
    </head>
    <body>
        {include file="informer.tpl"}
        
        <header>
            <div class="belt"></div>
            
            <figure class="logo section"></figure>
            
            <nav class="section">
                <div style="position: absolute; bottom: 0;">
                {include file="menu.tpl"}
                </div>
            </nav>
            
            <div class="section" id="extra">
                <div class="account">
                    {if $user_identified}
                    <a class="button" href="{$home.link}/logout">Log out</a>
                    {/if}
                </div>
            </div>
        </header>
        
        <main>
            <nav id="module_menu">
                <div id="theme_img">
                {include file="user_avatar.tpl"}
                </div>
                {include file="module_menu.tpl"}
            </nav>
            
            {include file="toolbar.tpl"}
            
            {include file="messages.tpl"}
            
            <article>
                {$__content__}
            </article>
        </main>
        
        <footer>
            <div class="belt"></div>
            
            <div class="foot">
                &COPY; {$year} Christopher John Abram.<br>
                All Right Reserved.
            </div>
        </footer>
    </body>
</html>