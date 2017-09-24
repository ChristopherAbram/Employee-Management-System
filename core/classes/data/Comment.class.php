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

class Comment extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'article_id', 'content', 'cdate', 'hide'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'article_id', 'content', 'cdate', 'hide'
        );
        
        // Table name:
        protected $_tableName               = 'comment';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting Comment statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getComment($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public function hide(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getCommentHideOperations();
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
                    $strategy = \core\classes\sql\StrategyFactory::getCommentHideOperations();
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
                $strategy = \core\classes\sql\StrategyFactory::getCountComment();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByPublicist($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByPublicist();
                return self::_count($strategy, array('user_id' => $id));
            }// end countByPublicist
            
            public static function countByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByArticleId();
                return self::_count($strategy, array('article_id'   => $id));
            }// end countByArticleId
            
            public static function countByArticleIdAndByPublicist($article_id, $user_id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByArticleIdAndByPublicist();
                return self::_count($strategy, array('article_id'   => $article_id, 'user_id' => $user_id));
            }// end countByArticleId
            
            public static function countByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByUserId();
                return self::_count($strategy, array('user_id'   => $id));
            }// end countByUserId
            
            public static function countVisibleByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountVisibleCommentByUserId();
                return self::_count($strategy, array('user_id'   => $id, 'hide' => 0));
            }// end countByUserId
            
            public static function countByHide($hide){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByHide();
                return self::_count($strategy, array('hide' => $hide));
            }// end countNotHidden
            
            public static function countByHideAndByArticleId($hide, $id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByHideAndByArticleId();
                return self::_count($strategy, array('article_id'   => $id, 'hide' => $hide));
            }// end countNotHiddenByArticleId
            
            public static function countByHideAndByByUserId($hide, $id){
                $strategy = \core\classes\sql\StrategyFactory::getCountCommentByHideAndByUserId();
                return self::_count($strategy, array('user_id'   => $id, 'hide' => $hide));
            }// end countNotHiddenByUserId
            
            
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}