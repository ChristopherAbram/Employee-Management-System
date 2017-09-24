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

class Session extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return self::_getDataObject('Session', $id);
            }// end getById
            
            public function getBySID($sid){
                $strategy = \core\classes\sql\StrategyFactory::getSessionBySID();
                try {
                    $session_expire = \ApplicationRegistry::getSessionExpireTime();
                    $old_session_duration = \ApplicationRegistry::getOldSessionDuration();
                    $data = array(
                        'sid' => $sid,
                        'old_session_duration' => $old_session_duration,
                        'last' => $session_expire
                    );
                    return $this->_findIdByData($strategy, $data, 'id', 'Session');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('session_by_sid'), 0, $ex);
                }
                return null;
            }// end getBySID
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\UserPage($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}