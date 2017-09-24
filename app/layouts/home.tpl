<!DOCTYPE html>
<html lang="{$lang}">
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="{$keywords}">
        <meta name="author" content="{$author}">
        <meta name="description" content="{$meta_description}">
        
        <!-- Facebook -->
        <meta property="og:title" content="{$title}">
        <meta property="og:type" content="website">
        <meta property="article:author" content="{if isset($author)}{$author}{/if}">
        <meta property="og:url" content="{$home.link}">
        <meta property="og:description" content="{if isset($meta_description)}{$meta_description}{/if}">
        <meta property="og:site_name" content="Krzysztof Abram">
        
        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{$title}">
        <meta name="twitter:description" content="{if isset($meta_description)}{$meta_description}{/if}">
        
        <!-- Styles -->
        <link href="app/style/general.style.css" rel="stylesheet" media="screen">
        <link href="app/style/font.style.css" rel="stylesheet" media="screen">
        <link href="app/style/all.style.css" rel="stylesheet" media="screen">
        <link href="app/style/front.style.css" rel="stylesheet" media="screen">
        
        <link rel="icon" type="image/png" href="app/img/solteq.png">
        
        <!-- Scripts -->
        <script type="text/javascript" src="scripts/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="scripts/js/start.js"></script>
        
        {foreach from=$styles item=style}
        <link href="{$home.link}/{$path.style}/{$style}" rel="stylesheet">
        {/foreach}
        
        <style type="text/css">
            #loading {
                width: 100%;height: 100%;position: fixed;top: 0;z-index: 9999;background: #191919;
            }
            #load-img {
                width: 800px;height: 600px;position: absolute;top: 50%;left: 50%;margin: -300px 0 0 -400px;background: url('app/img/loader.gif') no-repeat; 
            }
        </style>
        
    </head>
    <body>
        
        <!-- Information board -->
        {include file="informer.tpl"}

        <!-- No script info -->
        {include file="noscript.tpl"}
        
        <!-- Cookie info -->
        {include file="cookie.tpl"}
        
        <!-- Loading block - preloader -->
        <div id="loading">
            <div id="load-img"></div>
        </div>
        
        <!-- Picture -->
        <div id="picture"></div>
        
        <header>
            {include file="header.tpl"}
        </header>

        <main>
            {$__content__}
        </main>

        <footer>
            {include file="footer.tpl"}
        </footer>
              
    </body>
</html>
