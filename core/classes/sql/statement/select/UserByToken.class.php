<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\sql\statement\select;

class UserByToken extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM user WHERE token = :token';
        
        // Used parameters:
        protected $_requiredParams = array(
            'token'        => 'token',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}