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

namespace core\classes\command\panel\publicist;

class Comments extends Command {
    // vars {
        
        // Results per page: 
        protected $_page          = 1;
        protected $_count         = 0;
        protected $_countperpage  = 50;
        
        protected $_list        = array();
        protected $_article_data   = array();
    
        // Form fields:
        private $__form         = null;
        // Buttons:
        private $__hide         = null;
        private $__unhide       = null;
        private $__remove       = null;
    
    // } methods {
    
        // public {
            
            public function _bin(){
                // Page factory:
                $factory = new \core\classes\data\factory\Comment();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('comment');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $comment = $factory->getById($id);
                    if(!is_null($comment)){
                        return $comment->delete();
                    }
                    return false;
                });
            }
            
            public function _hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Comment();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('comment');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $comment = $factory->getById($id);
                    if(!is_null($comment)){
                        return $comment->hide();
                    }
                    return false;
                });
            }
            
            public function _show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Comment();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('comment');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $comment = $factory->getById($id);
                    if(!is_null($comment)){
                        return $comment->show();
                    }
                    return false;
                });
            }
            
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
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form:
                $form = new \core\classes\form\Form('comment_list');
                $this->__form = $form;
                
                // Buttons:
                $hide = $this->__hide();
                $unhide = $this->__unhide();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($hide);
                $form->attach($unhide);
                $form->attach($remove);
                
                // Button functions:
                $hide->onsubmit(array($this, '_hide'));
                $unhide->onsubmit(array($this, '_show'));
                $remove->onsubmit(array($this, '_bin'));
                
                // List buttons:
                $this->_onclick_hide();
                $this->_onclick_show();
                
                $this->assign('title', 'Comment management list');
                
                // Namepath (category) active?:
                if(isset($request['article'])){
                    
                    // Create page:
                    $namepath = $request['article'];
                    $article = $this->_get_article_by_namepath($namepath);
                    if(is_null($article)){
                        return self::CMD_ERROR;
                    }
                    
                    // Count comments associated with concrete article;
                    $this->_count_comments_by_article($article);
                    
                    // Retrieve a pointer (current page):
                    $this->_page();
                    
                    // Page exists?:
                    if($this->_pages_count() < $this->_page){
                        return self::CMD_ERROR;
                    }
                    
                    // Extracting article list:
                    $this->_comment_list_by_article($article, $this->_page);
                    
                    // Assignments:
                    $this->assignAll(array(
                        
                        // Article list
                        'comments'          => &$this->_list,
                        'page_number'       => $this->_page,
                        
                        // Page namepath:
                        'category'          => $namepath,
                        'article'           => $this->_article_data,
                        
                        // Toolbar:
                        'toolbar_left'      => !empty($this->_list) ? array($hide) : array(),
                        'toolbar_right'     => !empty($this->_list) ? array($unhide, $remove, $this->_switch($namepath)) : array($this->_switch($namepath)),

                    ));
                    return self::CMD_OK;
                }
                
                // Category not selected:
                else {
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
                    
                    /*echo '<pre>';
                    print_r($this->_list);
                    echo '</pre>';*/
                    
                    // Assignments:
                    $this->assignAll(array(
                        
                        // Article list
                        'comments'         => &$this->_list,
                        'page_number'      => $this->_page,
                        
                        // Toolbar:
                        'toolbar_left'      => !empty($this->_list) ? array($hide) : array(),
                        'toolbar_right'     => !empty($this->_list) ? array($unhide, $remove, $this->_switch()) : array($this->_switch()),

                    ));
                    return self::CMD_DEFAULT;
                }
                
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
                return \core\classes\data\Comment::countByPublicist($User->getID());
            }// end _get_count
            
            protected function _get_count_by_article($id){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return null;
                }
                return \core\classes\data\Comment::countByArticleIdAndByPublicist($id, $User->getID());
            }// end _get_count
            
            protected function _count_comments_by_article(\core\classes\data\Article $article){
                try {
                    $count = $this->_get_count_by_article($article->getID());
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
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
            
            protected function _get_article_by_namepath($namepath){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $article = $factory->getByNamepath($namepath);
                    
                    $Article = new \core\classes\domain\Article(null, $article);
                    if($Article->load(new \core\classes\sql\attribute\AttributeList(array('id', 'title', 'namepath')))){
                        $this->_article_data = &$Article->getPresentationData(false);
                        return $article;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end _get_page_by_namepath
            
            protected function _modify($column, $value){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                if(isset($this->__request['article'])){
                    $article_list = $this->__request['article'];
                    
                    foreach($article_list as $id => $val){
                        $article = $factory->getById($id);
                        if(!is_null($article)){
                            $article->setAttributeList($attributes);
                            $data = $article->getData();
                            // Change data:
                            $data[$column] = $value;
                            $article->setData($data);
                        }
                    }
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                }
            }// end _modify
            
            protected function _onclick_hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Comment();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('hide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $comment = $factory->getById($id);
                    if(!is_null($comment)){
                        return $comment->hide();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _onclick_show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Comment();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('unhide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $comment = $factory->getById($id);
                    if(!is_null($comment)){
                        return $comment->show();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _get_list($pointer){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return null;
                }
                $factory = new \core\classes\data\factory\Comment();
                return $factory->getByPublicist($User->getID(), $pointer, $this->_countperpage);
            }// end _get_list
            
            protected function _get_list_by_article($id, $pointer){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return null;
                }
                $factory = new \core\classes\data\factory\Comment();
                return $factory->getByArticleIdAndByPublicist($id, $User->getID(), $pointer, $this->_countperpage);
            }// end _get_list_by_article
            
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
            
            protected function _comment_list_by_article(\core\classes\data\Article $article, $pointer){
                try {
                    $set = $this->_get_list_by_article($article->getID(), $pointer);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Comment(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _comment_list_by_article
            
            protected function _switch($namepath = ''){
                $all = $this->_pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->_page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/comments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/comments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // } private {
            
            private function __hide(){
                $f = new \core\classes\form\field\Submit('hide_button');
                $f->value('Hide');
                $this->__hide = $f;
                return $f;
            }// end __hide
            
            private function __unhide(){
                $f = new \core\classes\form\field\Submit('unhide_button');
                $f->value('Unhide');
                $this->__unhide = $f;
                return $f;
            }// end __unhide
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}