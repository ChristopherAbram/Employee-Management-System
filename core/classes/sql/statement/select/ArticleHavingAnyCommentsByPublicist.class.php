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

class ArticleHavingAnyCommentsByPublicist extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT article.id FROM article INNER JOIN comment ON comment.article_id = article.id WHERE article.bin=0 AND article.user_id=:user_id ORDER BY article.cdate DESC LIMIT :offset, :count';
        
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