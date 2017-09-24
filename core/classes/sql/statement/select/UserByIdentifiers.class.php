<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\sql\statement\select;

class UserByIdentifiers extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM user WHERE email LIKE :email AND password LIKE :password';
        
        // Used parameters:
        protected $_requiredParams = array(
            'email'        => 'email',
            'password'     => 'password'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}