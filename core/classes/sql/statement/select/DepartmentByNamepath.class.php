<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\sql\statement\select;

class DepartmentByNamepath extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM department WHERE namepath = :namepath';
        
        // Used parameters:
        protected $_requiredParams = array(
            'namepath'        => 'namepath',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}