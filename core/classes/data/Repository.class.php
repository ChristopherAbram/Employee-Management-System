<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\data;

class Repository {
    // vars {
        
        // instance:
        private static $__instance = null;
    
    // } methods {
    
        // public {
        
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public static function get($classname, $id){
                $id = (int)$id;
                $namespace = __NAMESPACE__;
                $class = $namespace.'\\'.$classname;
                $obj = DataWatcher::getInstance()->get($class, $id);
                if(is_null($obj)){
                    $obj = new $class($id);
                }
                return $obj;
            }// end get
        
        // } protected {
            
            
            
        // } private {
            
            private function __construct(){}
        
        // }
    // }
}