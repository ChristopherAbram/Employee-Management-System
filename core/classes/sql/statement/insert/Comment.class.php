<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\insert;

class Comment extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO comment($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'uid'           => 'user_id',
            'aid'           => 'article_id',
            'content'       => 'content',
            'cdate'         => 'cdate',
            'hide'          => 'hide',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}