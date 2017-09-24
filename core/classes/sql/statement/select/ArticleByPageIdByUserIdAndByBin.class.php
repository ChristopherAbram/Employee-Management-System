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

class ArticleByPageIdByUserIdAndByBin extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT article.id FROM article INNER JOIN page_article ON page_article.article_id = article.id WHERE page_article.page_id = :page_id AND user_id = :user_id AND bin = :bin ORDER BY cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'page_id'   => 'page_id',
            'user_id'   => 'user_id',
            'bin'       => 'bin',
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