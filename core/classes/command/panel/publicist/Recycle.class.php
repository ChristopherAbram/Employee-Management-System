<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	07.10.2016
 */

namespace core\classes\command\panel\publicist;

class Recycle extends Command {
    // vars {
        
        // Form fields:
        protected $_form           = null;
        
        // Buttons:
        protected $_remove         = null;
        protected $_remove_all     = null;
        protected $_restore        = null;
        protected $_restore_all    = null;
        
        // Data containers:
        protected $_articles        = array();
        protected $_files           = array();
        
        private $__request      = null;
    
    // } methods {
    
        // public {
            
            public function _remove(){
                try {
                    
                    // Files:
                    $this->_remove_files();
                    
                    // Perform update:
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch(\Exception $ex) {
                    $this->error($ex->getMessage());
                }
                return;
            }// end _remove
            
            public function _restore(){
                try {
                    // Files:
                    $this->_restore_files();
                    
                    // Perform update:
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch(\Exception $ex){
                    $this->error($ex->getMessage());
                }
                return;
            }// end _restore
            
            public function _remove_all(){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    if(\core\classes\data\FileInfo::removeByUserId($User->getID())){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _remove_all
            
            public function _restore_all(){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    if(\core\classes\data\FileInfo::restoreByUserId($User->getID())){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _restore_all
            
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
                    'panel/articlelist.style.css'
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form instance:
                $form = new \core\classes\form\Form('list');
                $this->_form = $form;
                
                // Buttons instances:
                $restore        = $this->__restore();
                $restore_all    = $this->__restore_all();
                $remove         = $this->__remove();
                $remove_all     = $this->__remove_all();
                
                // Composing form:
                $form->attach($restore);
                $form->attach($restore_all);
                $form->attach($remove);
                $form->attach($remove_all);
                
                // Bind action to buttons:
                $remove->onsubmit(array($this, '_remove'));
                $remove_all->onsubmit(array($this, '_remove_all'));
                $restore->onsubmit(array($this, '_restore'));
                $restore_all->onsubmit(array($this, '_restore_all'));
                
                // User instance:
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return self::CMD_ERROR;
                }
                
                // Load data:
                $this->_load_files($User);
                
                // Assign data:
                $this->assignAll(array(
                    
                    // General:
                    'title'             => 'Recycle bin',
                    
                    // Data:
                    'files'             => $this->_files,
                    
                    // Toolbar:
                    'toolbar_left'      => array($restore, $restore_all),
                    'toolbar_right'     => array($remove, $remove_all),
                    
                ));
                
                return self::CMD_DEFAULT;
            }// end _execute
            
                        
            protected function _load_files(\core\classes\domain\User $User){
                try {
                    $factory = new \core\classes\domain\factory\File();
                    $set = $factory->getRemovedByUserId($User->getID());
                    if(!is_null($set)){
                        $set->accept(function($File){
                            // Load basic data:
                            $p = $File->load(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'name', 'extension', 'size'
                            )));
                            // Load file miniature:
                            if($p){
                                $File->loadFileMiniature();
                            }
                            // Extract data:
                            $this->_files[] = $File->getPresentationData();
                            return $p;
                        });
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end _load_files
            
           
            
            protected function _restore_files(){
                $this->_restore_item('file', new \core\classes\domain\factory\File());
            }// end _restore_files
            
            protected function _restore_item($request_name, \core\classes\domain\factory\Factory $factory){
                $request = $this->__request;
                // Files:
                $items = (isset($request[$request_name]) && is_array($request[$request_name])) ? $request[$request_name] : array();
                foreach($items as $id => $val){
                    $Item = $factory->getById($id);
                    if(!is_null($Item)){
                        $item = $Item->getData();
                        if(!is_null($item)){
                            $data = $item->getData();
                            $data['bin'] = 0;
                            $item->setData($data);
                            $item->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'bin')));
                        }
                    }
                }
            }// end _restore_item
            
            
            
            protected function _remove_files(){
                $this->_remove_item('file', new \core\classes\data\factory\FileInfo());
            }// end _remove_articles
            
            protected function _remove_item($request_name, \core\classes\data\factory\Factory $factory){
                $request = $this->__request;
                $watcher = \core\classes\data\DataWatcher::getInstance();
                $items = (isset($request[$request_name]) && is_array($request[$request_name])) ? $request[$request_name] : array();
                foreach($items as $id => $val){
                    $item = $factory->getById($id);
                    if(!is_null($item)){
                        $watcher->addDelete($item);
                    }
                }
            }// end _remove_item
            
            protected function __restore(){
                $f = new \core\classes\form\field\Submit('restore_button');
                $f->value('Restore');
                $this->_restore = $f;
                return $f;
            }// end __restore
            
            protected function __restore_all(){
                $f = new \core\classes\form\field\Submit('restore_all_button');
                $f->value('Restore all');
                $this->_restore_all = $f;
                return $f; 
            }// end __restore_all
            
            protected function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->_remove = $f;
                return $f;
            }// end __remove
            
            protected function __remove_all(){
                $f = new \core\classes\form\field\Submit('remove_all_button');
                $f->value('Remove all');
                $this->_remove_all = $f;
                return $f;
            }// end __remove_all
            
        // } private {
        
            
            
        // }
    // }
}