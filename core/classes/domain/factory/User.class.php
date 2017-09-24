<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain\factory;

abstract class User extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDomainObject($id);
            }// end getById
            
            public function getByFileId($id){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $data = $factory->getByFileInfoId($id);
                    if(!is_null($data)){
                        return $this->_getDomainObject(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('user_by_file_id'), 0, $ex);
                }
                return null;
            }// end getByFileId
            
            public function getByArticleId($id){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $data = $factory->getByArticleId($id);
                    if(!is_null($data)){
                        return $this->_getDomainObject(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('user_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getByPageId($id){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $data = $factory->getByPageId($id);
                    if(!is_null($data)){
                        return $this->_getDomainObject(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('user_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getByCommentId($id){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $data = $factory->getByCommentId($id);
                    if(!is_null($data)){
                        return $this->_getDomainObject(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('user_by_comment_id'), 0, $ex);
                }
                return null;
            }// end getByCommentId
            
            public function getAllUsersNotRemoved($pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $dataSet = $factory->getAllUsersNotRemoved($pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\User(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('all_users'), 0, $ex);
                }
                return null;
            }// end getAllUsersNotRemoved
            
            public function getRemoved(){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $set = $factory->getRemoved();
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\User(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_user'), 0, $ex);
                }
                return null;
            }// end getRemoved
            
            public static function getConcreteById($id){
                try {
                    $userrole_factory = new \core\classes\data\factory\UserRole();
                    $user_role = $userrole_factory->getByUserId($id);
                    
                    if(!is_null($user_role)){
                        $user_role->read();
                        $data = $user_role->getData();
                        if(isset($data['name'])){
                            $role = strtolower($data['name']);
                            $persistence = new \core\classes\persistence\factory\User();
                            $factory = $persistence->getDomainFactory($role);
                            if(!is_null($factory)){
                                $user = $factory->getById($id);
                                return $user;
                            }
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_id'), 0, $ex);
                }
                return null;
            }// end getConcreteById
            
            public static function getConcreteByFileId($id){
                try {
                    $user_factory = new \core\classes\data\factory\User();
                    $user = $user_factory->getByFileInfoId($id);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_file_id'), 0, $ex);
                }
                return null;
            }// end getConcreteByFileId
            
            public static function getConcreteByArticleId($id){
                try {
                    $user_factory = new \core\classes\data\factory\User();
                    $user = $user_factory->getByArticleId($id);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_article_id'), 0, $ex);
                }
                return null;
            }// end getConcreteByArticleId
            
            public static function getConcreteByPageId($id){
                try {
                    $user_factory = new \core\classes\data\factory\User();
                    $user = $user_factory->getByPageId($id);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_page_id'), 0, $ex);
                }
                return null;
            }// end getConcreteByPageId
            
            public static function getConcreteByCommentId($id){
                try {
                    $user_factory = new \core\classes\data\factory\User();
                    $user = $user_factory->getByCommentId($id);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_comment_id'), 0, $ex);
                }
                return null;
            }// end getConcreteByCommentId
            
            public static function getConcreteByToken($id){
                try {
                    $user_factory = new \core\classes\data\factory\User();
                    $user = $user_factory->getByToken($id);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new \core\classes\domain\DomainException(Error::get('user_by_token'), 0, $ex);
                }
                return null;
            }// end getConcreteByToken
            
            public static function getLoggedUser(){
                $session = \core\classes\session\Session::getInstance();
                $cookie = \core\classes\cookie\Cookie::getInstance();
                // session:
                if(isset($session['user'])){
                    $user_session_data = $session['user'];
                    
                    $id = null;
                    if(is_array($user_session_data) && isset($user_session_data['id'])){
                        $id = (int)$user_session_data['id'];
                    }
                    if(!is_null($id)){
                        $user = self::getConcreteById($id);
                        if(!is_null($user)){
                            $session['user'] = array('id' => $user->getID());
                            return $user;
                        }
                    }
                }
                // cookies:
                else if(isset($cookie['user_token'])){
                    $token = $cookie['user_token'];
                    $user = self::getConcreteByToken($token);
                    if(!is_null($user)){
                        return $user;
                    }
                }
                $guest = new \core\classes\domain\Guest();
                $session['user'] = array('id' => $guest->getID());
                return $guest;
            }// end getLoggedUser
            
            public static function identify($email, $password){
                $data_factory = new \core\classes\data\factory\User();
                try {
                    $user = $data_factory->getByIdentifiers($email, $password);
                    if(!is_null($user)){
                        $id = $user->getID();
                        return self::getConcreteById($id);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('user_by_identifiers'), 0, $ex);
                }
                return null;
            }// end identify
        
        // } protected {
            
            abstract protected function _getDomainObject($id = null, \core\classes\data\User $data = null);
            
        // } private {
            
        // }
    // }
}