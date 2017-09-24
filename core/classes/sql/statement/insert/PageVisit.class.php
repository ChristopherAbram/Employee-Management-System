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

class PageVisit extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO page_visit($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'       => 'user_id',
            'page_id'       => 'page_id',
            'cdate'         => 'cdate'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}