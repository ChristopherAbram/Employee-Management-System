<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\cookie
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\cookie;

class Cookie extends \ArrayObject {
    // vars {
        
        protected static $_instance     = null;
        
        // Default expiration time: 
        protected $_expire              = 1800;
        
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$_instance)){
                    self::$_instance = new self();
                }
                return self::$_instance;
            }// end getInstance
            
            public function setExpireTime($time){
                $this->_expire = $time;
            }// end setExpireTime
            
            public function setcookie($name, $value = '', $expire = 0, $path = '', $domain = '', $secure = false, $httponly = false){
                if(is_array($value)){
                    foreach($value as $key => $val){
                        if(!$this->setcookie($name.'['.$key.']', $val, $expire, $path, $domain, $secure, $httponly)){
                            return false;
                        }
                    }
                    return true;
                }
                else {
                    return \setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
                }
            }// end setcookie
            
            public function offsetSet($index, $newval) {
                $time = \time();
                $_COOKIE[$index] = $newval;
                $this->setcookie($index, $newval, $time + $this->_expire);
            }// end offsetSet
            
            public function offsetGet($index) {
                if(is_string($_COOKIE[$index])){
                    return \htmlspecialchars($_COOKIE[$index]);
                }
                return $_COOKIE[$index];
            }// end offsetGet
            
            public function offsetExists($index) {
                return isset($_COOKIE[$index]);
            }// end offsetExists
            
            public function offsetUnset($index) {
                if($this->offsetExists($index) && is_array($this[$index])){
                    $this->setcookie($index, $this[$index], \time() - (1 * 60 * 60)); // expired 1 hour ago
                }
                else {
                    $this->setcookie($index, '', \time() - (1 * 60 * 60)); // expired 1 hour ago
                    unset($_COOKIE[$index]);
                }
                return;
            }// end offsetUnset
            
        // } protected {
            
            public function __construct(){
                parent::__construct();
                
            }// end __construct
            
        // } private {
            
        // }
    // }
}