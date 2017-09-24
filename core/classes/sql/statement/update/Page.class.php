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

class Page extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE page SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
            'link'          => 'link',
            'namepath'      => 'namepath',
            'title'         => 'title',
            'body'          => 'body',
            'description'   => 'description',
            'keywords'      => 'keywords',
            'parent'        => 'page_id',
            'ord'           => 'ord',
            'bin'           => 'bin',
            'hide'          => 'hide',
            'mark'          => 'mark',
            'cdate'         => 'cdate',
            'edate'         => 'edate',
            'uid'           => 'user_id',
            'vars'          => 'vars',
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