<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\delete
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\delete;

class UserPageByUserId extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'DELETE FROM user_page WHERE user_id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'            => 'user_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}