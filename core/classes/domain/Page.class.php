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

class Page extends Domain {
    // vars {
    
        // User reference:
        protected $_User            = null;
        
        // Parent Page reference:
        protected $_Parent          = null;
        
        // Child Page set:
        protected $_Childs          = null;
        
        // Article set:
        protected $_Articles        = null;
        
        // Presentation data:
        protected $_presentation    = array(
            'id'                => '', 
            'link'              => '', 
            'namepath'          => '', 
            'title'             => '', 
            'body'              => '', 
            'description'       => '', 
            'keywords'          => '',
            'page_id'           => '', 
            'ord'               => 0, 
            'bin'               => 0, 
            'hide'              => 0, 
            'mark'              => 0, 
            'cdate'             => '', 
            'edate'             => '',
            'user_id'           => '', 
            'vars'              => '',
            'visits'            => 0,
            'articles'          => 0,
            'user'              => array(
                
            ),
            'parent'            => array(
                
            ),
        );
        
        // Tree data array:
        protected $_pageTreeDataArray = array();
        
        protected $_count_visits = false;
        protected $_count_articles = false;
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\Page $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                }
                else {
                    parent::__construct($id);
                    try {
                        $page_factory = new \core\classes\data\factory\Page();
                        $this->_data = $page_factory->getById($id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new DomainException($ex->getMessage(), 0, $ex);
                    }
                }
                $this->_User = \core\classes\domain\factory\User::getConcreteByPageId($this->_id);
                $page_factory = new \core\classes\domain\factory\Page();
                $this->_Parent = $page_factory->getByChildPageId($this->_id);
                $this->_Childs = new \core\classes\domain\collection\set\Page();
                $this->_Articles = new \core\classes\domain\collection\set\Article();
            }// end __construct
            
            public function getUser(){
                return $this->_User;
            }// end getUser
            
            public function getParent(){
                return $this->_Parent;
            }// end getParent
            
            public function getChilds(){
                return $this->_Childs;
            }// end getChilds
            
            public function getArticles(){
                return $this->_Articles;
            }// end getArticles
            
            
            
            public function loadChilds($pointer, $count){
                $factory = new \core\classes\domain\factory\Page();
                $this->_Childs = $factory->getByParentPageId($this->getID(), $pointer, $count);
            }// end loadChilds
            
            public function loadAvailableChilds($pointer, $count){ // not removed
                $factory = new \core\classes\domain\factory\Page();
                $this->_Childs = $factory->getAvailableByParentPageId($this->getID(), $pointer, $count);
            }// end loadAvailableChilds
            
            public function loadUnavailableChilds($pointer, $count){ // removed
                $factory = new \core\classes\domain\factory\Page();
                $this->_Childs = $factory->getUnavailableByParentPageId($this->getID(), $pointer, $count);
            }// end loadUnavailableChilds
            
            public function loadVisibleChilds($pointer, $count){ // not hidden and not removed
                $factory = new \core\classes\domain\factory\Page();
                $this->_Childs = $factory->getVisibleByParentPageId($this->getID(), $pointer, $count);
            }// end loadVisibleChilds
            
            
            
            public function loadArticles($pointer, $count){
                $factory = new \core\classes\domain\factory\Article();
                $this->_Articles = $factory->getByPageId($this->getID(), $pointer, $count);
            }// end loadArticles
            
            public function loadAvailableArticles($pointer, $count){
                $factory = new \core\classes\domain\factory\Article();
                $this->_Articles = $factory->getAvailableByPageId($this->getID(), $pointer, $count);
            }// end loadAvailableArticles
            
            public function loadUnavailableArticles($pointer, $count){
                $factory = new \core\classes\domain\factory\Article();
                $this->_Articles = $factory->getUnavailableByPageId($this->getID(), $pointer, $count);
            }// end loadUnavailableArticles
            
            public function loadVisibleArticles($pointer, $count){
                $factory = new \core\classes\domain\factory\Article();
                $this->_Articles = $factory->getVisibleByPageId($this->getID(), $pointer, $count);
            }// end loadVisibleArticles
            
            
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
                    return ($array['mark'] == 1);
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
                    
                    // Check if user already visited this page:
                    if(!isset($session['visit_page_'.$this->getID()])){
                        $visit = new \core\classes\data\PageVisit();
                        // Set data:
                        $data = array(
                            'page_id'           => $this->getID(),
                            'user_id'           => ($User instanceof \core\classes\domain\AuthorizedUser) ? $User->getID() : null,
                            'cdate'             => \date(\DATETIME)
                        );
                        $visit->setData($data);
                        // Do insert:
                        if($visit->create()){
                            $session['visit_page_'.$this->getID()] = 1;
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
            
            public function setCountingArticles($flag){
                $this->_count_articles = $flag;
            }
            
            public function &getPresentationData($body = false){
                $data = &$this->_data->getDataReference();
                if(isset($data['id'])) $this->_presentation['id'] = &$data['id'];
                if(isset($data['link'])) $this->_presentation['link'] = &$data['link'];
                if(isset($data['namepath'])) $this->_presentation['namepath'] = &$data['namepath'];
                if(isset($data['title'])) $this->_presentation['title'] = &$data['title'];
                if($body && isset($data['body'])) $this->_presentation['body'] = \core\functions\decode_content($data['body']);
                if(isset($data['description'])) $this->_presentation['description'] = \core\functions\decode_content($data['description']);
                if(isset($data['keywords'])) $this->_presentation['keywords'] = &$data['keywords'];
                if(isset($data['page_id'])) $this->_presentation['page_id'] = &$data['page_id'];
                if(isset($data['ord'])) $this->_presentation['ord'] = &$data['ord'];
                if(isset($data['bin'])) $this->_presentation['bin'] = &$data['bin'];
                if(isset($data['hide'])) $this->_presentation['hide'] = &$data['hide'];
                if(isset($data['mark'])) $this->_presentation['mark'] = &$data['mark'];
                if(isset($data['cdate'])) $this->_presentation['cdate'] = &$data['cdate'];
                if(isset($data['edate'])) $this->_presentation['edate'] = &$data['edate'];
                if(isset($data['user_id'])) $this->_presentation['user_id'] = &$data['user_id'];
                if(isset($data['vars'])) $this->_presentation['vars'] = &$data['vars'];
                
                if($this->_count_visits){
                    try {
                        $this->_presentation['visits'] = \core\classes\data\PageVisit::countByPageId($this->getID());
                    } catch(\core\classes\data\DataException $ex){}
                }
                
                if($this->_count_articles){
                    try {
                        $this->_presentation['articles'] = \core\classes\data\Article::countNotRemovedAndNotHiddenByPageId($this->getID());
                    } catch(\core\classes\data\DataException $ex){}
                }
                
                // User data:
                if(!is_null($this->_User)){
                    $this->_presentation['user'] = &$this->_User->getPresentationData();
                }
                // Parent page:
                if(!is_null($this->_Parent)){
                    $this->_presentation['parent'] = &$this->_Parent->getPresentationData();
                }
                return $this->_presentation;
            }// end getPresentationData
            
            public function getAncestorsData(array $attributes = array()){
                $array = array();
                $page = $this->getParent();
                while(!is_null($page) && $page->getID() != 1){
                    if(!empty($attributes) && $page->load(new \core\classes\sql\attribute\AttributeList($attributes))){
                        $array[] = &$page->getPresentationData();
                    }
                    else {
                        $array[] = &$page->getPresentationData();
                    }
                    $page = $page->getParent();
                }
                $array = \array_reverse($array);
                return $array;
            }// end getAncestorsData
            
            public function tree($levels = 1000, $count = 1000){
                if($levels == 0){
                    return;
                }
                $this->loadChilds(1, $count);
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        $child->tree($levels - 1, $count);
                    }
                }
                return;
            }// end tree
            
            public function availableTree($levels = 1000, $count = 1000){
                if($levels == 0){
                    return;
                }
                $this->loadAvailableChilds(1, $count);
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        $child->availableTree($levels - 1, $count);
                    }
                }
                return;
            }// end availableTree
            
            public function unavailableTree($levels = 1000, $count = 1000){
                if($levels == 0){
                    return;
                }
                $this->loadUnvailableChilds(1, $count);
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        $child->unavailableTree($levels - 1, $count);
                    }
                }
                return;
            }// end unavailableTree
            
            public function visibleTree($levels = 1000, $count = 1000){
                if($levels == 0){
                    return;
                }
                $this->loadVisibleChilds(1, $count);
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        $child->visibleTree($levels - 1, $count);
                    }
                }
                return;
            }// end visibleTree
            
            public function &getPageTreeAsDataArray(){
                $this->_pageTreeDataArray = &$this->getPresentationData();
                if(!empty($this->_pageTreeDataArray)){
                    $childs = $this->getChilds();
                    $this->_pageTreeDataArray['children'] = array();
                    if(!is_null($childs)){
                        foreach($childs as $child){
                            $this->_pageTreeDataArray['children'][] = &$child->getPageTreeAsDataArray();
                        }
                    }
                }
                return $this->_pageTreeDataArray;
            }// end getPageTreeAsDataArray
            
            public function accept($visitor){
                if($visitor instanceof \core\classes\visitor\Visitor){
                    return $visitor->visit($this);
                }
                else if(\is_callable($visitor)){
                    return \call_user_func($visitor, $this);
                }
                return;
            }// end accept
            
            public function filter($visitor){
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        if(!$child->filter($visitor)){
                            $children->detach($child);
                        }
                    }
                }
                if($visitor instanceof \core\classes\visitor\Visitor){
                    return $visitor->visit($this);
                }
                else if(\is_callable($visitor)){
                    return \call_user_func($visitor, $this);
                }
                return true;
            }// end filter
            
            public function acceptTree($visitor){
                $this->accept($visitor);
                $children = $this->getChilds();
                if(!is_null($children)){
                    foreach($children as $child){
                        $child->acceptTree($visitor);
                    }
                }
            }// end acceptTree
            
            public function acceptBranch($visitor){
                $this->accept($visitor);
                $parent = $this->getParent();
                if(!is_null($parent)){
                    $parent->acceptBranch($visitor);
                }
            }// end acceptBranch
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}