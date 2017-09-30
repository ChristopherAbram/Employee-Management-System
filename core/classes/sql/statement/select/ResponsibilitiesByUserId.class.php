<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\sql\statement\select;

class ResponsibilitiesByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT DISTINCT responsibility.id FROM responsibility INNER JOIN agreement ON agreement.responsibility_id = responsibility.id WHERE agreement.user_id = :user_id LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'           => 'user_id',
            'offset'            => 'offset',
            'count'             => 'count'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}