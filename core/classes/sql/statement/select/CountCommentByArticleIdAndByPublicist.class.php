<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\sql\statement\select;

class CountCommentByArticleIdAndByPublicist extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT COUNT(DISTINCT comment.id) AS `count` FROM comment INNER JOIN article ON article.id=comment.article_id WHERE article_id = :article_id AND article.user_id=:user_id';
        
        // Used parameters:
        protected $_requiredParams = array(
            'user_id'       => 'user_id',
            'article_id'    => 'article_id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}