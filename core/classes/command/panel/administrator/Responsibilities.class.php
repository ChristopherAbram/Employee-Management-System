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

class Responsibilities extends Command {
    // vars {
        
        // Results per page: 
        protected $_page          = 1;
        protected $_count         = 0;
        protected $_countperpage  = 15;
        
        protected $_list        = array();
        protected $_respon_data   = array();
    
        // Form fields:
        private $__form         = null;
        // Buttons:
        
        private $__name       = null;
        private $__desc      = null;
        private $__add       = null;
        
        private $__save       = null;
        private $__remove       = null;
    
    // } methods {
    
        // public {
            
            public function remove(){
                // Page factory:
                $factory = new \core\classes\data\factory\Responsibility();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('responsibility');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $responsibility = $factory->getById($id);
                    if(!is_null($responsibility)){
                        return $responsibility->delete();
                    }
                    return false;
                });
            }
            
            public function modify_list(){
                // Page factory:
                $factory = new \core\classes\data\factory\Responsibility();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'description'));
                
                if(isset($this->__request['responsibility']['name']) and isset($this->__request['responsibility']['description'])){
                    $res_list = $this->__request['responsibility']['name'];
                    
                    foreach($res_list as $id => $val){
                        $res = $factory->getById($id);
                        if(!is_null($res)){
                            $res->setAttributeList($attributes);
                            $data = $res->getData();
                            // Change data:
                            if(empty($val)){
                                $this->error('Name must be specified!');
                                return;
                            }
                            $data['name'] = \htmlentities($val);
                            if(isset($this->__request['responsibility']['description'][$id]))
                                $data['description'] = \htmlentities($this->__request['responsibility']['description'][$id]);
                            $res->setData($data);
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
            }// end modify_list
            
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
                $form = new \core\classes\form\Form('responsibility_list');
                $this->__form = $form;
                
                $name = $this->__name();
                $desc = $this->__desc();
                
                // Buttons:
                $add = $this->__add();
                $save = $this->__save();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($remove);
                $form->attach($save);
                
                // Button functions:
                $remove->onsubmit(array($this, 'remove'));
                $save->onsubmit(array($this, 'modify_list'));
                
                // Count all res...:
                $this->_count_all_responsibilities();

                // Retrieve a pointer (current page):
                $this->_page();

                // Page exists?:
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting article list:
                $this->_responsibility_list($this->_page);
                
                /*echo '<pre>';
                \print_r($_POST);
                echo '</pre>';
                exit();*/

                // Assignments:
                $this->assignAll(array(

                    // Article list
                    'responsibilities'      => &$this->_list,
                    'page_number'      => $this->_page,
                    
                    'name'       => array(
                        'title'         => 'Name of responsibility',
                        'input'         => $name,
                        'description'   => '',
                    ),
                    'desc'       => array(
                        'title'         => 'Description',
                        'input'         => $desc,
                        'description'   => '',
                    ),
                    'add'       => array(
                        'title'         => 'Add',
                        'input'         => $add,
                        'description'   => '',
                    ),

                    // Toolbar:
                    'toolbar_left'      => !empty($this->_list) ? array($save) : array(),
                    'toolbar_right'     => !empty($this->_list) ? array($remove, $this->_switch()) : array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_all_responsibilities(){
                try {
                    $count = \core\classes\data\Responsibility::count();
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
            
            protected function _responsibility_list($pointer){
                try {
                    $factory = new \core\classes\data\factory\Responsibility();
                    $set = $factory->getAll($pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Responsibility(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list
            
            protected function _get_data(\core\classes\domain\collection\set\Responsibility $set){
                try {
                    // Load article data:
                    $set->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'description')));
                    
                    
                    // Extract data:
                    foreach($set as $Respon){
                        $this->_list[$Respon->getID()] = &$Respon->getPresentationData();
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
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/responsibilities/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/responsibilities/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // } private {
            
            private function __name(){
                $f = new \core\classes\form\field\Text('name');
                $f->id('responsibility_name');
                $f->expression('/^'.REGEX_TITLE.'{3,512}$/i', Error::get('invalid'));
                $f->required(true);
                $f->fill(false);
                $this->__name = $f;
                return $f;
            }
            
            private function __desc(){
                $f = new \core\classes\form\field\Text('desc');
                $f->id('responsibility_desc');
                $f->required(true);
                $f->fill(false);
                $this->__desc = $f;
                return $f;
            }
            
            private function __add(){
                $f = new \core\classes\form\field\Submit('add');
                $f->value('Add');
                $this->__add = $f;
                return $f;
            }
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save_button');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}