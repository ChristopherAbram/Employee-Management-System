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

class RemoveMovedArticles extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'DELETE FROM article WHERE bin = 1';
        
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