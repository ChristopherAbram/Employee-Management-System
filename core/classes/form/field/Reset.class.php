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

class Reset extends Input {
    // vars {
        
        
    
    // } methods {
    
        // public {
        
            public function submitted(){
                $request = \RequestRegistry::getRequest();
                if(isset($request[$this->_name])){
                    return true;
                }
                return false;
            }// end submitted
            
        // } protected {
        
            protected function _toString(){
                $text = '<input type="reset"';
                $text .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $text .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $text .= " name=\"{$this->name()}\"";
                $text .= is_null($this->value()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $text .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $text .= '/>';
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}