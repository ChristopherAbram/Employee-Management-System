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

class ArticleVisit extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'article_id', 'cdate'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'article_id', 'cdate'
        );
        
        // Table name:
        protected $_tableName               = 'article_visit';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting ArticleVisit statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getArticleVisit($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getArticleVisitCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleVisitCountByArticleId();
                return self::_count($strategy, array('id' => $id));
            }// end countByPage
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}