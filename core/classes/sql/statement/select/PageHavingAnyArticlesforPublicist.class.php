<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.09.2016
 */

namespace core\classes\sql\statement\select;

class PageHavingAnyArticlesforPublicist extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT DISTINCT user_page.page_id AS `id` FROM page INNER JOIN user_page ON user_page.page_id = page.id INNER JOIN page_article ON page_article.page_id = page.id INNER JOIN article ON article.id = page_article.article_id WHERE page.bin = 0 AND user_page.user_id = :id AND article.user_id = :id ORDER BY page.cdate DESC LIMIT :offset, :count';
        
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