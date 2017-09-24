<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form\field;

abstract class SelectOption {
    // vars {
        
        protected $_id          = null;
        
        protected $_label       = null;
        
        protected $_disabled    = null;
    
    // } methods {
    
        // public {
            
            public function id($id = null){
                if(!is_null($id)){
                    $this->_id = $id;
                }
                return $this->_id;
            }// end id
            
            public function label($label = null){
                if(!is_null($label)){
                    $this->_label = $label;
                }
                return $this->_label;
            }// end label
            
            public function disabled($disabled = null){
                if(!is_null($disabled)){
                    $this->_disabled = $disabled;
                }
                return $this->_disabled;
            }// end disabled
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}