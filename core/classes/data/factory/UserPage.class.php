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

class UserPage extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return self::_getDataObject('UserPage', $id);
            }// end getById
            
            public function getByPageId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserPageByPageId();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_page_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserPageByUserId();
                try {
                    //$offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', 0, 0);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('user_page_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\UserPage($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}