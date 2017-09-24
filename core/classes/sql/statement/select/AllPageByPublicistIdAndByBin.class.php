<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\sql\statement\select;

class AllPageByPublicistIdAndByBin extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT page.id AS `id` FROM user_page INNER JOIN page ON page.id = user_page.page_id WHERE user_page.user_id = :user_id AND page.bin = :bin';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'       => 'user_id',
            'bin'           => 'bin'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}