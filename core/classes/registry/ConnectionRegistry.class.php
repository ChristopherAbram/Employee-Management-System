<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\registry
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

class ConnectionRegistry extends \Registry {
    // vars {
    
        private static $__instance = null;
        
        private static $__user_connection = null;
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public static function getConnection($connectionName){
                return self::getInstance()->get($connectionName);
            }// end getConnection
            
            public static function getDefaultConnection(){
                $dsn = \ApplicationRegistry::getDefaultDSN();
                return self::getInstance()->get($dsn);
            }// end getDefaultConnection
            
            public static function getDefaultEstablishedConnection(){
                $connection = self::getDefaultConnection();
                if(!is_null($connection)){
                    $connection->establish('username', 'password');
                    return $connection;
                }
                return null;
            }// end getDefaultEstablishedConnection
            
            public static function establishUserConnection(){
                $connection = self::getDefaultConnection();
                if(!is_null($connection)){
                    $user = \ApplicationRegistry::getRootUser();
                    $connection->establish($user['username'], $user['password']);
                    self::$__user_connection = $connection;
                    return $connection;
                }
                return null;
            }// end establishUserConnection
            
            public static function getUserEstablishedConnection(){
                if(is_null(self::$__user_connection)){
                    self::establishUserConnection();
                }
                return self::$__user_connection;
            }// end getUserEstablishedConnection
            
            public static function getRootEstablishedConnection(){
                $connection = self::getDefaultConnection();
                if(!is_null($connection)){
                    $user = \ApplicationRegistry::getRootUser();
                    $connection->establish($user['username'], $user['password']);
                    return $connection;
                }
                return null;
            }// end getRootEstablishedConnection
            
            public static function setConnectionTimeout($seconds){
                $p = ini_set('mysql.connect_timeout', $seconds);
                $q = ini_set('default_socket_timeout', $seconds);
                return $p && $q;
            }// end setConnectionTimeout
            
        // } protected {
        
            protected function set($key, $value){
                return;
            }// end set
            
            protected function get($dsn){
                //if(\core\classes\connection\Connection::exists($dsn)){
                return \core\classes\connection\Connection::getInstance($dsn);
                //}
                //return null;
            }// end get
            
        // } private {
        
            private function __construct(){}
            
        // }
    // }
}