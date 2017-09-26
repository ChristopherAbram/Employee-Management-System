<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\sql\statement\select;

class CountAgreementByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(id) AS `count` FROM agreement WHERE user_id = :user_id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'  => 'user_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}