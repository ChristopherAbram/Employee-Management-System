<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\update;

class Department extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE department SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
            'namepath'      => 'namepath', 
            'name'          => 'name', 
            'description'   => 'description', 
            'city'          => 'city',
            'zip'           => 'zip', 
            'street'        => 'street', 
            'house'         => 'house', 
            'flat'          => 'flat'
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