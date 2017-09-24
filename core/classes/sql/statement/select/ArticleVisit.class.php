<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\select;

class ArticleVisit extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT $attributeList FROM article_visit WHERE id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}