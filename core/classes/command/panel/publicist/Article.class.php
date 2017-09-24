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

class Article extends Command {
    // vars {
        
        // Results per page: 
        protected $_page          = 1;
        protected $_count         = 0;
        protected $_countperpage  = 10;
        
        protected $_list        = array();
        protected $_page_data   = array();
    
        // Form fields:
        private $__form         = null;
        // Buttons:
        private $__hide         = null;
        private $__unhide       = null;
        private $__mark         = null;
        private $__unmark       = null;
        private $__remove       = null;
        private $__save         = null;
    
    // } methods {
    
        // public {
            
            public function _bin(){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('article');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->bin();
                    }
                    return false;
                });
            }
            
            public function _hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('article');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->hide();
                    }
                    return false;
                });
            }
            
            public function _show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('article');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->show();
                    }
                    return false;
                });
            }
            
            public function _mark(){
                $this->_modify('mark', 1);
            }// end _mark
            
            public function _unmark(){
                $this->_modify('mark', 0);
            }// end _unmark
            
            public function _save(){
                // Article factory:
                $factory = new \core\classes\data\factory\Article();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'ord'));
                
                if(isset($this->__request['ord'])){
                    $article_list = $this->__request['ord'];
                    
                    foreach($article_list as $id => $value){
                        $article = $factory->getById($id);
                        if(!is_null($article)){
                            $article->setAttributeList($attributes);
                            $data = $article->getData();
                            // Change data:
                            $data['ord'] = $value;
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
            }// end _save
            
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
                    'panel/articlelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form:
                $form = new \core\classes\form\Form('article_list');
                $this->__form = $form;
                
                // Buttons:
                $hide = $this->__hide();
                $unhide = $this->__unhide();
                $mark = $this->__mark();
                $unmark = $this->__unmark();
                $save = $this->__save();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($hide);
                $form->attach($unhide);
                $form->attach($mark);
                $form->attach($unmark);
                $form->attach($save);
                $form->attach($remove);
                
                // Button functions:
                $hide->onsubmit(array($this, '_hide'));
                $unhide->onsubmit(array($this, '_show'));
                $mark->onsubmit(array($this, '_mark'));
                $unmark->onsubmit(array($this, '_unmark'));
                $save->onsubmit(array($this, '_save'));
                $remove->onsubmit(array($this, '_bin'));
                
                // List buttons:
                $this->_onclick_hide();
                $this->_onclick_show();
                $this->_onclick_modify('mark', 'mark', 1);
                $this->_onclick_modify('unmark', 'mark', 0);
                
                $this->assign('title', 'Article management list');
                
                // Namepath (category) active?:
                if(isset($request['category'])){
                    
                    // Create page:
                    $namepath = $request['category'];
                    $page = $this->_get_page_by_namepath($namepath);
                    if(is_null($page)){
                        return self::CMD_ERROR;
                    }
                    
                    // Count articles associated with concrete page;
                    $this->_count_articles($page);
                    
                    // Retrieve a pointer (current page):
                    $this->_page();
                    
                    // Page exists?:
                    if($this->_pages_count() < $this->_page){
                        return self::CMD_ERROR;
                    }
                    
                    // Extracting article list:
                    $this->_article_list_by_page($page, $this->_page);
                    
                    // Assignments:
                    $this->assignAll(array(
                        
                        // Article list
                        'articles'          => &$this->_list,
                        'page_number'       => $this->_page,
                        
                        // Page namepath:
                        'category'          => $namepath,
                        'page'              => $this->_page_data,
                        
                        // Toolbar:
                        'toolbar_left'      => !empty($this->_list) ? array($save, $hide, $mark) : array(),
                        'toolbar_right'     => !empty($this->_list) ? array($remove, $unhide, $unmark, $this->_switch($namepath)) : array($this->_switch($namepath)),

                    ));
                    return self::CMD_OK;
                }
                
                // Category not selected:
                else {
                    // Count all articles:
                    $this->_count_all_articles();
                    
                    // Retrieve a pointer (current page):
                    $this->_page();
                    
                    // Page exists?:
                    if($this->_pages_count() < $this->_page){
                        return self::CMD_ERROR;
                    }
                    
                    // Extracting article list:
                    $this->_article_list($this->_page);
                    
                    // Assignments:
                    $this->assignAll(array(
                        
                        // Article list
                        'articles'         => &$this->_list,
                        'page_number'      => $this->_page,
                        
                        // Toolbar:
                        'toolbar_left'      => !empty($this->_list) ? array($save, $hide, $mark) : array(),
                        'toolbar_right'     => !empty($this->_list) ? array($remove, $unhide, $unmark, $this->_switch()) : array($this->_switch()),

                    ));
                    return self::CMD_DEFAULT;
                }
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_all_articles(){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $count = \core\classes\data\Article::countNotRemovedByUserId($User->getID());
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _count_articles(\core\classes\data\Page $page){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $count = \core\classes\data\Article::countNotRemovedByPageIdAndByUserId($page->getID(), $User->getID());
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
            
            protected function _get_page_by_namepath($namepath){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $page = $factory->getByNamepath($namepath);
                    
                    $Page = new \core\classes\domain\Page(null, $page);
                    if($Page->load(new \core\classes\sql\attribute\AttributeList(array('id', 'title', 'namepath')))){
                        $this->_page_data = &$Page->getPresentationData(false);
                        return $page;
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
            
            protected function _onclick_modify($request_name, $column, $value){
                // Article factory:
                $factory = new \core\classes\data\factory\Article();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                if(isset($this->__request[$request_name])){
                    $article_list = $this->__request[$request_name];
                    
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
            }// end _onclick_modify
            
            protected function _onclick_hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('hide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->hide();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _onclick_show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Article();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('unhide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->show();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _article_list($pointer){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getAvailableByUserId($User->getID(), $pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Article(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list
            
            protected function _get_data(\core\classes\domain\collection\set\Article $set){
                try {
                    // Load article data:
                    $set->load(new \core\classes\sql\attribute\AttributeList(array('id', 'title', 'namepath', 'description', 'hide', 'mark', 'ord', 'cdate', 'edate')));
                    
                    // Load additional data:
                    $set->accept(function($Article){
                        $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension'));
                        $File = $Article->getFile();
                        if(!is_null($File)){
                            $File->load($attributes);
                        }
                        $User = $Article->getUser();
                        if(!is_null($User)){
                            $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname')));
                        }
                        $Article->loadPages(1, 100);
                        $Pages = $Article->getPages();
                        if(!is_null($Pages)){
                            $Pages->load(new \core\classes\sql\attribute\AttributeList(array('id', 'namepath', 'link', 'title')));
                        }
                        return true;
                    });
                    
                    // Extract data:
                    foreach($set as $Article){
                        $this->_list[$Article->getID()] = &$Article->getPresentationData();
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _get_data
            
            protected function _article_list_by_page(\core\classes\data\Page $page, $pointer){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getAvailableByPageIdAndByUserId($page->getID(), $User->getID(), $pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Article(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list_by_page
            
            protected function _switch($namepath = ''){
                $all = $this->_pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->_page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/article/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/article/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
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
            
            private function __mark(){
                $f = new \core\classes\form\field\Submit('mark_button');
                $f->value('Mark');
                $this->__mark = $f;
                return $f;
            }// end __mark
            
            private function __unmark(){
                $f = new \core\classes\form\field\Submit('unmark_button');
                $f->value('Unmark');
                $this->__unmark = $f;
                return $f;
            }// end __unmark
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save_button');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}