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

class RestoreAllArticles extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE article SET bin = 0 WHERE bin = 1';
        
        // Used set parameters:
        protected $_setParameters = array(
            
        );
        
        // Other parameters:
        protected $_requiredParams = array(
            
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}