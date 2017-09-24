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

class Textarea extends Field {
    // vars {
        
        
    
    // } methods {
    
        // public {
        
            
            
        // } protected {
        
            protected function _toString(){
                $textarea = '<textarea';
                $textarea .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $textarea .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $textarea .= " name=\"{$this->name()}\"";
                $textarea .= (is_null($this->disabled()) && $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $textarea .= (is_null($this->required()) && $this->required() == false) ? "" : " required=\"required\"";
                $textarea .= (is_null($this->readonly()) && $this->readonly() == false) ? "" : " readonly=\"readonly\"";
                $textarea .= '>';
                $textarea .= (is_null($this->value()) || !$this->fill()) ? '' : $this->displayValue();
                $textarea .= '</textarea>';
                return $textarea;
            }// end _toString
            
        // } private {
            
        // }
    // }
}