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

class UserRole extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'access_level', 'name',
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'access_level', 'name',
        );
        
        // Table name:
        protected $_tableName               = 'user_role';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting UserRole statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getUserRole($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}