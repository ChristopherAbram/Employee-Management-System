<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date       24.08.2016
 */

namespace core\classes\data;

class Article extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'link', 'namepath', 'title', 'description', 'keywords',
            'ord', 'bin', 'hide', 'mark', 'cdate', 'edate',
            'user_id', 'comments_active'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'link', 'namepath', 'title', 'body', 'description', 'keywords',
            'ord', 'bin', 'hide', 'mark', 'cdate', 'edate',
            'user_id', 'comments_active', 'file_id', 'vars'
        );
        
        // Table name:
        protected $_tableName               = 'article';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting Page statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getArticle($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public function bin(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getArticleBinOperations();
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $this->_id)));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('bin'), 0, $ex);
                }
                return false;
            }// end bin
            
            public function unbin(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getArticleBinOperations();
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $this->_id)));
                    $mapper->setData($data);
                    if($mapper->update()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('unbin'), 0, $ex);
                }
                return false;
            }// end unbin
            
            public function hide(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getArticleHideOperations();
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $this->_id)));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('hide'), 0, $ex);
                }
                return false;
            }// end hide
            
            public function show(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getArticleHideOperations();
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $this->_id)));
                    $mapper->setData($data);
                    if($mapper->update()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('show'), 0, $ex);
                }
                return false;
            }// end show
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getCountArticle();
                return self::_count($strategy, array());
            }// end count
            
            public static function countNotRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedArticle();
                return self::_count($strategy, array());
            }// end countNotRemoved
            
            public static function countNotRemovedByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedArticleByPageId();
                return self::_count($strategy, array('id'   => $id));
            }// end countNotRemovedByPageId
            
            public static function countNotRemovedByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedArticleByUserId();
                return self::_count($strategy, array('id'   => $id));
            }// end countNotRemovedByPageId
            
            public static function countNotRemovedByPageIdAndByUserId($page_id, $user_id){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedArticleByPageIdAndByUserId();
                return self::_count($strategy, array('page_id' => $page_id, 'user_id'   => $user_id));
            }// end countNotRemovedByPageId
            
            public static function countNotRemovedAndNotHidden(){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedAndNotHiddenArticle();
                return self::_count($strategy, array());
            }// end countNotRemoved
            
            public static function countNotRemovedAndNotHiddenByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedAndNotHiddenArticleCountByPageId();
                return self::_count($strategy, array('id' => $id));
            }// end countNotRemovedAndNotHiddenByPageId
            
            public static function countNotRemovedAndNotHiddenByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedAndNotHiddenArticleCountByUserId();
                return self::_count($strategy, array('id' => $id));
            }// end countNotRemovedAndNotHiddenByUserId
            
            public static function countByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleCountByPageId();
                return self::_count($strategy, array('id' => $id));
            }// end countByPage
            
            public static function countHavingAnyComments(){
                $strategy = \core\classes\sql\StrategyFactory::getArticleCountHavingAnyCommets();
                return self::_count($strategy, array());
            }// end count
            
            public static function countHavingAnyCommentsByPublicist($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleCountHavingAnyCommetsByPublicist();
                return self::_count($strategy, array('user_id' => $id));
            }// end count
            
            public static function remove(){
                $strategy = \core\classes\sql\StrategyFactory::getRemoveMovedArticles();
                return self::_remove($strategy, array());
            }// end remove
            
            public static function restore(){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllArticles();
                return self::_restore($strategy, array());
            }// end restore
            
            public static function removeByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRemoveMovedArticlesByUserId();
                return self::_remove($strategy, array('id' => $id));
            }// end remove
            
            public static function restoreByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllArticlesByUserId();
                return self::_restore($strategy, array('id' => $id));
            }// end restore
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}