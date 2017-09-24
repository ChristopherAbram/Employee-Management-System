<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\sql\statement\insert;

class Address extends Statement {
    // vars {
        
        // Address select query:
        protected $_query = 'INSERT INTO address($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'country_id'    => 'country_id',
            'user_id'       => 'user_id',
            'city'          => 'city',
            'zip'           => 'zip',
            'street'        => 'street',
            'house'         => 'house',
            'flat'          => 'flat'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}