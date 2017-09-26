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

class Agreement extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE agreement SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
            'user_id'              => 'user_id', 
            'department_id'        => 'department_id', 
            'responsibility_id'    => 'responsibility_id',
            'working_time_id'      => 'working_time_id', 
            'salary'               => 'salary', 
            'from_date'            => 'from_date', 
            'to_date'              => 'to_date',
            'description'          => 'description',
        );
        
        // Other parameters:
        protected $_requiredParams = array(
            'identifier'    => 'id'
        );
        
    // } methods {
    
        // public 
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}