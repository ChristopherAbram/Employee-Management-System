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

abstract class Operation {
    // vars {
        
        protected $_save_callback        = null;
        protected $_update_callback      = null;
        protected $_delete_callback      = null;
        protected $_perform_callback     = null;
        
        protected $_onsuccess_callback   = null;
        protected $_onwarning_callback   = null;
        protected $_onerror_callback     = null;
        protected $_ondone_callback      = null;
        
        protected $_request              = null;
        
    // } methods {
    
        // public {
        
            public function __construct(){
                $this->_request = \RequestRegistry::getRequest();
            }
            
            public function onsuccess($callback){
                $this->_onsuccess_callback = $callback;
            }
            
            public function onwarning($callback){
                $this->_onwarning_callback = $callback;
            }
            
            public function onerror($callback){
                $this->_onerror_callback = $callback;
            }
            
            public function ondone($callback){
                $this->_ondone_callback = $callback;
            }
            
            public function perform($callback){
                $this->_perform_callback = $callback;
                $p = $this->_perform();
                $this->_ondone();
                return $p;
            }// end perform
            
            public function save($callback){
                $this->_save_callback = $callback;
                $p = $this->_save();
                $this->_ondone();
                return $p;
            }// end save
            
            public function update($callback){
                $this->_update_callback = $callback;
                $p = $this->_update();
                $this->_ondone();
                return $p;
            }// end update
            
            public function delete($callback){
                $this->_delete_callback = $callback;
                $p = $this->_delete();
                $this->_ondone();
                return $p;
            }// end delete
            
        // } protected {
            
            protected function _ondone(){
                if(is_callable($this->_ondone_callback)){
                    \call_user_func($this->_ondone_callback);
                }
            }// end _ondone
            
            abstract protected function _perform();
            abstract protected function _save();
            abstract protected function _update();
            abstract protected function _delete();
            
        // } private {
            
            
            
        // }
    // }
}