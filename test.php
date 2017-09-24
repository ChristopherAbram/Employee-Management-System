<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * Solteq application
 *
 * @package    solteq
 * @author     Christopher Abram
 * @version    1.0
 * @date        19.09.2017
 */
 
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
    
    $session = \core\classes\session\Session::getInstance();
    
    $session->setLifetime(30);
    $session->setRegenerationInterval(10);
    
    
    $session->start();
    $session->regenerate_id();
    
    //$session['jazda'] = 'off';
    //$session['user'] = array('name' => 'Tomasz', 1,2,3,4,5,6,7);
    
    //$session->destroy();
    
    echo '<pre>';
    var_dump($_COOKIE);
    echo '</pre>';
    
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
    
} catch( \ErrorException $error ){
    // output XML communique when error occurred:
    echo $error->getCommunique( );
    exit( 0 );
}