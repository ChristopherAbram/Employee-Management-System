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

class ArticleByBinAndByHideWithSliderImage extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT article.id FROM article INNER JOIN file_info ON article.file_id = file_info.id WHERE article.bin=:bin AND article.hide=:hide AND file_info.bin=0 AND file_info.hide=0 AND file_info.mime LIKE \'image%\' AND file_info.width >= :width AND file_info.height >= :height ORDER BY article.cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'bin'       => 'bin',
            'hide'      => 'hide',
            'width'     => 'width',
            'height'    => 'height',
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