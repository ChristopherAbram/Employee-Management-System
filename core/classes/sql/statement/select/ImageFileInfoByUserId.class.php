<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.10.2016
 */

namespace core\classes\sql\statement\select;

class ImageFileInfoByUserId extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM file_info WHERE user_id = :id AND mime LIKE \'image/%\' LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'id'        => 'id',
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