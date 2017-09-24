<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\registry
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

class RequestRegistry extends \Registry {
    // vars {
    
        private static $__instance = null;
        
        private $__map = array();
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public static function getRequest(){
                if(!is_null(self::getInstance()->get('request'))){
                    return self::getInstance()->get('request');
                }
                return new \core\classes\request\Request();
            }// end getRequest
            
            public static function setRequest(\core\classes\request\Request $request){
                self::getInstance()->set('request', $request);
            }// end setRequest
            
        // } protected {
        
            protected function set($key, $value){
                $this->__map[$key] = $value;
            }// end set
            
            protected function get($key){
                if(isset($this->__map[$key]))
                    return $this->__map[$key];
                return null;
            }// end get
            
        // } private {
        
            private function __construct(){}
            
        // }
    // }
}