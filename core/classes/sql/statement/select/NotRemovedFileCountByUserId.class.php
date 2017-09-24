<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.09.2016
 */

namespace core\classes\sql\statement\select;

class NotRemovedFileCountByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(id) AS `count` FROM file_info WHERE user_id = :id AND bin = 0';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}