<!DOCTYPE html>
<html lang="{$lang}">
    <head>
        <title>{$title}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="{$home.link}/{$path.style}/all.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/font.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/general.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/header.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/main.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/error.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/article.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/content.style.css" rel="stylesheet">
        <link href="{$home.link}/{$path.style}/footer.style.css" rel="stylesheet">
        
        <link rel="icon" type="image/png" href="{$home.link}/{$path.img}/logo/Icon/LogoSquareBlack.png">
        
    </head>
    <body>
        
        <header>
            <div class="belt"></div>
            <figure class="logo section"></figure>
        </header>
        
        <main>
            
            {$__content__}
            
            <aside></aside>
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
