<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\select;

class ArticleGradeCountByUserAndArticleId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(id) AS `count` FROM article_grade WHERE article_id = :aid AND user_id = :uid';
        
        // Used parameters:
        protected $_requiredParams = array(
            'aid'        => 'article_id',
            'uid'        => 'user_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}