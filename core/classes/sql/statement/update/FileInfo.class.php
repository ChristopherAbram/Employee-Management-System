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

class FileInfo extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE file_info SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
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
        
        // Other parameters:
        protected $_requiredParams = array(
            'identifier'    => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}