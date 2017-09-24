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

class FileMiniatureByFileInfoId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM file_miniature WHERE file_info_id = :id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}