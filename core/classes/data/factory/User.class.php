<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\data\factory;

class User extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return self::_getDataObject('User', $id);
            }// end getById
            
            public function getByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserByPageId();
                try {
                    return $this->_findId($strategy, $id, 'user_id', 'User');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserByArticleId();
                try {
                    return $this->_findId($strategy, $id, 'user_id', 'User');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getByCommentId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserByCommentId();
                try {
                    return $this->_findId($strategy, $id, 'user_id', 'User');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_comment_id'), 0, $ex);
                }
                return null;
            }// end getByCommentId
            
            public function getByFileInfoId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserByFileInfoId();
                try {
                    return $this->_findId($strategy, $id, 'user_id', 'User');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_file_info_id'), 0, $ex);
                }
                return null;
            }// end getByFileInfoId
            
            public function getByToken($token){
                $strategy = \core\classes\sql\StrategyFactory::getUserByToken();
                try {
                    $data = array(
                        'token' => $token
                    );
                    return $this->_findIdByData($strategy, $data, 'id', 'User');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_token'), 0, $ex);
                }
                return null;
            }// end getByToken
            
            public function getAllUsersNotRemoved($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllUsersNotRemoved();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('users_all'), 0, $ex);
                }
                return null;
            }// end getAllUsersNotRemoved
            
            public function getRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedUsers();
                try {
                    return $this->_getSetById($strategy, 0, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_removed'), 0, $ex);
                }
                return null;
            }// end getRemoved
            
            public function getByIdentifiers($username, $password){
                $strategy = \core\classes\sql\StrategyFactory::getUserByIdentifiers();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array(
                        'email'     => $username,
                        'password'  => $password
                    )));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('User', $found_id);
                        }
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_by_identifiers'), 0, $ex);
                }
                return null;
            }// end getByIdentifiers
            
            public static function emailExists($email){
                $strategy = \core\classes\sql\StrategyFactory::checkEmailExistence();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('email' => $email)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            return $data['id'];
                        }
                    }
                } catch(\core\classes\mapper\MapperException $ex){
                    throw new \core\classes\data\DataException(Error::get('email_exists'), 0, $ex);
                }
                return null;
            }// end emailExists
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\User($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}