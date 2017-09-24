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

class CountPageHavingAnyArticlesforPublicist extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(DISTINCT user_page.page_id) AS `count` FROM page INNER JOIN user_page ON user_page.page_id = page.id INNER JOIN page_article ON page_article.page_id = page.id INNER JOIN article ON article.id = page_article.article_id WHERE page.bin = 0 AND user_page.user_id = :id AND article.user_id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'    => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}