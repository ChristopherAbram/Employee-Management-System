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

class Responsibility extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'name', 'description'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'name', 'description'
        );
        
        // Table name:
        protected $_tableName               = 'responsibility';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting res... statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getResponsibility($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getCountResponsibility();
                return self::_count($strategy, array());
            }// end count
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}