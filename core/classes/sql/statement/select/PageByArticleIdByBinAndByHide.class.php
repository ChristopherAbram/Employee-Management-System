<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\sql\statement\select;

class PageByArticleIdByBinAndByHide extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT page.id AS `id` FROM article INNER JOIN page_article ON page_article.article_id = article.id INNER JOIN page ON page.id = page_article.page_id WHERE article.id = :id AND page.bin = :bin AND page.hide = :hide';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
            'bin'       => 'bin',
            'hide'      => 'hide'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}