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

class Option extends SelectOption {
    // vars {
        
        protected $_value       = null;
        
        protected $_selected    = null;
    
    // } methods {
    
        // public {
            
            public function __construct($label, $value, $selected = false, $disabled = false){
                $this->label($label);
                $this->value($value);
                $this->selected($selected);
                $this->disabled($disabled);
            }// end __construct
            
            public function value($value = null){
                if(!is_null($value)){
                    $this->_value = $value;
                }
                return $this->_value;
            }// end value
            
            public function selected($selected = null){
                if(!is_null($selected)){
                    $this->_selected = $selected;
                }
                return $this->_selected;
            }// end selected
        
            public function __toString(){
                $option = '<option';
                $option .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $option .= is_null($this->value()) ? '' : " value=\"{$this->value()}\"";
                $option .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $option .= (is_null($this->selected()) || $this->selected() == false) ? "" : " selected=\"selected\"";
                $option .= '>';
                $option .= is_null($this->label()) ? '' : $this->label();
                $option .= '</option>';
                return $option;
            }// end __toString
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}