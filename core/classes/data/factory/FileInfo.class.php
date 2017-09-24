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

class FileInfo extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('FileInfo', $id);
            }// end getById
            
            public function getAvatarByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getAvatarByUserId();
                try {
                    return $this->_findId($strategy, $id, 'file_id', 'FileInfo');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_user_id'), 0, $ex);
                }
                return null;
            }// end getAvatarByUserId
            
            public function getByFileId($id){
                $strategy = \core\classes\sql\StrategyFactory::getFileInfoByFileId();
                try {
                    return $this->_findId($strategy, $id, 'file_id', 'FileInfo');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_file_id'), 0, $ex);
                }
                return null;
            }// end getByFileId
            
            public function getByFileMiniatureId($id){
                $strategy = \core\classes\sql\StrategyFactory::getFileInfoByFileMiniatureId();
                try {
                    return $this->_findId($strategy, $id, 'file_id', 'FileInfo');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_file_miniature_id'), 0, $ex);
                }
                return null;
            }// end getByFileMiniatureId
            
            public function getByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getFileInfoByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getImagesByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getImageFileInfoByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getNotRemovedByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedFileInfoByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_user_id'), 0, $ex);
                }
                return null;
            }// end getNotRemovedByUserId
            
            public function getNotRemoved($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedFileInfo();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_user_id'), 0, $ex);
                }
                return null;
            }// end getNotRemoved
            
            public function getByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getFileInfoByArticleId();
                try {
                    return $this->_findId($strategy, $id, 'file_id', 'FileInfo');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_info_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getRemovedByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedFileByUserId();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_removed_by_user_id'), 0, $ex);
                }
                return null;
            }// end getRemovedByUserId
            
            public function getRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedFiles();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_removed'), 0, $ex);
                }
                return null;
            }// end getRemoved
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\FileInfo($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}