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

class MoveArticleToBin extends Statement {
    // vars {
        
        // Delete query:
        protected $_query = 'CALL move_article_to_bin(:id)';
        
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