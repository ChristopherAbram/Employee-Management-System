<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\insert;

class ArticleGrade extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO article_grade($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'       => 'user_id',
            'article_id'    => 'article_id',
            'v'             => 'value',
            'cdate'         => 'cdate'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}