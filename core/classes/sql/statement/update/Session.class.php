<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\sql\statement\update;

class Session extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE session SET $attributeList WHERE id = :id';
        
        // Used set parameters:
        protected $_setParameters = array(
            'sid'       => 'sid',
            'sido'      => 'sido',
            'last'      => 'last'
        );
        
        // Other parameters:
        protected $_requiredParams = array(
            'id'    => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}