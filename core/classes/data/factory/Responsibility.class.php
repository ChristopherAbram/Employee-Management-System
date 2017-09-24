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

class Responsibility extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Responsibility', $id);
            }// end getById
            
            public function getAll($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllResponsibilities();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'offset' => $offset,
                        'count'  => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('all_responsibilities'), 0, $ex);
                }
                return null;
            }// end getAll
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Responsibility($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}