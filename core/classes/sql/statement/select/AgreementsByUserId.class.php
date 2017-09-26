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

class AgreementsByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM agreement WHERE user_id = :user_id ORDER BY (to_date IS NOT NULL), to_date DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'    => 'user_id',
            'offset'    => 'offset',
            'count'     => 'count'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}