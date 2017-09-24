<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	14.09.2016
 */

namespace core\classes\sql\statement\select;

class EmailExistence extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM user WHERE email = :email';
        
        // Used parameters:
        protected $_requiredParams = array(
            'email'     => 'email'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}