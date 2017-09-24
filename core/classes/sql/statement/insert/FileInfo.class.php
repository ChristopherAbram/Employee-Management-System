<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\sql\statement\insert;

class FileInfo extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO file_info($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'name'              => 'name',
            'description'       => 'description',
            'size'              => 'size',
            'mtime'             => 'mtime',
            'cdate'             => 'cdate',
            'mime'              => 'mime',
            'read'              => 'read',
            'write'             => 'write',
            'locked'            => 'locked',
            'hide'              => 'hide',
            'bin'               => 'bin',
            'width'             => 'width',
            'height'            => 'height',
            'ext'               => 'extension',
            'owner'             => 'user_id',
        );  
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}