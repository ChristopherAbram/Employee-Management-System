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

namespace core\classes\command\panel\administrator;

class Departments extends Command {
    // vars {
        
        // Results per page: 
        protected $_page          = 1;
        protected $_count         = 0;
        protected $_countperpage  = 10;
        
        protected $_list        = array();
        protected $_department_data   = array();
    
        // Form fields:
        private $__form         = null;
        // Buttons:
        private $__remove       = null;
    
    // } methods {
    
        // public {
            
            public function remove(){
                // Page factory:
                $factory = new \core\classes\data\factory\Department();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('department');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $department = $factory->getById($id);
                    if(!is_null($department)){
                        return $department->delete();
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
                    'panel/articlelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form:
                $form = new \core\classes\form\Form('department_list');
                $this->__form = $form;
                
                // Buttons:
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($remove);
                
                // Button functions:
                $remove->onsubmit(array($this, 'remove'));
                
                $this->assign('title', 'Departments management list');
                
                // Count all departments:
                $this->_count_all_departments();

                // Retrieve a pointer (current page):
                $this->_page();

                // Page exists?:
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting article list:
                $this->_department_list($this->_page);

                // Assignments:
                $this->assignAll(array(

                    // Article list
                    'departments'      => &$this->_list,
                    'page_number'      => $this->_page,

                    // Toolbar:
                    'toolbar_left'      => !empty($this->_list) ? array() : array(),
                    'toolbar_right'     => !empty($this->_list) ? array($remove, $this->_switch()) : array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_all_departments(){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $count = \core\classes\data\Department::count();
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
            
            protected function _department_list($pointer){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $factory = new \core\classes\data\factory\Department();
                    $set = $factory->getAll($pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Department(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list
            
            protected function _get_data(\core\classes\domain\collection\set\Department $set){
                try {
                    // Load article data:
                    $set->load(new \core\classes\sql\attribute\AttributeList(array('id', 'namepath', 'name', 'description', 'city', 'zip', 'street', 'house', 'flat')));
                    
                    /*// Load additional data:
                    $set->accept(function($Article){
                        
                        return true;
                    });*/
                    
                    // Extract data:
                    foreach($set as $Department){
                        $this->_list[$Department->getID()] = &$Department->getPresentationData();
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
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/departments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/departments/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // } private {
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}