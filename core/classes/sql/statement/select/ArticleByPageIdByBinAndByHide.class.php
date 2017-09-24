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

class ArticleByPageIdByBinAndByHide extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT article.id FROM article INNER JOIN page_article ON page_article.article_id = article.id WHERE page_article.page_id = :id AND bin = :bin AND hide = :hide ORDER BY ord ASC, cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
            'bin'       => 'bin',
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