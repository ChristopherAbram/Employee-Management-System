<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\data;

abstract class Data implements \core\interfaces\CRUD, \Serializable {
    // vars {
        
        // Data mapper instance:
        protected $_mapper                  = null;
        
        // Default attribute list:
        protected $_defaultAttributeList    = array();
        
        // All attribute list:
        protected $_allAttributeList        = array();
        
        // Attribute list:
        protected $_attributeList           = null;
        
        // Strategy:
        protected $_strategy                = null;
        
        // Identifier, read-only property:
        protected $_id                      = null;
        
        // Outer status:
        protected $_status                  = null;
        
        // Inner status:
        private $_innerStatus               = null;
        
        /* Statuses */
        const NEW_              = 1;
        const EMPTY_            = 2;
        const FULL_             = 4;
        const CLEAN_            = 8;
        const DIRTY_            = 16;
        const REMOVED_          = 32;
        
        // Outer statuses:
        const DELETE_           = 64;
        const ALREADY_EXISTS_   = 128;
        
        // Table name:
        protected $_tableName   = null;
        
        // Index name:
        protected $_indexName   = 'id';
        
        // Data storage:
        protected $_data        = array();
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                $this->_id = (int)$id;
                $this->_status = 0;
                if(!self::correctID($this->_id)){
                    $this->_mark(self::NEW_);
                } else {
                    $this->_data[$this->_getIndexName()] = (int)$this->_id;
                    $this->_mark(self::EMPTY_);
                }
            }// end __construct
            
            public function getDefaultAttributeList(){
                return new \core\classes\sql\attribute\AttributeList($this->_defaultAttributeList);
            }// end getDefaultAttributeList
            
            public function getAllAttributeList(){
                return new \core\classes\sql\attribute\AttributeList($this->_allAttributeList);
            }// end getDefaultAttributeList
            
            public function getAttributeList(){
                if(is_null($this->_attributeList) || $this->_attributeList->isEmpty()){
                    return $this->getDefaultAttributeList();
                }
                return $this->_attributeList;
            }// end getAttributeList
            
            public function setAttributeList(\core\classes\sql\attribute\AttributeList $attributeList){
                $this->_attributeList = $attributeList;
                $this->_strategy->getSelectStatement()->setAttributeList($this->_attributeList);
                $this->_strategy->getInsertStatement()->setAttributeList($this->_attributeList);
                $this->_strategy->getUpdateStatement()->setAttributeList($this->_attributeList);
                return;
            }// end setAttributeList
            
            public function getStrategy(){
                return $this->_strategy;
            }// end getStrategy
            
            public function getMapper(){
                return $this->_mapper;
            }// end getMapper
            
            public function setStrategy(\core\classes\sql\Strategy $strategy){
                $this->_strategy = $strategy;
                $this->_mapper->setStrategy($strategy);
            }// end setStrategy
            
            
            
            
            
            
            public function getData(){
                return $this->_data;
            }// end getData
            
            public function &getDataReference(){
                return $this->_data;
            }// end getDataReference
            
            public function setData(array $data){
                $this->_data = $data;
                if($this->__modifiable()){
                    $this->_mark(self::DIRTY_);
                }
            }// end setData
            
            
            
            
            public function __clone(){
                throw new DataException(Warning::get('clone_forbidden'));
            }// end __clone
            
            public function serialize(){
                throw new DataException(Warning::get('serialization_forbidden'));
            }// end serialize
            
            public function unserialize($serialized){
                throw new DataException(Warning::get('unserialization_forbidden'));
            }// end serialize
            
            
            
            
            public function getStatus(){
                return $this->_innerStatus;
            }
            
            public function getID(){
                return (int)$this->_id;
            }// end getID
            
            public function getTableName(){
                return $this->_tableName;
            }// end getTableName
            
            public function notify($status){
                if(in_array($status, array(self::DELETE_, self::ALREADY_EXISTS_))){
                    $this->_mark($status);
                }
            }// end notify
            
            public function exists(){
                if($this->getStatus() != self::NEW_ && $this->getStatus() != self::EMPTY_){
                    return true;
                }
                return false;
            }// end exists
            
            public function create(){
                if($this->__createable()){
                    if($this->_create()){
                        $this->_mark(self::CLEAN_);
                        return true;
                    }
                }
                return false;
            }// end create
            
            public function read(){
                if($this->__readable()){
                    if($this->_read()){
                        $this->_mark(self::CLEAN_);
                        return true;
                    }
                } 
                else if($this->__readunnecessary()){
                    return true;
                }
                return false;
            }// end read
            
            public function update(){
                if($this->__updateable()){
                    if($this->_update()){
                        $this->_mark(self::CLEAN_);
                        return true;
                    }
                }
                else if($this->__updateunnecessary()){
                    return true;
                }
                return false;
            }// end update
            
            public function delete(){
                if($this->__deleteable()){
                    if($this->_delete()){
                        $this->_mark(self::REMOVED_);
                        $this->_unsetData();
                        return true;
                    }
                }
                return false;
            }// end delete
            
            public function lockForUpdate(){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    if(is_null($connection)) throw new \Exception('');
                    $pdo = $connection->getPDO();
                    if(is_null($pdo)) throw new \Exception('');
                    //echo 'SELECT id INTO @last_locked_id FROM '.$this->_tableName.' WHERE id = '.$this->getID().' FOR UPDATE'."</br>";
                    return ($pdo->exec('SELECT id INTO @last_locked_id FROM '.$this->_tableName.' WHERE id = '.$this->getID().' FOR UPDATE') !== false);
                } catch(\exception $ex){
                    throw new \core\classes\data\DataException(Error::get('lock_for_update'));
                }
            }// end lockForUpdate
            
            public function lockInShareMode(){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    if(is_null($connection)) throw new \Exception('');
                    $pdo = $connection->getPDO();
                    if(is_null($pdo)) throw new \Exception('');
                    return ($pdo->exec('SELECT id INTO @last_locked_id FROM '.$this->_tableName.' WHERE id = '.$this->getID().' LOCK IN SHARE MODE') !== false);
                } catch(\exception $ex){
                    throw new \core\classes\data\DataException(Error::get('lock_in_share_mode'));
                }
            }// end lockInShareMode
            
            public static function correctID($id){
                return (!is_null($id) && is_int($id) && $id > 0);
            }// end correctID
        
        // } protected {
            
            protected function _unsetData(){
                unset($this->_data);
                $this->_data = array();
            }// end _unsetData
            
            protected function _getTableName(){
                return $this->_tableName;
            }// end _getTableName
            
            protected function _getIndexName(){
                return $this->_indexName;
            }// end _getIndexName
            
            protected function _getDataMapper(){
                return $this->_mapper;
            }// end _getDataMapper
            
            protected function _mark($status){
                $watcher = DataWatcher::getInstance();
                switch($status){
                    case self::NEW_:
                        $watcher->addNew($this);
                        $this->_innerStatus = self::NEW_;
                        break;
                    case self::EMPTY_:
                        $watcher->addClean($this);
                        $this->_innerStatus = self::EMPTY_;
                        break;
                    case self::CLEAN_:
                        $watcher->addClean($this);
                        if($this->_innerStatus & self::FULL_){
                            $this->_innerStatus = self::FULL_ | self::CLEAN_;
                        } 
                        else {
                            $this->_innerStatus = self::CLEAN_;
                        }
                        break;
                    case self::DELETE_:
                        //$watcher->addDelete($this); // recursive...
                        $this->_status = self::DELETE_;
                        break;
                    case self::DIRTY_:
                        $watcher->addDirty($this);
                        if($this->_innerStatus & self::FULL_){
                            $this->_innerStatus = self::FULL_ | self::DIRTY_;
                        } 
                        else {
                            $this->_innerStatus = self::DIRTY_;
                        }
                        break;
                    case self::FULL_:
                        if($this->_innerStatus & self::DIRTY_){
                            $this->_innerStatus = self::FULL_ | self::DIRTY_;
                        } 
                        else if($this->_innerStatus & self::CLEAN_) {
                            $this->_innerStatus = self::FULL_ | self::CLEAN_;
                        }
                        else {
                            $this->_innerStatus = self::FULL_;
                        }
                        break;
                    case self::REMOVED_:
                        $watcher->remove($this);
                        $this->_innerStatus = self::REMOVED_;
                        break;
                    case self::ALREADY_EXISTS_:
                        $this->_status = self::ALREADY_EXISTS_;
                        break;
                }
                return;
            }// end mark
            
            protected function _isFull(){
                if(!self::correctID($this->getID())){
                    return false;
                }
                $allAttributeList = $this->getAllAttributeList();
                foreach($allAttributeList as $attributeName){
                    if(!\array_key_exists($attributeName, $this->_data)){
                        return false;
                    }
                }
                return true;
            }// end _isFull
            
            protected function _create(){
                try {
                    $mapper = $this->_getDataMapper();
                    $mapper->setData(new \core\classes\mapper\ResultSet(array($this->_data)));
                    $exe = $mapper->insert();
                    if($exe){
                        // Get ID:
                        $id = $mapper->lastInsertId();
                        if(self::correctID($id)){
                            $this->_data[$this->_getIndexName()] = $id;
                            $this->_id = $id;
                        }
                        else {
                            // What if id is still unknown...?
                        }
                        if($this->_isFull()){
                            $this->_mark(self::FULL_);
                        }
                    }
                    return $exe;
                } catch (\core\classes\mapper\MapperException $ex){
                    throw new DataException(Error::get('create'), 0, $ex);
                }
                return false;
            }// end _create
            
            protected function _read(){
                if(!self::correctID($this->getID())){
                    return false;
                }
                try {
                    $mapper = $this->_getDataMapper();
                    $mapper->setData(new \core\classes\mapper\ResultSet(array(array($this->_getIndexName() => $this->getID()))));
                    $exe = $mapper->select();
                    if($exe){
                        // Extracting results:
                        $result = $mapper->getResult();
                        $iter = $result->getIterator();
                        $iter->rewind();
                        if($iter->valid()){
                            $this->_data += $iter->current();
                        }
                        else {
                            return false;
                        }
                        if($this->_isFull()){
                            $this->_mark(self::FULL_);
                        }
                    }
                    return $exe;
                } catch (\core\classes\mapper\MapperException $ex){
                    throw new DataException(Error::get('read'), 0, $ex);
                }
                return false;
            }// end _read
            
            protected function _update(){
                if(!self::correctID($this->getID())){
                    return false;
                }
                try {
                    $mapper = $this->_getDataMapper();
                    $mapper->setData(new \core\classes\mapper\ResultSet(array($this->_data)));
                    $exe = $mapper->update();
                    if($exe && $this->_isFull()){
                        $this->_mark(self::FULL_);
                    }
                    return $exe;
                } catch (\core\classes\mapper\MapperException $ex){
                    throw new DataException(Error::get('update'), 0, $ex);
                }
                return false;
            }// end _update
            
            protected function _delete(){
                if(!self::correctID($this->getID())){
                    return false;
                }
                try {
                    $mapper = $this->_getDataMapper();
                    $mapper->setData(new \core\classes\mapper\ResultSet(array(array($this->_getIndexName() => $this->getID()))));
                    $exe = $mapper->delete();
                    return $exe;
                } catch (\core\classes\mapper\MapperException $ex){
                    throw new DataException(Error::get('delete'), 0, $ex);
                }
                return false;
            }// end _delete
            
            protected static function _count(\core\classes\sql\Strategy $strategy, $params){
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array($params));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('count', $data)){
                            $count = (int)$data['count'];
                            return $count;
                        }
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('count'), 0, $ex);
                }
                return null;
            }// end _count
            
            protected static function _remove(\core\classes\sql\Strategy $strategy, $params){
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array($params));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('remove'), 0, $ex);
                }
                return false;
            }// end remove
            
            protected static function _restore(\core\classes\sql\Strategy $strategy, $params){
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array($params));
                    $mapper->setData($data);
                    if($mapper->update()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('restore'), 0, $ex);
                }
                return false;
            }// end restore
            
        // } private {
            
            private function __createable(){
                return ($this->_innerStatus == self::NEW_);
            }// end __createable
            
            private function __readable(){
                return (($this->_status != self::ALREADY_EXISTS_) && ($this->_innerStatus == self::EMPTY_ || $this->_innerStatus == self::CLEAN_));
            }// end __readable
            
            private function __readunnecessary(){
                return (($this->_status != self::ALREADY_EXISTS_) && ($this->_innerStatus & self::FULL_));
            }// end __readunnecessary
            
            private function __updateable(){
                return (($this->_status != self::ALREADY_EXISTS_) && ($this->_innerStatus & self::DIRTY_));
            }// end __updateable
            
            private function __updateunnecessary(){
                return (($this->_status != self::ALREADY_EXISTS_) && ($this->_innerStatus & self::CLEAN_));
            }// end __updateunnecessary
            
            private function __deleteable(){
                return (($this->_status != self::ALREADY_EXISTS_) && (($this->_innerStatus == self::EMPTY_) || ($this->_innerStatus & self::CLEAN_) || ($this->_innerStatus & self::DIRTY_)));
            }// end __deleteable
            
            private function __modifiable(){
                return (($this->_innerStatus & self::CLEAN_) || ($this->_innerStatus & self::DIRTY_)) || ($this->_innerStatus == self::EMPTY_);
            }// end __modifiable
            
        // }
    // }
}