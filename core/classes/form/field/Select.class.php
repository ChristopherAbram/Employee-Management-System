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

class Select extends Field implements \core\interfaces\OptionSet {
    // vars {
        
        protected $_multiple        = null;
    
        protected $_options         = array();
        
        protected $_index           = 0;
    
    // } methods {
    
        // public {
            
            public function __construct($name) {
                parent::__construct($name);
            }// end __construct
        
            public function multiple($multiple = null){
                if(!is_null($multiple)){
                    $this->_multiple = $multiple;
                }
                return $this->_multiple;
            }// end multiple
            
            public function value($value = null){
                parent::value($value);
                if(!is_null($value)){
                    foreach($this as $option){
                        $this->_markOptionAsSelected($option);
                    }
                }
                return $this->_value;
            }// end value
            
            public function add(SelectOption $option){
                $this->_markOptionAsSelected($option);
                $this->_options[] = $option;
            }// end add
            
            public function addAll(array $options){
                foreach($options as $option){
                    if($option instanceof SelectOption){
                        $this->_markOptionAsSelected($option);
                        $this->_options[] = $option;
                    }
                }
            }// end addAll
            
            public function next(){
                ++$this->_index;
            }// end next
            
            public function current(){
                return $this->_options[$this->_index];
            }// end current
            
            public function key(){
                return $this->_index;
            }// end key
            
            public function valid(){
                return (isset($this->_options[$this->_index]));
            }// end valid
            
            public function rewind(){
                $this->_index = 0;
            }// end rewind
            
        // } protected {
            
            protected function _toString(){
                $select = '<select';
                $select .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $select .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $select .= " name=\"{$this->name()}\"";
                $select .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $select .= (is_null($this->required()) || $this->required() == false) ? "" : " required=\"required\"";
                $select .= (is_null($this->multiple()) || $this->multiple() == false) ? "" : " multiple=\"multiple\"";
                $select .= '>';
                foreach($this->_options as $option){
                    $select .= $option."\n";
                }
                $select .= '</select>';
                return $select;
            }// end _toString
        
            protected function _markOptionAsSelected(SelectOption $option){
                if($this->fill()){
                    if($option instanceof OptGroup){
                        foreach($option as $single_option){
                            $this->_markOptionAsSelected($single_option);
                        }
                    }
                    else if($this->value() == $option->value()){
                        $option->selected(true);
                    }
                }
                return;
            }// end _markOptionAsSelected
            
        // } private {
            
        // }
    // }
}