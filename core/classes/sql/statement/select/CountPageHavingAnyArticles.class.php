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

class CountPageHavingAnyArticles extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(DISTINCT page.id) AS `count` FROM page_article INNER JOIN page ON page.id = page_article.page_id WHERE page.bin = 0';
        
        // Used parameters:
        protected $_requiredParams = array(
            
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}