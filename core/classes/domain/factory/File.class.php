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

class File extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\File($id);
            }// end getById
            
            public function getByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $dataSet = $factory->getByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\File(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getImagesByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $dataSet = $factory->getImagesByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\File(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getNotRemovedByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $dataSet = $factory->getNotRemovedByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\File(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getNotRemoved($pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $dataSet = $factory->getNotRemoved($pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\File(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getNotRemoved
            
            public function getByArticleId($id){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $data = $factory->getByArticleId($id);
                    if(!is_null($data)){
                        return new \core\classes\domain\File(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getAvatarByUserId($id){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $data = $factory->getAvatarByUserId($id);
                    if(!is_null($data)){
                        return new \core\classes\domain\File(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getAvatarByUserId
            
            public function getRemovedByUserId($id){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $set = $factory->getRemovedByUserId($id);
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\File(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getRemovedByUserId
            
            public function getRemoved(){
                try {
                    $factory = new \core\classes\data\factory\FileInfo();
                    $set = $factory->getRemoved();
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\File(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_file_by_user_id'), 0, $ex);
                }
                return null;
            }// end getRemoved
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}