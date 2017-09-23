<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * INDEX code
 *
 * @package    application.php
 * @author     Christopher Abram
 * @version    1.0
 * @date        19.09.2017
 */

//\ob_start();

// Loading private server configurations:
require_once realpath( dirname(__FILE__).'/private/load.php' );

// Loading libraries:
require_once realpath( dirname(__FILE__).'/lib/load.php' );
require_once realpath( dirname(__FILE__).'/core/classes/definitions.php' );
require_once realpath( dirname(__FILE__).'/core/functions/load.php' );
require_once realpath( dirname(__FILE__).'/core/interfaces/load.php' ); 
require_once realpath( dirname(__FILE__).'/core/classes/registry/load.php' );

// Register load function:
\spl_autoload_register("\\core\\functions\\auto_load", true, true);

//$session = \core\classes\session\Session::getInstance();
//echo $session->status() == 2 ? 'active' : 'not active';
//die();

try {
    
    // CGI runtime application in php:
    include_once realpath( dirname(__FILE__).'/solteq.php' );
    
} catch( \ErrorException $error ){
    // output XML communique when error occurred:
    echo $error->getCommunique( );
    exit( 0 );
}

//\ob_end_flush();