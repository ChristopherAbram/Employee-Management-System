<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\sql\statement\select;

class PageByNamepath extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM page WHERE namepath = :namepath';
        
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