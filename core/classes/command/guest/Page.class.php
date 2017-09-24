<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest
 * @author     Christopher Abram
 * @version    1.0
 * @date	25.09.2016
 */

namespace core\classes\command\guest;

class Page extends Command {
    // vars {
        
        // Results per page: 
        private $__page         = 1;
        private $__count        = 0;
        private $__countperpage = 8;
        
        private $__list         = array();
        
        private $__request      = null;
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                if($status == self::CMD_ERROR){
                    return array(
                        \core\functions\status(404)
                    );
                }
                return array(
                    'ContentType: text/html; encoding=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    'page.style.css'
                );
            }// end _styles
            
            protected function _execute(\core\classes\request\Request $request){
                // Quit if there is no page namepath:
                if(!isset($request['namepath'])){
                    return self::CMD_ERROR;
                }
                $this->__request = $request;
                
                // Retrieve page namepath:
                $namepath = $request['namepath'];
                
                // Get page by namepath:
                $Page = $this->__get_page_by_namepath($namepath);
                if(is_null($Page)){
                    return self::CMD_ERROR;
                }
                
                // Load all of the page data:
                if(!$this->__load_page($Page)){
                    return self::CMD_ERROR;
                }
                
                // Quit if page is hidden or removed:
                if($Page->isHidden() or $Page->isRemoved()){
                    return self::CMD_ERROR;
                }
                
                // Note visit:
                try {
                    $Page->visit();
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
                
                // Get page data as array:
                $data = &$Page->getPresentationData(true);
                
                // Ancestors information:
                $ancestors = $Page->getAncestorsData();
                $ancestors = $this->__get_ancestors($ancestors);
                if(isset($data['title'], $data['namepath'])){
                    $ancestors[$data['title']] = \core\functions\address().'/page/'.$data['namepath'];
                }
                
                // Count all available articles associated with this page:
                $this->__count_articles($Page->getID());
                
                // Retrieve a pointer (current page):
                $this->__page();
                
                // Page exists?:
                if($this->__pages_count() < $this->__page){
                    return self::CMD_ERROR;
                }
                
                // Load Articles:
                $this->__load_articles($Page, $this->__page);
                
                // Extracting article list:
                $this->__get_data_list($Page);
                
                /*echo '<pre>';
                print_r($this->__list);
                echo '</pre>';
                die();*/
                
                // Assignments:
                $this->assignAll(array(
                    // General:
                    'title'             => isset($data['title']) ? $data['title'] : '',
                    'ancestors'         => $ancestors,
                    'last_modified'     => Text::get('last_modified'),
                    'visits'            => Text::get('visits'),
                    'keywords'          => isset($data['keywords']) ? $data['keywords'] : '',
                    'author'            => isset($data['user'], $data['user']['firstname'], $data['user']['lastname']) ? $data['user']['firstname'].' '.$data['user']['lastname'] : '',
                    'meta_description'  => isset($data['description']) ? \strip_tags($data['description']) : '',
                    
                    // Page:
                    'page'              => &$data,
                    
                    // The list:
                    'list'              => &$this->__list,
                    'result_switcher'   => \core\functions\result_page_switcher($this->__page, $this->__pages_count(), \core\functions\address().'/page/'.$namepath, 8)
                ));
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            private function __get_page_by_namepath($namepath){
                try {
                    $factory = new \core\classes\domain\factory\Page();
                    $Page = $factory->getByNamepath($namepath);
                    return $Page;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end __get_page_by_namepath
            
            private function __load_page(\core\classes\domain\Page $Page){
                try {
                    $Page->setCountingVisits(true);
                    $Page->setCountingArticles(true);
                    
                    $data = $Page->getData();
                    if(is_null($data)){
                        return false;
                    }
                    // Load branch data:
                    $visitor = new \core\classes\visitor\PageLoader();
                    $visitor->attributes(array('id', 'title', 'namepath'));
                    $Page->acceptBranch($visitor);
                    // Load all data:
                    $q = false;
                    $p = $Page->load($data->getAllAttributeList());
                    // Load user data:
                    $User = $Page->getUser();
                    if(!is_null($User)){
                        $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'profile'));
                        $q = $User->load($attributes);
                        $User->loadAvatar();
                    }
                    return $p && $q;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end __load_page
            
            private function __get_ancestors(array $array){
                $ancestors = array();
                foreach($array as $data){
                    if(isset($data['title'], $data['namepath'])){
                        $ancestors[$data['title']] = \core\functions\address().'/page/'.$data['namepath'];
                    }
                }
                return $ancestors;
            }// end __get_ancestors
            
            private function __load_articles(\core\classes\domain\Page $Page, $pointer){
                try {
                    $Page->loadVisibleArticles($pointer, $this->__countperpage);
                    $set = $Page->getArticles();
                    if(!is_null($set)){
                        $attributes = new \core\classes\sql\attribute\AttributeList(array(
                            'id', 'title', 'namepath', 'link', 'description', 'mark', 'cdate', 'edate', 'user_id'
                        ));
                        $set->load($attributes);
                        // Load image for each article:
                        $set->accept(function($Article){
                            $File = $Article->getFile();
                            if(!is_null($File)){
                                $File->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name', 'extension'
                                )));
                            }
                            $User = $Article->getUser();
                            if(!is_null($User)){
                                $User->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'firstname', 'lastname', 'user_role_id', 'avatar', 'profile'
                                )));
                                $User->loadUserRole();
                                $Avatar = $User->getAvatar();
                                if(!is_null($Avatar)){
                                    $Avatar->load(new \core\classes\sql\attribute\AttributeList(array(
                                        'id', 'name', 'extension'
                                    )));
                                }
                            }
                        });
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end __load_articles
            
            private function __count_articles($id){
                try {
                    $count = \core\classes\data\Article::countNotRemovedAndNotHiddenByPageId($id);
                    if(!is_null($count)){
                        $this->__count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __count_articles
            
            private function __page(){
                $request = $this->__request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page) /*&& \preg_match('/^'.REGEX_INT_UNSIGNED.'$/i', $page)*/){
                        $this->__page = (int)$page;
                    }
                }
            }// end __page
            
            private function __pages_count(){
                if($this->__count != 0){
                    $count = (int)\ceil((float)$this->__count / ((float)$this->__countperpage));
                    return $count;
                }
                return 1;
            }// end __pages_count
            
            private function __get_data_list(\core\classes\domain\Page $Page){
                try {
                    $set = $Page->getArticles();
                    if(!is_null($set)){
                        foreach($set as $Article){
                            $this->__list[$Article->getID()] = &$Article->getPresentationData();
                        }
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end __get_data_list
            
        // }
    // }
}