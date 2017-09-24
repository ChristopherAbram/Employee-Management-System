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

class CountNotRemovedAndNotHiddenArticle extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(article.id) AS `count` FROM article INNER JOIN page ON page.id = article.page_id WHERE article.bin = 0 AND article.hide = 0 AND page.bin = 0 AND page.hide = 0';
        
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