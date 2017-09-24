<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\pdo
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

namespace core\classes\pdo;

class PDO extends \PDO {
    // vars {
        
        protected static $_nestable_engines = array('mysql');
        
        protected $_transaction_level = -1;
        
    // } methods {
        
        // public {
            
            public function beginTransaction() {
                if(!$this->_nestable() || $this->_transaction_level == -1){
                    if(parent::beginTransaction()){
                        $this->_transaction_level = 0;
                        return true;
                    }
                }
                else {
                    $this->_transaction_level++;
                    if($this->exec('SAVEPOINT LEVEL'.$this->_transaction_level) !== false){
                        return true;
                    } 
                    else {
                        $this->_transaction_level--;
                    }
                }
                return false;
            }// end beginTransaction
            
            public function startTransaction(){
                return $this->beginTransaction();
            }// end startTransaction
            
            public function commit(){
                if(!$this->_nestable() || $this->_transaction_level == 0){
                    if(parent::commit()){
                        $this->_transaction_level = -1;
                        return true;
                    }
                }
                else {
                    if($this->exec('RELEASE SAVEPOINT LEVEL'.$this->_transaction_level) !== false){
                        $this->_transaction_level--;
                        return true;
                    }
                }
                return false;
            }// end commit
            
            public function rollBack() {
                if(!$this->_nestable() || $this->_transaction_level == 0){
                    if(parent::rollBack()){
                        $this->_transaction_level = -1;
                        return true;
                    }
                }
                else {
                    if($this->exec('ROLLBACK TO SAVEPOINT LEVEL'.$this->_transaction_level) !== false){
                        $this->_transaction_level--;
                        return true;
                    }
                }
                return false;
            }// end rollBack
            
            public function savepoint($identifier){
                return ($this->exec('SAVEPOINT '.$identifier) !== false);
            }// end savepoint
            
            public function rollBackToSavapoint($identifier){
                return ($this->exec('ROLLBACK TO SAVEPOINT '.$identifier) !== false);
            }// end rollBackToSavepoints
            
            public function releaseSavepoint($identifier){
                return ($this->exec('RELEASE SAVEPOINT '.$identifier) !== false);
            }// end releaseSavepoint
            
            public function setGlobalTransactionIsolationLevel($level){
                if($this->_isolation_level($level)){
                    return ($this->exec('SET GLOBAL TRANSACTION ISOLATION LEVEL '.$level) !== false );
                }
                return false;
            }// end setGlobalTransactionIsolationLevel
            
            public function setSessionTransactionIsolationLevel($level){
                if($this->_isolation_level($level)){
                    return ($this->exec('SET SESSION TRANSACTION ISOLATION LEVEL '.$level) !== false);
                }
                return false;
            }// end setSessionTransactionIsolationLevel
            
            public function setTransactionIsolationLevel($level){
                if($this->_isolation_level($level)){
                    return ($this->exec('SET TRANSACTION ISOLATION LEVEL '.$level) !== false);
                }
                return false;
            }// end setTransactionIsolationLevel
            
            public function setGlobsalTransaction($state){
                
            }// end setGlobalTransaction
            
            public function setSessionTransaction($state){
                
            }// end setSessionTransaction
            
            public function setTransaction($state){
                
            }// end setTransaction
            
            public function lockTableForRead($tableName){
                return ($this->exec('LOCK TABLE '.$tableName.' READ') !== false);
            }// end lockTableForRead
            
            public function lockTableForWrite($tableName){
                return ($this->exec('LOCK TABLE '.$tableName.' WRITE') !== false);
            }// end lockTableForWrite
            
            public function unlockTables(){
                return ($this->exec('UNLOCK TABLES') !== false);
            }// end unlockTables
            
        // } protected {
            
            protected function _nestable(){
                $attribute = $this->getAttribute(\PDO::ATTR_DRIVER_NAME);
                return \in_array($attribute, self::$_nestable_engines);
            }// end _nestable
            
            protected function _isolation_level($level){
                if(\in_array($level, array(READ_UNCOMMITED, READ_COMMITED, REPEATABLE_READ, SERIALIZABLE))){
                    return true;
                }
                return false;
            }// end _isolation_level
            
        // } private {
            
            
            
        // }
    // }
}