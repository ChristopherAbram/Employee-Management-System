<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\command\panel\publicist;

class File extends Command {
    // vars {
        
        // Results per page: 
        protected $__page         = 1;
        protected $__count        = 0;
        protected $__countperpage = 10;
        
        protected $__request      = null;
        
        // File data list:
        protected $__list         = array();
        
         // Form fields:
        protected $__form         = null;
        // Buttons:
        protected $__hide         = null;
        protected $__unhide       = null;
        protected $__lock         = null;
        protected $__unlock       = null;
        protected $__remove       = null;
        protected $__save         = null;
    
    // } methods {
    
        // public {
            
            public function _hide(){
                $this->_modify('hide', 1);
            }// end _hide
            
            public function _lock(){
                $this->_modify('locked', 1);
            }// end _mark
            
            public function _unhide(){
                $this->_modify('hide', 0);
            }// end _unhide
            
            public function _unlock(){
                $this->_modify('locked', 0);
            }// end _unmark
            
            public function _remove(){
                $this->_modify('bin', 1);
            }// end _remove
            
            public function _save(){
                try {
                    // File factory:
                    $factory = new \core\classes\data\factory\FileInfo();
                    // Attribute list:
                    $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'name'));

                    if(isset($this->__request['name'])){
                        $file_list = $this->__request['name'];
                        
                        foreach($file_list as $id => $value){
                            $file = $factory->getById($id);
                            if(!is_null($file)){
                                $file->setAttributeList($attributes);
                                $data = $file->getData();
                                // Change data:
                                $data['name'] = $value;
                                $file->setData($data);
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
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _save
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/filelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Logged user:
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return self::CMD_ERROR;
                }
                
                // Form:
                $form = new \core\classes\form\Form('file_list');
                $this->__form = $form;
                
                // Buttons:
                $hide = $this->__hide();
                $unhide = $this->__unhide();
                $lock = $this->__lock();
                $unlock = $this->__unlock();
                $save = $this->__save();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($hide);
                $form->attach($unhide);
                $form->attach($lock);
                $form->attach($unlock);
                $form->attach($save);
                $form->attach($remove);
                
                // Button functions:
                $hide->onsubmit(array($this, '_hide'));
                $unhide->onsubmit(array($this, '_unhide'));
                $lock->onsubmit(array($this, '_lock'));
                $unlock->onsubmit(array($this, '_unlock'));
                $save->onsubmit(array($this, '_save'));
                $remove->onsubmit(array($this, '_remove'));
                
                // List buttons:
                $this->_onclick_modify('hide', 'hide', 1);
                $this->_onclick_modify('unhide', 'hide', 0);
                $this->_onclick_modify('lock', 'locked', 1);
                $this->_onclick_modify('unlock', 'locked', 0);
                
                // Count files associated with concrete user;
                $this->__count_files($User);
                // Retrieve a pointer (current page):
                $this->__page();
                // Page exists?:
                if($this->__pages_count() < $this->__page){
                    return self::CMD_ERROR;
                }
                
                // Get file data list:
                $this->__file_list($User);
                
                // Assignments:
                $this->assignAll(array(
                    // General:
                    'title'             => 'Your files',
                    'page_number'       => $this->__page,
                    
                    // File list
                    'files'             => $this->__list,
                    
                    // Toolbar:
                    'toolbar_left'      => !empty($this->__list) ? array($save, $hide, $lock) : array(),
                    'toolbar_right'     => !empty($this->__list) ? array($remove, $unhide, $unlock, $this->__switch()) : array($this->__switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _modify($column, $value){
                try {
                    // File factory:
                    $factory = new \core\classes\data\factory\FileInfo();
                    // Attribute list:
                    $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));

                    if(isset($this->__request['file'])){
                        $file_list = $this->__request['file'];

                        foreach($file_list as $id => $val){
                            $file = $factory->getById($id);
                            if(!is_null($file)){
                                $file->setAttributeList($attributes);
                                $data = $file->getData();
                                // Change data:
                                $data[$column] = $value;
                                $file->setData($data);
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
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _modify
            
            protected function _onclick_modify($request_name, $column, $value){
                try {
                    // File factory:
                    $factory = new \core\classes\data\factory\FileInfo();
                    // Attribute list:
                    $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));

                    if(isset($this->__request[$request_name])){
                        $file_list = $this->__request[$request_name];

                        foreach($file_list as $id => $val){
                            $file = $factory->getById($id);
                            if(!is_null($file)){
                                $file->setAttributeList($attributes);
                                $data = $file->getData();
                                // Change data:
                                $data[$column] = $value;
                                $file->setData($data);
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
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _onclick_modify
            
        // } private {
            
            protected function __count_files(\core\classes\domain\User $User){
                try {
                    $count = \core\classes\data\FileInfo::countNotRemovedByUserId($User->getID());
                    if(!is_null($count)){
                        $this->__count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __count
            
            protected function __page(){
                $request = $this->__request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page) /*&& \preg_match('/^'.REGEX_INT_UNSIGNED.'$/i', $page)*/){
                        $this->__page = (int)$page;
                    }
                }
            }// end __page
            
            protected function __pages_count(){
                if($this->__count != 0){
                    $count = (int)\ceil((float)$this->__count / ((float)$this->__countperpage));
                    return $count;
                }
                return 1;
            }// end __pages_count
            
            protected function __file_list(\core\classes\domain\User $User){
                try {
                    $factory = new \core\classes\domain\factory\File();
                    $set = $factory->getNotRemovedByUserId($User->getID(), $this->__page, $this->__countperpage);
                    if(!is_null($set)){
                        // Load all necessary data:
                        $set->load(new \core\classes\sql\attribute\AttributeList(array(
                            'id', 'name', 'description', 'mime', 'extension', 'bin', 'hide', 'locked', 'size', 'cdate'
                        )));
                        
                        // Extract data:
                        foreach($set as $File){
                            $this->__list[] = $File->getPresentationData();
                        }
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __file_list
            
            protected function __hide(){
                $f = new \core\classes\form\field\Submit('hide_button');
                $f->value('Hide');
                $this->__hide = $f;
                return $f;
            }// end __hide
            
            protected function __unhide(){
                $f = new \core\classes\form\field\Submit('unhide_button');
                $f->value('Unhide');
                $this->__unhide = $f;
                return $f;
            }// end __unhide
            
            protected function __lock(){
                $f = new \core\classes\form\field\Submit('lock_button');
                $f->value('Lock');
                $this->__lock = $f;
                return $f;
            }// end __lock
            
            protected function __unlock(){
                $f = new \core\classes\form\field\Submit('unlock_button');
                $f->value('Unlock');
                $this->__unlock = $f;
                return $f;
            }// end __unlock
            
            protected function __save(){
                $f = new \core\classes\form\field\Submit('save_button');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            protected function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
            protected function __switch(){
                $all = $this->__pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->__page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/file/'.($this->__page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->__page.' / '.$all.'</span>';
                
                // Next
                if($this->__page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/file/'.($this->__page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // }
    // }
}