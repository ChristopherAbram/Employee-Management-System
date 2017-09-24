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

class Comment extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Comment', $id);
            }// end getById
            
            public function get($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllComment();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'offset'   => $offset,
                        'count'    => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comments'), 0, $ex);
                }
                return null;
            }// end get
            
            public function getByPublicist($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllCommentByPublicist();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'user_id'  => $id,
                        'offset'   => $offset,
                        'count'    => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comments'), 0, $ex);
                }
                return null;
            }// end get
            
            public function getByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getCommentByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comment_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getVisibleByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getVisibleCommentByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'hide'     => 0,
                        'user_id'  => $id,
                        'offset'   => $offset,
                        'count'    => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comment_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getCommentByArticleId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comment_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByArticleIdAndByPublicist($article_id, $user_id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getCommentByArticleIdAndByPublicist();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'article_id'  => $article_id,
                        'user_id'       => $user_id,
                        'offset'   => $offset,
                        'count'    => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comment_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getNotHiddenAndNotRemovedByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getNotHiddenAndNotRemovedCommentByArticleId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('comment_by_article_id'), 0, $ex);
                }
                return null;
            }// end getNotHiddenAndNotRemovedByArticleId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Comment($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}