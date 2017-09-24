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

class Email extends Input {
    // vars {
        
        protected $_multiple        = null;
    
    // } methods {
    
        // public {
            
            public function multiple($multiple = null){
                if(!is_null($multiple)){
                    $this->_multiple = $multiple;
                }
                return $this->_multiple;
            }// end multiple
            
        // } protected {
        
            protected function _toString(){
                $text = '<input type="email"';
                $text .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $text .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $text .= " name=\"{$this->name()}\"";
                $text .= (is_null($this->value()) || !$this->fill()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $text .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $text .= (is_null($this->required()) || $this->required() == false) ? "" : " required=\"required\"";
                $text .= (is_null($this->readonly()) || $this->readonly() == false) ? "" : " readonly=\"readonly\"";
                $text .= (is_null($this->multiple()) || $this->multiple() == false) ? "" : " multiple=\"multiple\"";
                $text .= '/>';
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}