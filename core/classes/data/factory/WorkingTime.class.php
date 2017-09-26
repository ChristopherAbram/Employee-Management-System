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

class WorkingTime extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('WorkingTime', $id);
            }// end getById
            
            public function getAll(){
                $strategy = \core\classes\sql\StrategyFactory::getAllWorkingTimes();
                try {
                    $data = array();
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('all_working_times'), 0, $ex);
                }
                return null;
            }// end getAll
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\WorkingTime($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}