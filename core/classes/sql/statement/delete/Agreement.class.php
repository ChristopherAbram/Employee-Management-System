<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\delete
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\delete;

class Agreement extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'DELETE FROM agreement WHERE id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'            => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}