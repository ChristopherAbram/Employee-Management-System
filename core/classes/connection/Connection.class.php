<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\connection
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

namespace core\classes\connection;

class Connection {
    // vars {
        
        // Connection instance for each DSN:
        private static $__instances = array();
        
        // Data Source Name:
        private $__DSN;
        
        // User Connection Data:
        private $__username = null;
        private $__password = null;
        
        // PHP Data Object:
        private $__PDO = null;
        private $__options = array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION  // default option
        );
    
    // } methods {
    
        // public {
            
            public static function getInstance($dsn){
                if(!is_string($dsn) || strlen($dsn) == 0){
                    throw new ConnectionException(Error::get('bad_dsn'));
                }
                if(!isset(self::$__instances[$dsn])){
                    self::$__instances[$dsn] = new self($dsn);
                }
                return self::$__instances[$dsn];
            }// end getInstance
            
            public function establish($username = null, $password = null, $options = array()){
                if($username === null || $password === null){
                    // reconnect with current data, if data null throw exception
                } else {
                    $this->__username = $username;
                    $this->__password = $password;
                    $this->__options = $options;
                }
                
                if($this->__username === null || $this->__password === null){
                    throw new ConnectionException(Error::get('connection_bad_data'));
                }
                
                try {
                    $pdo = $this->_create_PDO();
                    $this->__PDO = $pdo;
                    $this->_init();
                } catch (\PDOException $pdoe) {
                    throw new ConnectionException(Error::get('connection_failed'), 0, $pdoe);
                }
                return true;
            }// end establish
            
            public static function exists($dsn){
                return isset(self::$__instances[$dsn]);
            }// end exists
            
            public function getDSN(){
                return $this->__DSN;
            }// end getDSN
            
            public function getPDO(){
                return $this->__PDO;
            }// end getPDO
            
        // } protected {
            
            protected function _create_PDO(){
                return new \core\classes\pdo\PDO($this->__DSN, $this->__username, $this->__password, $this->__options);
            }// end _create_PDO
            
            protected function _init(){
                if($this->__PDO){
                    // Recursion maximum level:
                    $this->__PDO->exec('SET max_sp_recursion_depth = '.\ApplicationRegistry::getMaxSPRecursionDepth());
                    // Event scheduler must be enable:
                    $this->__PDO->exec('SET @@global.event_scheduler = 1');
                }
            }// end _init
            
        // } private {
            
            private function __construct($dsn){
                $this->__DSN = $dsn;
            }
            
        // }
    // }
}