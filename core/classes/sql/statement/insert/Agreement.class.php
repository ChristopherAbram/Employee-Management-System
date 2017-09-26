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

class Agreement extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO agreement($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'              => 'user_id', 
            'department_id'        => 'department_id', 
            'responsibility_id'    => 'responsibility_id',
            'working_time_id'      => 'working_time_id', 
            'salary'               => 'salary', 
            'from_date'            => 'from_date', 
            'to_date'              => 'to_date',
            'description'          => 'description',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}