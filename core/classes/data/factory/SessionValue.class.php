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

class SessionValue extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return self::_getDataObject('SessionValue', $id);
            }// end getById
            
            public function getBySessionId($id){
                $strategy = \core\classes\sql\StrategyFactory::getSessionValueBySessionId();
                try {
                    return $this->_getSetById($strategy, $id, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('session_value_by_session_id'), 0, $ex);
                }
                return null;
            }// end getBySessionId
            
            public function getBySessionIdAndByKey($id, $key){
                $strategy = \core\classes\sql\StrategyFactory::getSessionValueByKey();
                try {
                    $data = array(
                        'id'  => $id,
                        'key' => $key
                    );
                    return $this->_findIdByData($strategy, $data, 'id', 'SessionValue');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('session_value_by_key'), 0, $ex);
                }
                return null;
            }// end getBySID
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\SessionValue($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}