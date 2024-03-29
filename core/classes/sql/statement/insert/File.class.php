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

class File extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO file($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'fiid'      => 'file_info_id',
            'con'       => 'content',
        );  
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}