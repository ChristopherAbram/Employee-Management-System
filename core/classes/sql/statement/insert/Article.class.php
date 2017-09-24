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

class Article extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO article($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'link'          => 'link',
            'namepath'      => 'namepath',
            'title'         => 'title',
            'body'          => 'body',
            'description'   => 'description',
            'keywords'      => 'keywords',
            'ord'           => 'ord',
            'bin'           => 'bin',
            'hide'          => 'hide',
            'mark'          => 'mark',
            'cdate'         => 'cdate',
            'edate'         => 'edate',
            'uid'           => 'user_id',
            'ca'            => 'comments_active',
            'file_id'       => 'file_id',
            'vars'          => 'vars',
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}