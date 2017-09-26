<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\form\field;

class Number extends Input {
    // vars {
        
        protected $_min         = null;
        protected $_max         = null;
        protected $_step        = 'any';
    
    // } methods {
    
        // public {
        
            public function min($min = null){
                if(!is_null($min)){
                    $this->_min = $min;
                }
                return $this->_min;
            }// end min
            
            public function max($max = null){
                if(!is_null($max)){
                    $this->_max = $max;
                }
                return $this->_max;
            }// end max
            
            public function step($step = null){
                if(!is_null($step)){
                    $this->_step = $step;
                }
                return $this->_step;
            }
            
        // } protected {
        
            protected function _toString(){
                $text = '<input type="number"';
                $text .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $text .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $text .= " name=\"{$this->name()}\"";
                $text .= (is_null($this->value()) || !$this->fill()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $text .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $text .= (is_null($this->required()) || $this->required() == false) ? "" : " required=\"required\"";
                $text .= (is_null($this->readonly()) || $this->readonly() == false) ? "" : " readonly=\"readonly\"";
                $text .= (is_null($this->min()) || $this->min() == false) ? "" : " min=\"{$this->min()}\"";
                $text .= (is_null($this->max()) || $this->max() == false) ? "" : " max=\"{$this->max()}\"";
                $text .= is_null($this->step()) ? '' : " step=\"{$this->step()}\"";
                $text .= '/>';
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}