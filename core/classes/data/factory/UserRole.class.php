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

class UserRole extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('UserRole', $id);
            }// end getById
            
            public function getByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserRoleByUserId();
                try {
                    return $this->_findId($strategy, $id, 'user_role_id', 'UserRole');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('userrole_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\UserRole($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}