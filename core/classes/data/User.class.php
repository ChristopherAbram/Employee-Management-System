<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date	24.08.2016
 */

namespace core\classes\data;

class User extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'password', 'firstname', 'lastname', 'email', 
            'phone', 'user_role_id', 'firstaccess', 'lastaccess', 'lastlogin',
            /*'avatar', */ 'sex', 'cdate', 'bdate', 'description', 'citation',
            'isactive', 'bin', 'token', 'profile'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'password', 'firstname', 'lastname', 'email', 
            'phone', 'user_role_id', 'firstaccess', 'lastaccess', 'lastlogin',
            'avatar', 'sex', 'cdate', 'bdate', 'description', 'citation',
            'isactive', 'bin', 'token', 'profile'
        );
        
        // Table name:
        protected $_tableName               = 'user';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting User statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getUser($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function countNotRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedUserCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function remove(){
                $strategy = \core\classes\sql\StrategyFactory::getRemovedUsers();
                return self::_remove($strategy, array());
            }// end remove
            
            public static function restore(){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllUsers();
                return self::_restore($strategy, array());
            }// end restore
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}