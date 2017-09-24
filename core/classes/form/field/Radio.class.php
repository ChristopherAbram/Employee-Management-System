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

class Radio extends Input {
    // vars {
        
        protected $_checked            = false;
    
    // } methods {
    
        // public {
        
            public function checked($checked = null){
                if(!is_null($checked)){
                    $this->_checked = $checked;
                }
                else {
                    if(!is_null($this->value()) && isset($this->_request[$this->name()]) && ($this->_request[$this->name()] == $this->value())){
                        $this->_checked = true;
                    }
                }
                return $this->_checked;
            }// end checked
            
            public function value($value = null){
                if(!is_null($value)){
                    $this->_value = $value;
                    //$this->_setValue($this->_name, $this->_value);
                }
                /*else {
                    $req_val = $this->_fetchValue($this->_name);
                    if(!is_null($req_val)){
                        $this->_value = $req_val;
                    }
                }*/
                return $this->_value;
            }// end value
            
        // } protected {
        
            protected function _toString(){
                $text = '<input type="radio"';
                $text .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $text .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $text .= " name=\"{$this->name()}\"";
                $text .= is_null($this->value()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $text .= (($this->checked() == false) || !$this->fill()) ? "" : " checked=\"checked\"";
                $text .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $text .= (is_null($this->required()) || $this->required() == false) ? "" : " required=\"required\"";
                $text .= '/>';
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}