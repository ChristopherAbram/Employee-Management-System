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

class Address extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Address', $id);
            }// end getById
            
            public function getByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getAddressByUserId();
                try {
                    return $this->_findId($strategy, $id, 'address_id', 'Address');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('address_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Address($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}