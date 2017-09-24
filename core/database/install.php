<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Install database
 *
 * @package    core\database
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.10.2016
 */

// Loading private server configurations:
require_once realpath( dirname(__FILE__).'/../../private/load.php' );
require_once realpath( dirname(__FILE__).'/../../private/location.setting.php' );

// Loading libraries:
require_once realpath( dirname(__FILE__).'/../../lib/load.php' );

require_once realpath( dirname(__FILE__).'/../classes/definitions.php' );
require_once realpath( dirname(__FILE__).'/../functions/load.php' );
require_once realpath( dirname(__FILE__).'/../interfaces/load.php' ); 
require_once realpath( dirname(__FILE__).'/../classes/registry/load.php' );

\spl_autoload_register(function($class){
    $classname = '';
    $namespace = \core\functions\extract_interface_name($class, $classname);
    
    // Load definitions:
    $definitions = realpath( dirname(__FILE__).'/../../'.$namespace.'/definitions.php' );
    if(\file_exists($definitions)){
        require_once $definitions;
    }
    
    // Load lang:
    $lang = \core\classes\languages\Lang::getDisplayLanguage();
    $langfile = realpath( dirname(__FILE__).'/../../'.$namespace.'/lang/'.$lang.'.php' );
    if(\file_exists($langfile)){
         require_once $langfile;
    }
    
    // Load class file:
    $file = realpath( dirname(__FILE__).'/../../'.$namespace.'/'.$classname.'.class.php' );
    if(\file_exists($file)){
        require_once $file;
    }
}, false, false);

require_once realpath( dirname(__FILE__).'/queries.php' );
require_once realpath( dirname(__FILE__).'/insert.php' );

//\header('Content-Type: text/html; charset=utf-8');
//\header(\core\functions\status(200));

echo '<pre>';
var_dump(\core\functions\password('password'));
var_dump(\date(\DATETIME));
echo '</pre>';

try {
    
    $connection = \ConnectionRegistry::getRootEstablishedConnection();
    if($connection){
        $PDO = $connection->getPDO();
        if(!$PDO){
            throw new \Exception('Can\'t establish connection with database.');
        }
        
        foreach($queries as $name => $syntax){
            $exe = false;
            $exe = $PDO->exec($syntax);
            
            if($exe !== false){
                echo '<span style="color: #19b300;">'.$name.' executed properly,</span><br>';
            }
            else {
                echo '<span style="color: #f00;">'.$name.' failed</span>,<br>';
            }
        }
        
        
        // Inserting countries
        $counrty_insert = 'INSERT INTO country(name, short) VALUES(?, ?)';
        $q = $PDO->prepare($counrty_insert);
        if($q){
            $exe = true;
            $PDO->beginTransaction();
            foreach($COUNTRIES as $number => $country){
                $exe = $q->execute(array($country, (isset($COUNTRIES_SHORT[$number]) ? $COUNTRIES_SHORT[$number] : '')));
                if(!$exe){
                    break;
                }
            }
            
            if($exe){
                if($PDO->commit()){
                    echo '<span style="color: #19b300;">Countries properly inserted.</span><br>';
                }
                else {
                    echo '<span style="color: #f00;">Something went wrong while inserting countries to database.</span><br>';
                }
            }
            else {
                $PDO->rollBack();
                echo '<span style="color: #f00;">Something went wrong while inserting countries to database.</span><br>';
            }
        }
        
        
        // Inserting initial data
        foreach($inserts as $name => $syntax){
            $exe = false;
            $exe = $PDO->exec($syntax);
            
            if($exe !== false){
                echo '<span style="color: #19b300;">'.$name.' executed properly,</span><br>';
            }
            else {
                echo '<span style="color: #f00;">'.$name.' failed</span>,<br>';
            }
        }
    }
    
} catch (\Exception $ex) {
    echo $ex->getMessage();
}