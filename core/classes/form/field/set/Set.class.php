<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form\field\set;

abstract class Set extends \SplObjectStorage {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            public function __construct(array $names, $fill = true){
                foreach($names as $name){
                    $this->attach($this->_newFieldInstance($name, $fill));
                }
            }// end __construct
            
            public function apply($callback){
                foreach($this as $field){
                    \call_user_func($callback, $field);
                }
                return;
            }// end apply
            
        // } protected {
        
            abstract protected function _newFieldInstance($name, $fill);
            
        // } private {
            
        // }
    // }
}