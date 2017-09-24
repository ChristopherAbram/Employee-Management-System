<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\select;

class UnremovedPageById extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT $attributeList FROM page WHERE id = :id AND bin = 0';
        
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