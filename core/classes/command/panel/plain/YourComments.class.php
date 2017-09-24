<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\plain;

class YourComments extends Command {
    // vars {
        
        // Results per page: 
        protected $_page          = 1;
        protected $_count         = 0;
        protected $_countperpage  = 20;
        
        protected $_list        = array();
        protected $_article_data   = array();
    
        // Form fields:
        private $__form         = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_DEFAULT || $status == self::CMD_OK){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(200)
                    );
                }
                else if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/commentlist.style.css',
                    'panel/usercommentlist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form:
                $form = new \core\classes\form\Form('comment_list');
                $this->__form = $form;
                
                // Count all comments:
                $this->_count_all_comments();

                // Retrieve a pointer (current page):
                $this->_page();

                // Page exists?:
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting comments list:
                $this->_comment_list($this->_page);

                // Assignments:
                $this->assignAll(array(
                    'title'            => 'Your comments',
                    // Article list
                    'comments'         => &$this->_list,
                    'page_number'      => $this->_page,

                    // Toolbar:
                    'toolbar_left'      => array(),
                    'toolbar_right'     => array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_all_comments(){
                try {
                    $count = $this->_get_count();
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _get_count(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return null;
                }
                return \core\classes\data\Comment::countVisibleByUserId($User->getID());
            }// end _get_count
            
            protected function _page(){
                $request = $this->_request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page) /*&& \preg_match('/^'.REGEX_INT_UNSIGNED.'$/i', $page)*/){
                        $this->_page = (int)$page;
                    }
                }
            }// end _page
            
            protected function _pages_count(){
                if($this->_count != 0){
                    $count = (int)\ceil((float)$this->_count / ((float)$this->_countperpage));
                    return $count;
                }
                return 1;
            }// end _pages_count
            
            protected function _get_list($pointer){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return null;
                }
                $factory = new \core\classes\data\factory\Comment();
                return $factory->getVisibleByUserId($User->getID(), $pointer, $this->_countperpage);
            }// end _get_list
            
            protected function _comment_list($pointer){
                try {
                    $set = $this->_get_list($pointer);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Comment(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list
            
            protected function _get_data(\core\classes\domain\collection\set\Comment $set){
                try {
                    // Load comment data:
                    $set->load();
                    
                    // Load additional data:
                    $set->accept(function($Comment){
                        
                        $User = $Comment->getUser();
                        if(!is_null($User)){
                            $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname')));
                        }
                        $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension'));
                        $Avatar = $User->getAvatar();
                        if(!is_null($Avatar)){
                            $Avatar->load($attributes);
                        }
                        $Article = $Comment->getArticle();
                        if(!is_null($Article)){
                            $Article->load(new \core\classes\sql\attribute\AttributeList(array('id', 'namepath', 'title')));
                        }
                        return true;
                    });
                    
                    // Extract data:
                    foreach($set as $Comment){
                        $this->_list[$Comment->getID()] = &$Comment->getPresentationData();
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _get_data
            
            protected function _switch($namepath = ''){
                $all = $this->_pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->_page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/yourcomments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/yourcomments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // } private {
            
            
            
        // }
    // }
}