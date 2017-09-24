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

class ArticleByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM article WHERE user_id = :id LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
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