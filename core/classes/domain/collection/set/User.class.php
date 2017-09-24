<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\collection\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\domain\collection\set;

class User extends Set {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
        
        // } protected {
            
            protected function _getDomainObject($id = null, \core\classes\data\Data $dataObject = null){
                return new \core\classes\domain\Plain($id, $dataObject);
            }// end _getDomainObject
            
        // } private {
            
        // }
    // }
}