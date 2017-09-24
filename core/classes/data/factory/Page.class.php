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

class Page extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Page', $id);
            }// end getById
            
            /**
             * 
             * 
             * @return \core\classes\data\collection\set\Page|null     - page set
             */
            public function getByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByParentPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByParentPageId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_parentpage_id'), 0, $ex);
                }
                return null;
            }// end getByParentPageId
            
            public function getAvailableByParentPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByParentPageIdAndByBin();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_parentpage_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByParentPageId
            
            public function getUnavailableByParentPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByParentPageIdAndByBin();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_parentpage_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByParentPageId
            
            public function getVisibleByParentPageId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByParentPageIdByBinAndByHide();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_parentpage_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByParentPageId
            
            public function getByChildPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getPageByChildPageId();
                try {
                    return $this->_findId($strategy, $id, 'parent_id', 'Page');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByChildPageId
            
            public function getByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByArticleId();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'id'        => $id,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getAvailableByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByArticleIdAndByBin();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByArticleId
            
            public function getUnavailableByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByArticleIdAndByBin();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByArticleId
            
            public function getVisibleByArticleId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageByArticleIdByBinAndByHide();
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
                    throw new \core\classes\data\DataException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByArticleId
            
            public function getAllAvailableByPublicistId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllPageByPublicistIdAndByBin();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'user_id'   => $id,
                        'bin'       => 0,
                        'offset'    => $offset,
                        'count'     => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_user_id'), 0, $ex);
                }
                return null;
            }// end getAllAvailableByPublicistId
            
            public function getByNamepath($namepath){
                $strategy = \core\classes\sql\StrategyFactory::getPageByNamepath();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('namepath' => $namepath)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('Page', $found_id);
                        }
                    }
                return null;
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
            
            public function getTheseHavingAnyArticles($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageHavingAnyArticles();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, 0, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_having_any_articles'), 0, $ex);
                }
                return null;
            }// end getTheseHavingAnyArticles
            
            public function getTheseHavingAnyArticlesByPublicist($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getPageHavingAnyArticlesforPublicist();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_having_any_articles'), 0, $ex);
                }
                return null;
            }// end getTheseHavingAnyArticlesByPublicist
            
            public function getRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedPages();
                try {
                    return $this->_getSetById($strategy, 0, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('page_removed'), 0, $ex);
                }
                return null;
            }// end getRemoved
            
            public static function namepathExists($namepath){
                $factory = new self();
                $page = $factory->getByNamepath($namepath);
                if(!is_null($page)){
                    return $page->getID();
                }
                return null;
            }// end emailExists
        
        // } protected {
            
            protected function _getSet(array $ids = array()){
                return new \core\classes\data\collection\set\Page($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}