<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.09.2016
 */

namespace core\classes\sql\statement\select;

class FileInfoByArticleId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT file_id FROM article WHERE id = :id';
        
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