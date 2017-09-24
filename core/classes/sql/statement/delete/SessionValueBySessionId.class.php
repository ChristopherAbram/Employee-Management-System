<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\delete
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\delete;

class SessionValueBySessionId extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'DELETE FROM session_value WHERE session_id = :session_id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'session_id'            => 'session_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}