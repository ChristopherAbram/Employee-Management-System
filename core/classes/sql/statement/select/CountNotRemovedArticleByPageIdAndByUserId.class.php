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

class CountNotRemovedArticleByPageIdAndByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(DISTINCT article.id) AS `count` FROM article INNER JOIN page_article ON page_article.article_id = article.id WHERE bin = 0 AND user_id = :user_id AND page_id = :page_id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'    => 'user_id',
            'page_id'    => 'page_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}