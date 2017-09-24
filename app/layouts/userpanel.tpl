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
        <link href="{$home.link}/{$path.style}/panel/userform.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/account.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/header.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/usermain.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/useravatar.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/usermodulemenu.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/message.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/footer.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/panel/userupload.style.css" rel="stylesheet">
        
        {foreach from=$styles item=style}
        <link href="{$home.link}/{$path.style}/{$style}" rel="stylesheet">
        {/foreach}
        <link href="{$home.link}/{$path.style}/slider.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/front.style.css" rel="stylesheet">
        
        <script type="text/javascript" src="{$home.link}/scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/upload/addprogress.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/plugins.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/script.js"></script>
        
        <link rel="icon" type="image/png" href="{$home.link}/{$path.img}/logo/Icon/LogoSquareBlack.png">
        
    </head>
    
    <body>
        <div id="page">
            <div id="container">
                <!-- Information board -->
                {include file="informer.tpl"}
                
                <!-- No script info -->
                {include file="noscript.tpl"}
                <!-- Cookie info -->
                {include file="cookie.tpl"}

                <header>
                    {include file="header.tpl"}
                </header>

                {include file="messages.tpl"}
                
                <main>
                    <div id="module_option">
                        {include file="user_avatar.tpl"}
                        <nav id="module_menu">
                        {include file="module_menu.tpl"}
                        </nav>
                    </div>
                            
                    <div id="module_content">
                        {$__content__}
                    </div>
                </main>
            </div>
                    
            <footer>
                {include file="footer.tpl"}
            </footer>
        </div>
    </body>
</html>

