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

class Page extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'link', 'namepath', 'title', 'description', 'keywords',
            'page_id', 'ord', 'bin', 'hide', 'mark', 'cdate', 'edate',
            'user_id'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'link', 'namepath', 'title', 'body', 'description', 'keywords',
            'page_id', 'ord', 'bin', 'hide', 'mark', 'cdate', 'edate',
            'user_id', 'vars'
        );
        
        // Table name:
        protected $_tableName               = 'page';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting Page statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getPage($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public function bin(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getPageBinOperations();
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
                    $strategy = \core\classes\sql\StrategyFactory::getPageBinOperations();
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
                    $strategy = \core\classes\sql\StrategyFactory::getPageHideOperations();
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
                    $strategy = \core\classes\sql\StrategyFactory::getPageHideOperations();
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
                $strategy = \core\classes\sql\StrategyFactory::getCountPage();
                return self::_count($strategy, array());
            }// end count
            
            public static function countNotRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getCountNotRemovedPage();
                return self::_count($strategy, array());
            }// end countNotRemoved
            
            public static function countHavingAnyArticles(){
                $strategy = \core\classes\sql\StrategyFactory::getCountPageHavingAnyArticles();
                return self::_count($strategy, array());
            }// end countHavingArticles
            
            public static function countHavingAnyArticlesByPublicist(){
                $strategy = \core\classes\sql\StrategyFactory::getCountPageHavingAnyArticlesforPublicist();
                return self::_count($strategy, array());
            }// end countHavingArticlesByPublicist
            
            public static function remove(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedPages();
                return self::_remove($strategy, array());
            }// end remove
            
            public static function restore(){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllPages();
                return self::_restore($strategy, array());
            }// end restore
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}