<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\command\panel\publicist;

class ArticleComments extends Command {
    // vars {
        
        // Results per page: 
        protected $_page         = 1;
        protected $_count        = 0;
        protected $_countperpage = 15;
        
        // Page list:
        protected $_list        = array();
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_OK){
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
                    'panel/itemlist.style.css',
                    'panel/switchpage.style.css',
                    'panel/articlecategories.style.css'
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Count all articles having any comments associated:
                $this->_count();
                
                // Retrieve a pointer (current page):
                $this->_page();
                
                // Page exists?:
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }
                
                // Extracting page list:
                $this->_article_list($this->_page);
               
                // Assignments:
                $this->assignAll(array(
                    
                    'title'             => 'Choose article',
                    
                    // Page list:
                    'articles'          => &$this->_list,
                    
                    // Toolbar:
                    'toolbar_left'      => array(),
                    'toolbar_right'     => array($this->_switch()),
                    
                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count(){
                try {
                    $count = $this->_get_count();
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __count
            
            protected function _page(){
                $request = $this->_request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page) /*&& \preg_match('/^'.REGEX_INT_UNSIGNED.'$/i', $page)*/){
                        $this->_page = (int)$page;
                    }
                }
            }// end __page
            
            protected function _pages_count(){
                if($this->_count != 0){
                    $count = (int)\ceil((float)$this->_count / ((float)$this->_countperpage));
                    return $count;
                }
                return 1;
            }// end __pages_count
            
            protected function _article_list($pointer){
                try {
                    $set = $this->_get_list($pointer);
                    if(!is_null($set)){
                        
                        $set->accept(function($article){
                            $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'title', 'namepath'));
                            $article->setAttributeList($attributes);
                            return $article->read();
                        });
                        
                        foreach($set as $article){
                            $data = $article->getData();
                            if(!is_null($data)){
                                $Article = new \core\classes\domain\Article(null, $article);
                                $this->_list[$article->getID()] = &$Article->getPresentationData(false);
                                $this->_list[$article->getID()]['comments_count'] = \core\classes\data\Comment::countByArticleId($article->getID());
                            }
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end __article_list
            
            protected function _get_count(){
                $User = \PanelRegistry::getCurrentUser();
                if(is_null($User)){
                    return;
                }
                return \core\classes\data\Article::countHavingAnyCommentsByPublicist($User->getID());
            }// end _get_count
            
            protected function _get_list($pointer){
                $factory = new \core\classes\data\factory\Article();
                $User = \PanelRegistry::getCurrentUser();
                if(is_null($User)){
                    return;
                }
                return $factory->getHavingAnyCommentsByPublicist($User->getID(), $pointer, $this->_countperpage);
            }// end _get_list
            
            protected function _switch(){
                $all = $this->_pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->_page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/articlecomments/'.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/articlecomments/'.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch
            
        // } private {
            
            
            
        // }
    // }
}