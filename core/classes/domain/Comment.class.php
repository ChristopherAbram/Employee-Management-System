<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain;

class Comment extends Domain {
    // vars {
    
        // Article reference:
        protected $_Article         = null;
        
        // User reference:
        protected $_User            = null;
        
        // Presentation data:
        protected $_presentation    = array(
            'id'            => '', 
            'user_id'       => '', 
            'article_id'    => '', 
            'content'       => '', 
            'cdate'         => '',
            'hide'          => 0,
            'user'          => array(),
            'article'       => array()
        );
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\Comment $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                } 
                else {
                    parent::__construct($id);
                    try {
                        $comment_factory = new \core\classes\data\factory\Comment();
                        $this->_data = $comment_factory->getById($this->_id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new \core\classes\domain\DomainException($ex->getMessage());
                    }
                }
                $article_factory = new \core\classes\domain\factory\Article();
                $this->_Article = $article_factory->getByCommentId($this->_id);
                $this->_User = \core\classes\domain\factory\User::getConcreteByCommentId($this->_id);
            }// end __construct
            
            public function getArticle(){
                return $this->_Article;
            }// end getArticle
            
            public function getUser(){
                return $this->_User;
            }// end getUser
            
            public function &getPresentationData(){
                $data = &$this->_data->getDataReference();
                if(\array_key_exists('id', $data)) $this->_presentation['id'] = &$data['id'];
                if(\array_key_exists('user_id', $data)) $this->_presentation['user_id'] = &$data['user_id'];
                if(\array_key_exists('article_id', $data)) $this->_presentation['article_id'] = &$data['article_id'];
                if(\array_key_exists('content', $data)) $this->_presentation['content'] = &$data['content'];
                if(\array_key_exists('cdate', $data)) $this->_presentation['cdate'] = &$data['cdate'];
                if(\array_key_exists('hide', $data)) $this->_presentation['hide'] = &$data['hide'];
                // User role data:
                if(!is_null($this->_User)){
                    $this->_presentation['user'] = &$this->_User->getPresentationData();
                }
                if(!is_null($this->_Article)){
                    $this->_presentation['article'] = &$this->_Article->getPresentationData();
                }
                return $this->_presentation;
            }// end getPresentationData
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}