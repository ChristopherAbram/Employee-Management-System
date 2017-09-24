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

class SubmitButton extends Button {
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
            
            public function onsubmit($callback){
                if(\is_callable($callback) && $this->submitted()){
                    return \call_user_func($callback);
                }
                return null;
            }// end onsubmit
            
        // } protected {
        
            protected function _toString(){
                $button = '<button type="submit"';
                $button .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $button .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $button .= " name=\"{$this->name()}\"";
                $button .= (is_null($this->disabled()) && $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $button .= is_null($this->value()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $button .= '>';
                $button .= is_null($this->value()) ? '' : $this->displayValue();
                $button .= '</button>';
                return $button;
            }// end _toString
            
        // } private {
            
        // }
    // }
}