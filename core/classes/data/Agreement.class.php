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

class Agreement extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'department_id', 'responsibility_id', 'working_time_id',
            'salary', 'from_date', 'to_date', 'description'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'department_id', 'responsibility_id', 'working_time_id',
            'salary', 'from_date', 'to_date', 'description'
        );
        
        // Table name:
        protected $_tableName               = 'agreement';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting .. statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getAgreement($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getCountAgreement();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountAgreementByUserId();
                return self::_count($strategy, array('user_id' => $id));
            }// end count
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}