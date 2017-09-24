<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\plain
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\guest;

class Member extends Command {
    // vars {
        
        protected $_data            = array();
        protected $_list            = array();
        
        protected $_page            = 1;
        protected $_count           = 0;
        protected $_countperpage    = 6;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404),
                    );
                } 
                else {
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(200),
                    );
                }
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    'page.style.css'
                );
            }
            
            protected function _execute(\core\classes\request\Request $request){
                
                if(isset($request['user'])){
                    
                    // Extract an identifier:
                    $id = (int)$request['user'];
                    if($id <= 0){
                        return self::CMD_ERROR;
                    }
                    
                    // Retrieve a pointer (current page):
                    $this->_page();
                    
                    // Create user instance:
                    $User = \core\classes\domain\factory\User::getConcreteById($id);
                    if(!($User instanceof \core\classes\domain\AuthorizedUser)){
                        return self::CMD_ERROR;
                    }
                    
                    // Page does not exist for plain user:
                    if(($User instanceof \core\classes\domain\Plain) && ($this->_page > 1)){
                        return self::CMD_ERROR;
                    }
                    
                    // Load user data:
                    $this->_load_user($User);
                    
                    // User does not allow to public his profile:
                    if(isset($this->_data['profile']) and $this->_data['profile'] == 0){
                        return self::CMD_ERROR;
                    }
                    
                    // Load article list, if user is at least Publicist:
                    if(!($User instanceof \core\classes\domain\Plain)){
                        
                        // Count all available articles:
                        $this->_count_articles($User->getID());
                        
                        // Page exists?:
                        if($this->_pages_count() < $this->_page){
                            return self::CMD_ERROR;
                        }
                        
                        // Load list:
                        $this->_load_article_list($User);
                    }
                    
                    /*echo '<pre>';
                    print_r($this->_list);
                    echo '</pre>';
                    die();*/
                    
                    $this->assignAll(array(
                        
                        // User data:
                        'user'          => &$this->_data,
                        // Articles list:
                        'articles'      => &$this->_list,
                        
                        'result_switcher'   => \core\functions\result_page_switcher($this->_page, $this->_pages_count(), \core\functions\address().'/member/'.$id, 8)

                    ));
                    return self::CMD_OK;
                }
                return self::CMD_ERROR;
            }// end _execute
            
            /*protected function _load_user_role_name_by_user_id($id){
                try {
                    $factory = new \core\classes\data\factory\UserRole();
                    $user_role = $factory->getByUserId($id);
                    if(!is_null($user_role)){
                        if($user_role->read()){
                            $data = $user_role->getData();
                            return isset($data['name']) ? \strtolower($data['name']) : null;
                        }
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('read_user'));
                }
                return null;
            }// end _load_user_role_name_by_user_id*/
            
            protected function _count_articles($id){
                try {
                    $count = \core\classes\data\Article::countNotRemovedAndNotHiddenByUserId($id);
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count_articles
            
            protected function _page(){
                $request = $this->_request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page)){
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
            
            protected function _load_article_list(\core\classes\domain\AuthorizedUser $User){
                try {
                    $factory = new \core\classes\domain\factory\Article();
                    $set = $factory->getVisibleByUserId($User->getID(), $this->_page, $this->_countperpage);
                    if(!is_null($set)){
                        $attributes = new \core\classes\sql\attribute\AttributeList(array(
                            'id', 'title', 'namepath', 'link', 'description', 'mark', 'cdate', 'edate', 'user_id'
                        ));
                        $set->load($attributes);
                        // Load image for each article:
                        $set->accept(function($Article){
                            $File = $Article->getFile();
                            if(!is_null($File)){
                                $File->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name', 'extension'
                                )));
                            }
                            $User = $Article->getUser();
                            if(!is_null($User)){
                                $User->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'firstname', 'lastname', 'user_role_id', 'avatar'
                                )));
                                $User->loadUserRole();
                                $Avatar = $User->getAvatar();
                                if(!is_null($Avatar)){
                                    $Avatar->load(new \core\classes\sql\attribute\AttributeList(array(
                                        'id', 'name', 'extension'
                                    )));
                                }
                            }
                            $this->_list[] = &$Article->getPresentationData();
                        });
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error(Error::get('article'));
                }
            }// end _load_article_list
            
            protected function _load_user(\core\classes\domain\AuthorizedUser $User){
                try {
                    $p = $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'citation', 'description', 'profile')));
                    $File = $User->getAvatar();
                    if(!is_null($File)){
                        $File->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension')));
                    }
                    $User->loadUserRole();
                    $User->loadCountry();
                    $this->_data = &$User->getPresentationData();
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error(Error::get('read_user'));
                }
            }// end _load_user
            
        // } private {
            
            
            
        // }
    // }
}