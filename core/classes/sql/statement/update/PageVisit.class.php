<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.10.2016
 */

namespace core\classes\sql\statement\update;

class PageVisit extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE page_visit SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
            'user_id'       => 'user_id',
            'page_id'       => 'page_id',
            'cdate'         => 'cdate'
        );
        
        // Other parameters:
        protected $_requiredParams = array(
            'identifier'    => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}