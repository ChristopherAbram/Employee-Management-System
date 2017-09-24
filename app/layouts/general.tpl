<!DOCTYPE html>
<html lang="{$lang}">
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="{if isset($keywords)}{$keywords}{/if}">
        <meta name="author" content="{if isset($author)}{$author}{/if}">
        <meta name="description" content="{if isset($meta_description)}{$meta_description}{/if}">
        
        <link href="{$home.link}/{$path.style}/all.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/font.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/general.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/menu.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/informer.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/form.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/account.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/header.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/login.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/main.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/article.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/content.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/message.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/footer.style.css" rel="stylesheet">
        
        {foreach from=$styles item=style}
        <link href="{$home.link}/{$path.style}/{$style}" rel="stylesheet">
        {/foreach}
        <link href="{$home.link}/{$path.style}/slider.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/front.style.css" rel="stylesheet">
        
        <script type="text/javascript" src="{$home.link}/scripts/js/jquery.min.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/plugins.js"></script>
        <script type="text/javascript" src="{$home.link}/scripts/js/script.js"></script>
        
        <link href="{$home.link}/scripts/js/highlight/styles/darcula.css" rel="stylesheet">
        <script type="text/javascript" src="{$home.link}/scripts/js/highlight/highlight.min.js"></script>
        
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
                <!-- Login bar -->
                {include file="identification.tpl"}
                
                <header>
                    {include file="header.tpl"}
                </header>
                
                
                
                {include file="messages.tpl"}

                <main>
                    {include file="ancestors.tpl"}

                    {$__content__}
                </main>
            </div>
                    
            <footer>
                {include file="footer.tpl"}
            </footer>
        </div>
    </body>
</html>