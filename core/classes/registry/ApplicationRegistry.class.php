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

class ApplicationRegistry extends \Registry {
    // vars {
    
        private static $__instance              = null;
        
        private $__map                          = array();
        
        private static $__controllerMap         = null;
        
        // Configuration .ini file dirpath:
        private $__relativePath                 = '../../../private';
        
        // Configuration .ini file name:
        private $__fileName                     = 'configuration.setting.ini';
        
        // User instance:
        private $__User                         = null;
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public static function getCurrentUser(){
                return self::getInstance()->__User;
            }// end getCurrentUser
            
            public static function setCurrentUser(\core\classes\domain\User $user){
                self::getInstance()->__User = $user;
            }// end setCurrentUser
            
            public static function getDSN($dsnName){
                $a = self::getInstance();
                if(isset($a->get('dsn')[$dsnName])){
                    return $a->get('dsn')[$dsnName];
                }
                return null;
            }// end getDSN
            
            public static function getDefaultDSN(){
                $default_dsn_name = self::getInstance()->get('default_dsn_name');
                return self::getDSN($default_dsn_name);
            }// end getDefaultDSN
            
            public static function getMaxSPRecursionDepth(){
                $max_sp_recursion_depth = self::getInstance()->get('max_sp_recursion_depth');
                return (int)$max_sp_recursion_depth;
            }// end getMaxSPRecursionDepth
            
            public static function getConnectionTimeoutValue(){
                $connection_timeout = (int)self::getInstance()->get('connection_timeout');
                $connection_timeout = $connection_timeout != 0 ? $connection_timeout : 60;
                return $connection_timeout;
            }// end getConnectionTimeoutValue
            
            public static function getSessionRegenerationInterval(){
                $sri = (int)self::getInstance()->get('session_regeneration_interval');
                $sri = $sri != 0 ? $sri : 60;
                return $sri;
            }// end getSessionRegenerationInterval
            
            public static function getGuestUser(){
                $guest = new \core\classes\domain\Guest();
                return array(
                    'role'      => $guest->roleAsString(),
                    'username'  => self::getInstance()->get('guest'),
                    'password'  => self::getInstance()->get('guestpassword')
                );
            }// end getGuestUser
            
            public static function getRootUser(){
                return array(
                    'username'  => self::getInstance()->get('root'),
                    'password'  => self::getInstance()->get('rootpassword')
                );
            }// end getRootUser
            
            public static function getRegisterUser(){
                return array(
                    'username' => self::getInstance()->get('register'),
                    'password' => self::getInstance()->get('registerpassword')
                );
            }// end getRegisterUser
            
            public static function getSessionExpireTime(){
                return self::getInstance()->get('session_expire_time');
            }// end getSessionExpireTime
            
            public static function getOldSessionDuration(){
                return self::getInstance()->get('old_session_duration');
            }// end getOldSessionDuration
            
            public static function getTmpDir(){
                return dirname(__FILE__).'/../../../'.self::getInstance()->get('tmp_dir');
            }// end getTmpDir
            
            public static function setControllerMap(\core\classes\controller\Map $map){
                self::$__controllerMap = $map;
            }// end setControllerMap
            
            public static function getControllerMap(){
                return self::$__controllerMap;
            }// end getControllerMap
            
            public static function getApplicationController(){
                if(!is_null(self::$__controllerMap)){
                    return new \core\classes\controller\application\Controller(\core\classes\request\Request::CMD, self::$__controllerMap);
                }
                return null;
            }// end getApplicationController
            
        // } protected {
        
            protected function set($key, $value){
                //$this->__map[$key] = $value;
            }// end set
            
            protected function get($key){
                if(isset($this->__map[$key]))
                    return $this->__map[$key];
                return null;
            }// end get
            
        // } private {
            
            private function __load_ini_file(){
                $configurationFile = realpath( dirname(__FILE__).'/'.$this->__relativePath.'/'.$this->__fileName );
                
                if(file_exists($configurationFile)){
                    if(($this->__map = parse_ini_file($configurationFile, FALSE)) === FALSE){
                        throw new \Exception(\core\functions\replace(
                                \Error::get('parse_configuration_file_failed'), 
                                array('$file' => $this->__fileName)
                                ));
                    }
                } else {
                    throw new \Exception(\core\functions\replace(
                            \Error::get('configuration_file_not_exists'),
                            array('$file' => $this->__fileName)
                            ));
                }
            }
        
            private function __construct(){
                // Loads configuration file:
                $this->__load_ini_file();
                // User init:
                
            }// end __construct
            
        // }
    // }
}