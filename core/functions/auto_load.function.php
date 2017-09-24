<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2017
 */

namespace core\functions;

function auto_load( $class ){
    $classname = '';
    $namespace = \core\functions\extract_interface_name($class, $classname);
    
    $namespaces = explode('/', $namespace);
    $name = 'core/classes';
    foreach($namespaces as $space){
        if($space == 'classes' || $space == 'core') continue;
        $name .= '/'.$space;
        
        $definitions = realpath( dirname(__FILE__).'/../../'.$name.'/definitions.php' );
        if(\file_exists($definitions)){
            require_once $definitions;
        }
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
}