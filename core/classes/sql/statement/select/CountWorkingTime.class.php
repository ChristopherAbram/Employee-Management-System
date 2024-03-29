<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\sql\statement\select;

class CountWorkingTime extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(id) AS `count` FROM working_time';
        
        // Used parameters:
        protected $_requiredParams = array(
            
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}