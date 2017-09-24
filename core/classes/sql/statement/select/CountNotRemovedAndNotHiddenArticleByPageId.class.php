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

class CountNotRemovedAndNotHiddenArticleByPageId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(article.id) AS `count` FROM article INNER JOIN page_article ON page_article.article_id = article.id WHERE page_article.page_id = :id AND bin = 0 AND hide = 0';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'   => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}