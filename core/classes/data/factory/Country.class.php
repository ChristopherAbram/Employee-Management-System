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

class Country extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Country', $id);
            }// end getById
            
            public function getByAddressId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountryByAddressId();
                try {
                    return $this->_findId($strategy, $id, 'country_id', 'Country');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('country_by_address_id'), 0, $ex);
                }
                return null;
            }// end getByAddressId
            
            public function getByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountryByUserId();
                try {
                    return $this->_findId($strategy, $id, 'country_id', 'Country');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('country_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getAll(){
                $strategy = \core\classes\sql\StrategyFactory::getAllCountries();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array()));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getResult();
                        if(!is_null($data)){
                            $iter = $data->getIterator();
                            $ids = array();
                            foreach($iter as $key => $row){
                                if(array_key_exists('id', $row)){
                                    $ids[] = $row['id'];
                                }
                            }
                            return $this->_getSet($ids);
                        }
                    }
                } catch(\core\classes\mapper\MapperException $ex){
                    throw new \core\classes\data\DataException(Error::get('country_all'), 0, $ex);
                }
                return null;
            }// end getAll
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Country($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}