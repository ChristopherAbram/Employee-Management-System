<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\publicist;

class ArticleCategory extends ArticleEditor {
    // vars {
        
        protected static $_step     = 2;
        protected static $_cmd      = 'articlecategory';
        
        protected $_next            = 'ArticleBody';
        protected $_prev            = 'ArticleEditor';
        
        protected $_list            = array();
        protected $_selected        = array();
        
        // Form fields:
        private $__form             = null;
        private $__parent           = null;
        private $__save             = null;
        private $__next             = null;
        private $__cancel           = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/pageeditor.style.css',
                    'panel/list.style.css'
                );
            }// end _styles
        
            protected function _read(){
                //if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = (int)$this->_retrieveId();
                    if(is_null($id)){
                        return false;
                    }
                    try {
                        
                        $factory = new \core\classes\domain\factory\Article();
                        $Article = $factory->getById($id);
                        if(is_null($Article)){
                            return false;
                        }
                        
                        $Article->loadAvailablePages(1, 1000);
                        $Pages = $Article->getPages();
                        if(is_null($Pages)){
                            return false;
                        }
                        
                        $Pages->accept(function($Page){
                            $this->_selected[$Page->getID()] = $Page->getID();
                            return true;
                        });
                        
                        return true;
                    } catch (\core\classes\domain\DomainException $ex) {
                        $this->error(Error::get('art_read'));
                    }
                //}
                return true;
            }// end _read
            
            protected function _update(){
                $id = $this->_retrieveId();
                if(is_null($id)){
                    return false;
                }
                try {
                    
                    // Check input:
                    if(!isset($this->_request['page']) || !is_array($this->_request['page']) || empty($this->_request['page'])){
                        $this->error(Error::get('form_incomplete'));
                        return false;
                    }
                    
                    // Remove all assignments:
                    $p = \core\classes\data\PageArticle::deleteByArticleId($id);
                    if(!$p){
                        $this->error(Error::get('update'));
                        return false;
                    }
                    
                    // Insert all assignments:
                    $pages = $this->_request['page'];
                    $p = true;
                    foreach($pages as $page){
                        $page_article = new \core\classes\data\PageArticle();
                        $page_article->setData(array(
                            'page_id'   => $page,
                            'article_id'=> $id
                        ));
                        if(!$page_article->create()){
                            $p = false;
                            break;
                        }
                    }
                    
                    if(!$p){
                        $this->error(Error::get('update'));
                        return false;
                    }
                    else {
                        $this->correct(Correct::get('update'));
                    }
                    return true;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Form:
                $form = new \core\classes\form\Form('articlecategory');
                $this->__form = $form;
                
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Compose form:
                $form->attach($next);
                $form->attach($save);
                $form->attach($cancel);
                
                // Execute form:
                if($save->submitted() || $next->submitted()){
                    if($form->perform()){
                        if($this->_save()){
                            if($next->submitted()){
                                $status = self::NEXT;
                            }
                        }
                    }
                    else {
                        $this->error(Error::get('form_incomplete'));
                    }
                }
                else if($cancel->submitted()){
                    $this->_cancel();
                }
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('art_read'));
                }
                
                // Load page list:
                $this->_page_list();

                // Select choosen:
                $this->__select_checked();
                
                $this->assignAll(array(
                    'title'         => Text::get('articleparent'),
                    'description'   => Text::get('article_desc'),
                    
                    // Form:
                    'pages'         => &$this->_list,
                    //'parent_page_list'  => $this->__html_list($tree),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save, $next),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
            protected function _page_list(){
                $factory = new \core\classes\domain\factory\Page();
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        $this->error(Error::get('art_read'));
                        return;
                    }
                    $Pages = $factory->getAllAvailableByPublicistId($User->getID(), 1, 1000);
                    if(is_null($Pages)){
                        $this->error(Error::get('art_read'));
                        return;
                    }
                    // Load pages data:
                    $Pages->load(new \core\classes\sql\attribute\AttributeList(array('id', 'title')));
                    
                    $Pages->accept(function($Page){
                        if($Page->getID() == 1){
                            return;
                        }
                        $this->_list[$Page->getID()] = &$Page->getPresentationData(false);
                    });
                    
                    /*$Page = $factory->getRoot();
                    if(!is_null($Page)){ 
                        // Build page tree:
                        $Page->availableTree();

                        // Load tree data:
                        $visitor = new \core\classes\visitor\PageLoader();
                        $visitor->attributes(array('id', 'title'));
                        $Page->acceptTree($visitor);

                        $Page->acceptTree(function($Page){
                            if($Page->getID() == 1){
                                return;
                            }
                            $this->_list[$Page->getID()] = &$Page->getPresentationData(false);
                        });
                    }*/
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _page_list
            
        // } private {
            
            private function __select_checked(){
                foreach($this->_list as &$page){
                    $page['checked'] = false;
                    if(isset($this->_selected[$page['id']])){
                        $page['checked'] = true;
                    }
                }
            }// end __select_checked
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep2');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep2');
                $f->value('Save and next');
                $this->__next = $f;
                return $f;
            }// end __next
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Cancel');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}