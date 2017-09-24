<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * error
 *
 * @package    error/error.php
 * @author     Christopher Abram
 * @version    1.0
 * @date        06.09.2016
 */

require_once realpath( dirname(__FILE__).'/../core/functions/load.php' );
require_once realpath( dirname(__FILE__).'/../core/classes/response/Response.class.php' );

// Retrive status code:
$status = isset($_GET['error']) && !empty($_GET['error']) ? $_GET['error'] : 0;

// Get status info:
$text = '';
if($status == 0)
    $text = 'Unknown error';
else
    $text = \core\classes\response\Response::status($status);

echo '<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>'.$text.'</title>

    <link href="'.\core\functions\address().'/app/style/all.style.css" rel="stylesheet">
    <link href="'.\core\functions\address().'/app/style/font.style.css" rel="stylesheet">
    <link href="'.\core\functions\address().'/app/style/general.style.css" rel="stylesheet">
    <link href="'.\core\functions\address().'/app/style/work.page.style.css" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="'.\core\functions\address().'/app/img/logo/Icon/LogoSquareBlack.png">

</head>

<body>
    <!-- header -->
    <div class="header_work">

        <div class="header_upperline_work"></div>

        <div class="header_block_work">
            <div class="header_logo_work"></div>
        </div>

    </div>

    <!-- conainer -->
    <div class="contener_work">
        <div class="contener_maincontent_work">
            <div class="contener_welcometext_work">
                <p class="huge">'.$text.'</p>
            </div>

            <div class="contener_form_work" style="border: none;">
                <img src="'.\core\functions\address().'/app/img/file_broken.png" style="width: 256px; height: 256px; position: relative; left: 50%; margin-left: -128px;"/>
            </div>

        </div>
    </div>

    <!-- footer -->
    <div class="footer_work">
            <div class="footer_block_work">
            <div class="footer_bottommenu_work">
                <a class="menulink" href="'.\core\functions\address().'">Home</a>
            </div>
        </div>
    </div>
</body>
</html>';