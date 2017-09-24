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

class ArticleList extends Command {
    // vars {
        
        // Results per page: 
        private $__page         = 1;
        private $__count        = 0;
        private $__countperpage = 9;
        
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
                $this->__request = $request;
                // Count all available articles:
                $this->__count_articles();
                // Retrieve a pointer (current page):
                $this->__page();
                // Page exists?:
                if($this->__pages_count() < $this->__page){
                    return self::CMD_ERROR;
                }
                // Extracting article list:
                $list = $this->__get_data_list($this->__page);
                
                // Assignments:
                $this->assignAll(array(
                    // General:
                    'title'             => Text::get('article_list_title'),
                    'ancestors'         => array(
                        Text::get('articles_list') => \core\functions\address().'/articles',
                        Text::get('result_page').' '.$this->__page    => \core\functions\address().'/articles/'.$this->__page,
                    ),
                    
                    // The list:
                    'list'              => $list,
                    'result_switcher'   => \core\functions\result_page_switcher($this->__page, $this->__pages_count(), \core\functions\address().'/articles', 8)
                ));
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            private function __count_articles(){
                try {
                    $count = \core\classes\data\Article::countNotRemovedAndNotHidden();
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
            
            private function __get_data_list($pointer){
                $array = array();
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getAllSortedByCdateNotHiddenAndNotRemoved($pointer, $this->__countperpage);
                    if(!is_null($set)){
                        $this->__get_data($set, $array);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
                return $array;
            }// end __get_data_list
            
            private function __get_data(\core\classes\data\collection\set\Article $set, &$array){
                $set->accept(function($article){
                    $attributes = new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'title', 'namepath', 'description', 'hide', 'mark', 'cdate', 'edate', 'user_id'
                        ));
                    $article->setAttributeList($attributes);
                    return $article->read();
                });
                $factory = new \core\classes\data\factory\User();
                foreach($set as $article){
                    $Article = new \core\classes\domain\Article(null, $article);
                    $User = $Article->getUser();
                    if(!is_null($User)){
                        $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname')));
                    }
                    $array[$article->getID()] = $Article->getPresentationData();
                }
            }// end __get_data
            
        // }
    // }
}