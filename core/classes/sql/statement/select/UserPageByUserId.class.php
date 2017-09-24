<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\sql\statement\select;

class UserPageByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM user_page WHERE user_id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}