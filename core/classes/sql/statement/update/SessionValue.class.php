<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\update;

class SessionValue extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE session_value SET $attributeList WHERE id = :id';
        
        // Used set parameters:
        protected $_setParameters = array(
            'session_id'    => 'session_id',
            'key'           => 'key',
            'value'         => 'value'
        );
        
        // Other parameters:
        protected $_requiredParams = array(
            'id'            => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}