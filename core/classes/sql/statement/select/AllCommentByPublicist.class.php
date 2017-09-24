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

class AllCommentByPublicist extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT comment.id FROM comment INNER JOIN article ON article.id=comment.article_id WHERE article.bin=0 AND article.user_id=:user_id ORDER BY comment.cdate DESC LIMIT :offset, :count';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'   => 'user_id',
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