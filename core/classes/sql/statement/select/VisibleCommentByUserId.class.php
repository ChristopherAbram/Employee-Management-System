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

class VisibleCommentByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM comment WHERE user_id = :user_id AND hide=:hide ORDER BY cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'   => 'user_id',
            'hide'      => 'hide',
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