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

class Article extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Article', $id);
            }// end getById
            
            public function getByPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByPageId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getAvailableByPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByPageIdAndByBin();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'bin'       => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByPageId
            
            public function getAvailableByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByUserIdAndByBin();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'bin'       => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByUserId
            
            public function getAvailableByPageIdAndByUserId($page_id, $user_id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByPageIdByUserIdAndByBin();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'page_id'   => $page_id,
                        'user_id'   => $user_id,
                        'bin'       => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_and_user_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByUserId
            
            public function getUnavailableByPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByPageIdAndByBin();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'bin'       => 1,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByPageId
            
            public function getVisibleByPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByPageIdByBinAndByHide();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'bin'       => 0,
                        'hide'      => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getVisibleByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByUserIdByBinAndByHide();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'bin'       => 0,
                        'hide'      => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getVisible($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByBinAndByHide();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'bin'       => 0,
                        'hide'      => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_all'), 0, $ex);
                }
                return null;
            }// end getVisible
            
            public function getVisibleWithSliderImage($pointer, $count, $width, $height){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByBinAndByHideWithSliderImage();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'bin'       => 0,
                        'hide'      => 0,
                        'width'     => $width,
                        'height'    => $height,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_all'), 0, $ex);
                }
                return null;
            }// end getVisible
            
            public function getByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByCommentId($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByCommentId();
                try {
                    return $this->_findId($strategy, $id, 'article_id', 'Article');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_comment_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getHavingAnyComments($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleHavingAnyComments();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_having_comments'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getHavingAnyCommentsByPublicist($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getArticleHavingAnyCommentsByPublicist();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'user_id'   => $id,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_having_comments'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getByNamepath($namepath){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByNamepath();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('namepath' => $namepath)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('Article', $found_id);
                        }
                    }
                return null;
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
            
            public function getByNamepathAndByUserId($namepath, $id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleByNamepathAndByUserId();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('namepath' => $namepath, 'user_id' => $id)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('Article', $found_id);
                        }
                    }
                return null;
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepathAndByUserId
            
            public function getRemovedByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedArticleByUserId();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_removed_by_user_id'), 0, $ex);
                }
                return null;
            }// end getRemovedByUserId
            
            public function getRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedArticle();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_removed'), 0, $ex);
                }
                return null;
            }// end getRemoved
            
            public function getAllSortedByCdate($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllArticleSortedByCdate();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_all'), 0, $ex);
                }
                return null;
            }// end getAllSortedByCdate
            
            public function getAllSortedByCdateNotHiddenAndNotRemoved($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllArticleSortedByCdateNotHiddenAndNotRemoved();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_all'), 0, $ex);
                }
                return null;
            }// end getAllSortedByCdate
            
            public function getAllSortedNotHiddenAndNotRemovedByPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllArticleSortedNotHiddenAndNotRemovedByPageId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_all'), 0, $ex);
                }
                return null;
            }// end getAllSortedByCdate
            
            public static function namepathExists($namepath){
                $factory = new self();
                $article = $factory->getByNamepath($namepath);
                if(!is_null($article)){
                    return $article->getID();
                }
                return null;
            }// end namepathExists
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Article($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}