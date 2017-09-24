<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\select;

class SessionValueByKey extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM `session_value` WHERE `session_id` = :id AND `key` = :key';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'    => 'id',
            'key'   => 'key',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}