<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\sql\statement\select;

class CountryByAddressId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT country.id AS `country_id` FROM address INNER JOIN country ON country.id = address.country_id WHERE address.id = :id';
        
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