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

class RestoreAllFilesByUserId extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE file_info SET bin = 0 WHERE user_id = :id AND bin = 1';
        
        // Used set parameters:
        protected $_setParameters = array(
            
        );
        
        // Other parameters:
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