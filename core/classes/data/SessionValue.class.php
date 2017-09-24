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

class SessionValue extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'session_id', 'key', 'value'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'session_id', 'key', 'value'
        );
        
        // Table name:
        protected $_tableName               = 'session_value';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting SessionValue statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getSessionValue($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function deleteBySessionId($id){
                $strategy = \core\classes\sql\StrategyFactory::getSessionValueBySessionId();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('session_id' => $id)));
                    $mapper->setData($data);
                    return $mapper->delete();
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('delete'), 0, $ex);
                }
                return false;
            }// end deleteBySessionId
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}