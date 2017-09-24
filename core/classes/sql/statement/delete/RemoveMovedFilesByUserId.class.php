<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\delete
 * @author     Christopher Abram
 * @version    1.0
 * @date	07.10.2016
 */

namespace core\classes\sql\statement\delete;

class RemoveMovedFilesByUserId extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'DELETE FROM file_info WHERE user_id = :id AND bin = 1';
        
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