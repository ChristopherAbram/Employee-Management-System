<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date       21.10.2016
 */

namespace core\classes\data;

class PageVisit extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'page_id', 'cdate'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'page_id', 'cdate'
        );
        
        // Table name:
        protected $_tableName               = 'page_visit';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting PageVisit statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getPageVisit($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getPageVisitCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getPageVisitCountByPageId();
                return self::_count($strategy, array('id' => $id));
            }// end countByPageId
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}