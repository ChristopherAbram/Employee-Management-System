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

class CountVisibleCommentByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(id) AS `count` FROM comment WHERE user_id = :user_id AND hide=:hide';
        
        // Used parameters:
        protected $_requiredParams = array(
            'hide'      => 'hide',
            'user_id'   => 'user_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}