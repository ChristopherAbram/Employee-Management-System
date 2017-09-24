<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\classes\form\field\set;

class Text extends Set {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _newFieldInstance($name, $fill) {
                return new \core\classes\form\field\Text($name, $fill);
            }// end _newFieldInstance
            
        // } private {
            
        // }
    // }
}