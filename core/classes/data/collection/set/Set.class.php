<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data\collection\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\data\collection\set;

abstract class Set extends \SplObjectStorage {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function __construct(array $array_of_id = array()){
                foreach($array_of_id as $id){
                    $object = $this->_getDataObject($id);
                    $this->attach($object);
                }
            }// end __construct
            
            public function filter($callback){
                foreach($this as $object){
                    if(!\call_user_func($callback, $object)){
                        $this->detach($object);
                    }
                }
            }// end filter
            
            public function accept($callback){
                foreach($this as $object){
                    \call_user_func($callback, $object);
                }
            }// end accept
            
            public function lockForUpdate(){
                try {
                    if(\count($this) > 0){
                        $this->rewind();
                        $object = $this->current();
                        if(!is_null($object)){
                            $table = $object->getTableName();
                            $connection = \ConnectionRegistry::getUserEstablishedConnection();
                            if(is_null($connection)) throw new \Exception('');
                            $pdo = $connection->getPDO();
                            if(is_null($pdo)) throw new \Exception('');
                            $ids = implode(',', $this->_get_ids());
                            return ($pdo->exec('SELECT id FROM '.$table.' WHERE id IN('.$ids.') FOR UPDATE') !== false);
                        }
                    }
                    else {
                        return true;
                    }
                } catch(\Exception $ex){
                    throw new \core\classes\data\DataException(Error::get('lock_for_update'));
                }
                return false;
            }// end lockForUpdate
            
            public function lockInShareMode(){
                try {
                    if(\count($this) > 0){
                        $this->rewind();
                        $object = $this->current();
                        if(!is_null($object)){
                            $table = $object->getTableName();
                            $connection = \ConnectionRegistry::getUserEstablishedConnection();
                            if(is_null($connection)) throw new \Exception('');
                            $pdo = $connection->getPDO();
                            if(is_null($pdo)) throw new \Exception('');
                            $ids = implode(',', $this->_get_ids());
                            return ($pdo->exec('SELECT id FROM '.$table.' WHERE id IN('.$ids.') LOCK IN SHARE MODE') !== false);
                        }
                    }
                    else {
                        return true;
                    }
                } catch(\Exception $ex){
                    throw new \core\classes\data\DataException(Error::get('lock_in_share_mode'));
                }
                return false;
            }// end lockInShareMode
        
        // } protected {
            
            protected function _get_ids(){
                $ids = array();
                foreach($this as $object){
                    $ids[] = $object->getID();
                }
                return $ids;
            }// end _get_ids
            
            abstract protected function _getDataObject($id);
            
        // } private {
            
        // }
    // }
}