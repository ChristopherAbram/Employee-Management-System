<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.10.2016
 */

namespace core\classes\sql\statement\insert;

class PageArticle extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO page_article($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'page_id'       => 'page_id',
            'article_id'    => 'article_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}