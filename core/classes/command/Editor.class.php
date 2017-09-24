<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	12.09.2016
 */

namespace core\classes\command;

abstract class Editor extends Command {
    // vars {
        
        protected $_mode        = 0;
        
        // Available modes:
        const CREATE            = 0;
        const UPDATE            = 1;
    
    // } methods {
    
        // public {
        
           
            
        // } protected {
            
            protected function _mode($mode = null){
                if(!is_null($mode)){
                    $this->_mode = $mode;
                }
                return $this->_mode;
            }// end _mode
        
            abstract protected function _read();
            
            abstract protected function _update();
            
            abstract protected function _create();
            
            protected function _save(){
                if($this->_mode() == self::CREATE){
                    return $this->_create();
                } else if(($this->_mode() == self::UPDATE)){
                    return $this->_update();
                }
                return false;
            }// end _save
            
        // } private {
            
        // }
    // }
}