<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\operation
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\operation;

class SingleRequest extends Operation {
    // vars {
        
        protected $_name        = '';
        
    // } methods {
    
        // public {
            
            public function __construct(){
                parent::__construct();
            }
            
            public function setName($name){
                $this->_name = $name;
            }// end setName
            
        // } protected {
            
            protected function _perform(){
                
            }
            
            protected function _save(){
                
            }
            
            protected function _update(){
                if(isset($this->_request[$this->_name])){
                    $f = true;
                    $in = $this->_request[$this->_name];
                    if(\is_array($in)){
                        foreach($in as $name => $value){
                            $f = \call_user_func($this->_update_callback, $name, $value);
                            if(!$f){
                                break;
                            }
                        }
                    }
                    else {
                        $f = \call_user_func($this->_update_callback, $this->_name, $in);
                    }
                    if(!is_null($this->_onsuccess_callback) && $f){
                        \call_user_func($this->_onsuccess_callback);
                    }
                    else if(!is_null($this->_onerror_callback) && !$f){
                        \call_user_func($this->_onerror_callback);
                    }
                }
            }
            
            protected function _delete(){
                
            }
            
        // } private {
            
            
            
        // }
    // }
}