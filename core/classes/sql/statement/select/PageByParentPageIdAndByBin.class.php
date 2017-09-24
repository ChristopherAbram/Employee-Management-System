<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\sql\statement\select;

class PageByParentPageIdAndByBin extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM page WHERE page_id = :id AND bin = :bin ORDER BY ord ASC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
            'bin'       => 'bin',
            'offset'    => 'offset',
            'count'     => 'count'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}