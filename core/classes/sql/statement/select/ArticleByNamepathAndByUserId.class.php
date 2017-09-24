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

class ArticleByNamepathAndByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM article WHERE namepath LIKE :namepath AND user_id = :user_id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'namepath'          => 'namepath',
            'user_id'           => 'user_id',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}