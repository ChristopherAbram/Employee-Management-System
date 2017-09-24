<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\sql\statement\update;

class Address extends Statement {
    // vars {
        
        // Address select query:
        protected $_query = 'UPDATE address SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
            'country_id'    => 'country_id',
            'user_id'       => 'user_id',
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