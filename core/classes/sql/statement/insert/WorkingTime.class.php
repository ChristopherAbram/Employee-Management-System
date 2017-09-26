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

class WorkingTime extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO working_time($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'name'          => 'name'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}