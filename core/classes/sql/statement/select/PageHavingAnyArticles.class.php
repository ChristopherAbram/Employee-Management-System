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

class PageHavingAnyArticles extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT DISTINCT page.id FROM page_article INNER JOIN page ON page.id = page_article.page_id WHERE page.bin = 0 ORDER BY page.cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
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