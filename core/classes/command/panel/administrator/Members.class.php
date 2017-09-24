<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.10.2016
 */

namespace core\classes\command\panel\administrator;

class Members extends Command {
    // vars {
        
        private $__count        = 0;
        private $__countperpage = 15;
        private $__page         = 1;
    
        // Member data list:
        private $__members      = array();
    
        // Form fields:
        private $__form         = null;
        
        // Buttons:
        private $__activate     = null;
        private $__deactivate   = null;
        private $__remove       = null;
        
        private $__request      = null;
    
    // } methods {
    
        // public {
            
            public function _activate(){
                $this->_modify('isactive', 1);
            }// end _activate
            
            public function _deactivate(){
                $this->_modify('isactive', 0);
            }// end _deactivate
            
            public function _remove(){
                $this->_modify('bin', 1);
            }// end _remove
            
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
                    'panel/itemlist.style.css',
                    'panel/filelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                // Form:
                $form = new \core\classes\form\Form('user_list');
                $this->__form = $form;
                
                // Buttons:
                $activate = $this->__activate();
                $deactivate = $this->__deactivate();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($activate);
                $form->attach($deactivate);
                $form->attach($remove);
                
                // Button functions:
                $activate->onsubmit(array($this, '_activate'));
                $deactivate->onsubmit(array($this, '_deactivate'));
                $remove->onsubmit(array($this, '_remove'));
                
                // List buttons:
                $this->_onclick_modify('activate', 'isactive', 1);
                $this->_onclick_modify('deactivate', 'isactive', 0);
                
                // Count users:
                $this->__count_users();
                // Retrieve a pointer (current page):
                $this->__page();
                // Page exists?:
                if($this->__pages_count() < $this->__page){
                    return self::CMD_ERROR;
                }
                
                // Extracting user list:
                $this->__member_list();
                
                /*echo '<pre>';
                print_r($this->__members);
                echo '</pre>';
                die();*/
                
                $this->assignAll(array(
                    
                    'title'             => 'Member management list',
                    'page_number'       => $this->__page,
                    
                    // Page tree html:
                    'members'           => $this->__members,
                    
                    // Toolbar:
                    'toolbar_left'      => !empty($this->__members) ? array($activate) : array(),
                    'toolbar_right'     => !empty($this->__members) ? array($remove, $deactivate, $this->__switch()) : array($this->__switch()),
                    
                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _modify($column, $value){
                // Page factory:
                $factory = new \core\classes\data\factory\User();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                if(isset($this->__request['user'])){
                    $user_list = $this->__request['user'];
                    
                    foreach($user_list as $id => $val){
                        $user = $factory->getById($id);
                        if(!is_null($user)){
                            $user->setAttributeList($attributes);
                            $data = $user->getData();
                            // Change data:
                            $data[$column] = $value;
                            $user->setData($data);
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
                // Page factory:
                $factory = new \core\classes\data\factory\User();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                if(isset($this->__request[$request_name])){
                    $user_list = $this->__request[$request_name];
                    
                    foreach($user_list as $id => $val){
                        $user = $factory->getById($id);
                        if(!is_null($user)){
                            $user->setAttributeList($attributes);
                            $data = $user->getData();
                            // Change data:
                            $data[$column] = $value;
                            $user->setData($data);
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
            
             protected function __count_users(){
                try {
                    $count = \core\classes\data\User::countNotRemoved();
                    if(!is_null($count)){
                        $this->__count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __count_users
            
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
            
        // } private {
            
            private function __member_list(){
                $factory = new \core\classes\domain\factory\Plain();
                try {
                    // Get user set:
                    $set = $factory->getAllUsersNotRemoved($this->__page, $this->__countperpage);
                    
                    // Load all of the data:
                    $set->accept(function($User){
                        $p = $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'email', 'sex', 'cdate', 'isactive', 'avatar')));
                        if($p){
                            $p = $User->loadUserRole();
                        }
                        if($p){
                            $User->loadCountry();
                        }
                        $Avatar = $User->getAvatar();
                        if(!is_null($Avatar)){
                            $Avatar->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension')));
                        }
                        if($p){
                            $this->__members[] = $User->getPresentationData();
                        }
                        return $p;
                    });
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __page_list
            
            private function __activate(){
                $f = new \core\classes\form\field\Submit('activate_button');
                $f->value('Activate');
                $this->__activate = $f;
                return $f;
            }// end __activate
            
            private function __deactivate(){
                $f = new \core\classes\form\field\Submit('deactivate_button');
                $f->value('Deactivate');
                $this->__deactivate = $f;
                return $f;
            }// end __deactivate
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
            private function __switch($namepath = ''){
                $all = $this->__pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->__page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/members/'.($this->__page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->__page.' / '.$all.'</span>';
                
                // Next
                if($this->__page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/members/'.($this->__page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // }
    // }
}