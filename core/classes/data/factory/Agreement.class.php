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

class Agreement extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Agreement', $id);
            }// end getById
            
            public function getAll($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllAgreements();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'offset' => $offset,
                        'count'  => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getAll
            
            public function getByUserId($id, $pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAgreementsByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'user_id'=> $id,
                        'offset' => $offset,
                        'count'  => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Agreement($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}