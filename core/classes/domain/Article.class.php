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

class Article extends Domain {
    // vars {
        
        // User reference:
        protected $_User        = null;
        
        // Page reference:
        protected $_Pages       = null;
        
        // Comment set reference:
        protected $_Comments    = null;
        
        // File reference;
        protected $_File        = null;
        
        // Presentation data:
        protected $_presentation = array(
            'id'                => '', 
            'link'              => '', 
            'namepath'          => '', 
            'title'             => '', 
            'body'              => '', 
            'description'       => '', 
            'keywords'          => '',
            'ord'               => 0, 
            'bin'               => 0, 
            'hide'              => 0, 
            'mark'              => 0, 
            'cdate'             => '', 
            'edate'             => '',
            'user_id'           => '', 
            'vars'              => '',
            'comments_active'   => 1, 
            'file_id'           => '', 
            'vars'              => '',
            'visits'            => 0,
            'grade'             => 0,
            'grade_count'       => 0,
            'comments'          => 0,
            'picture'           => array(),
            'user'              => array(),
            'parents'           => array(),
        );
        
        protected $_count_visits = false;
        protected $_count_comments = false;
        protected $_count_grade = false;
        protected $_count_grade_count = false;
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\Article $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                }
                else {
                    parent::__construct($id);
                    try {
                        $article_factory = new \core\classes\data\factory\Article();
                        $this->_data = $article_factory->getById($id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new DomainException($ex->getMessage(), 0, $ex);
                    }
                }
                $this->_User = \core\classes\domain\factory\User::getConcreteByArticleId($this->_id);
                // Get picture reference:
                $file_factory = new \core\classes\domain\factory\File();
                $this->_File = $file_factory->getByArticleId($this->_id);
                $this->_Comments = new \core\classes\domain\collection\set\Comment();
            }// end __construct
            
            public function getUser(){
                return $this->_User;
            }// end getUser
            
            public function loadPages($pointer, $count){
                $page_factory = new \core\classes\domain\factory\Page();
                $this->_Pages = $page_factory->getByArticleId($this->getID(), $pointer, $count);
            }// end loadPages
            
            public function loadAvailablePages($pointer, $count){
                $page_factory = new \core\classes\domain\factory\Page();
                $this->_Pages = $page_factory->getAvailableByArticleId($this->getID(), $pointer, $count);
            }// end loadAvailablePages
            
            public function loadUnavailablePages($pointer, $count){
                $page_factory = new \core\classes\domain\factory\Page();
                $this->_Pages = $page_factory->getUnavailableByArticleId($this->getID(), $pointer, $count);
            }// end loadUnavailablePages
            
            public function loadVisiblePages($pointer, $count){
                $page_factory = new \core\classes\domain\factory\Page();
                $this->_Pages = $page_factory->getVisibleByArticleId($this->getID(), $pointer, $count);
            }// end loadVisiblePages
            
            public function getPages(){
                return $this->_Pages;
            }// end getPage
            
            public function getFile(){
                return $this->_File;
            }// end getFile
            
            public function getComments(){
                return $this->_Comments;
            }// end getComments
            
            public function loadComments(){
                
            }// end loadComments
            
            public function fileExists(){
                $data = $this->_data->getData();
                if(isset($data['file_id'])){
                    return $data['file_id'] >= 1;
                }
                return false;
            }// end fileExists
            
            public function loadFile(array $attribute){
                $attributes = new \core\classes\sql\attribute\AttributeList($attribute);
                if(!is_null($this->_File)){
                    return $this->_File->load($attributes);
                }
                return false;
            }// end loadFile
            
            public function isHidden(){
                $array = &$this->_data->getDataReference();
                if(isset($array['hide']) && ($array['hide'] == 1)){
                    return true;
                }
                return false;
            }// end isHidden
            
            public function isMarked(){
                $array = &$this->_data->getDataReference();
                if(isset($array['mark'])){
                    return $array['mark'] == 1;
                }
                return false;
            }// end isMarked
            
            public function isRemoved(){
                $array = &$this->_data->getDataReference();
                if(isset($array['bin']) && ($array['bin'] == 1)){
                    return true;
                }
                return false;
            }// end isRemoved
            
            public function visit(){
                try {
                    $session = \core\classes\session\Session::getInstance();
                    
                    // Get current user:
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User)){
                        return false;
                    }
                    
                    // Check if user already visited this article:
                    if(!isset($session['visit_article_'.$this->getID()])){
                        $visit = new \core\classes\data\ArticleVisit();
                        // Set data:
                        $data = array(
                            'article_id'        => $this->getID(),
                            'user_id'           => ($User instanceof \core\classes\domain\AuthorizedUser) ? $User->getID() : null,
                            'cdate'             => \date(\DATETIME)
                        );
                        $visit->setData($data);
                        // Do insert:
                        if($visit->create()){
                            $session['visit_article_'.$this->getID()] = 1;
                            return true;
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new DomainException(Error::get('note_visit'), 0, $ex);
                }
                return false;
            }// end visit
            
            public function setCountingVisits($flag){
                $this->_count_visits = $flag;
            }
            
            public function setCountingComments($flag){
                $this->_count_comments = $flag;
            }
            
            public function setCountingGrade($flag){
                $this->_count_grade = $flag;
            }
            
            public function setCountingGradeCount($flag){
                $this->_count_grade_count = $flag;
            }
            
            public function &getPresentationData(){
                $data = &$this->_data->getDataReference();
                if(isset($data['id'])) $this->_presentation['id'] = &$data['id'];
                if(isset($data['link'])) $this->_presentation['link'] = &$data['link'];
                if(isset($data['namepath'])) $this->_presentation['namepath'] = &$data['namepath'];
                if(isset($data['title'])) $this->_presentation['title'] = &$data['title'];
                if(isset($data['body'])) $this->_presentation['body'] = \core\functions\decode_content($data['body']);
                if(isset($data['description'])) $this->_presentation['description'] = \core\functions\decode_content($data['description']);
                if(isset($data['keywords'])) $this->_presentation['keywords'] = &$data['keywords'];
                if(isset($data['page_id'])) $this->_presentation['page_id'] = &$data['page_id'];
                if(isset($data['ord'])) $this->_presentation['ord'] = &$data['ord'];
                if(isset($data['bin'])) $this->_presentation['bin'] = &$data['bin'];
                if(isset($data['hide'])) $this->_presentation['hide'] = &$data['hide'];
                if(isset($data['mark'])) $this->_presentation['mark'] = &$data['mark'];
                if(isset($data['visits'])) $this->_presentation['visits'] = &$data['visits'];
                if(isset($data['cdate'])) $this->_presentation['cdate'] = &$data['cdate'];
                if(isset($data['edate'])) $this->_presentation['edate'] = &$data['edate'];
                if(isset($data['user_id'])) $this->_presentation['user_id'] = &$data['user_id'];
                if(isset($data['comments_active'])) $this->_presentation['comments_active'] = &$data['comments_active'];
                if(isset($data['file_id'])) $this->_presentation['file_id'] = &$data['file_id'];
                if(isset($data['vars'])) $this->_presentation['vars'] = &$data['vars'];
                
                if($this->_count_visits){
                    try {
                        $this->_presentation['visits'] = \core\classes\data\ArticleVisit::countByArticleId($this->getID());
                    } catch(\core\classes\data\DataException $ex){}
                }
                // Average grade:
                if($this->_count_grade){
                    try {
                        $this->_presentation['grade'] = \round(\core\classes\data\ArticleGrade::getAverageByArticleId($this->getID()), 1);
                    } catch(\core\classes\data\DataException $ex){}
                }
                
                if($this->_count_grade_count){
                    try {
                        $this->_presentation['grade_count'] = \core\classes\data\ArticleGrade::countByArticleId($this->getID());
                    } catch(\core\classes\data\DataException $ex){}
                }
                
                if($this->_count_comments){
                    try {
                        $this->_presentation['comments'] = \core\classes\data\Comment::countByHideAndByArticleId(0, $this->getID());
                    } catch(\core\classes\data\DataException $ex){}
                }
                
                // User data:
                if(!is_null($this->_User)){
                    $this->_presentation['user'] = &$this->_User->getPresentationData();
                }
                // Picture:
                if(!is_null($this->_File)){
                    $this->_presentation['picture'] = &$this->_File->getPresentationData();
                }
                // Parent page:
                if(!is_null($this->_Pages)){
                    foreach($this->_Pages as $Page){
                        $this->_presentation['parents'][$Page->getID()] = &$Page->getPresentationData(false);
                    }
                }
                return $this->_presentation;
            }// end getPresentationData
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}