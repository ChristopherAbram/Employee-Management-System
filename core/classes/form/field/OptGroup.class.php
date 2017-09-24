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

class OptGroup extends SelectOption implements \core\interfaces\OptionSet {
    // vars {
        
        protected $_options         = array();
        
        protected $_index           = 0;
        
    // } methods {
    
        // public {
            
            public function __construct(array $options = array()){
                $this->addAll($options);
            }// end __construct
            
            public function add(SelectOption $option){
                $this->_options[] = $option;
            }// end add
            
            public function addAll(array $options){
                foreach($options as $option){
                    if($option instanceof SelectOption){
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
        
            public function __toString(){
                $optgroup = '<optgroup';
                $optgroup .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $optgroup .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $optgroup .= (is_null($this->label())) ? "" : " label=\"{$this->label()}\"";
                $optgroup .= '>';
                foreach($this->_options as $option){
                    $optgroup .= $option."\n";
                }
                $optgroup .= '</optgroup>';
                return $optgroup;
            }// end __toString
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}