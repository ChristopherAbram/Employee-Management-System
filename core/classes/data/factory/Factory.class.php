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

abstract class Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
        
        // } protected {
            
            protected function _findId(\core\classes\sql\Strategy $strategy, $id, $array_key, $classname){
                $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                $data = new \core\classes\mapper\ResultSet(array(array('id' => $id)));
                $mapper->setData($data);
                if($mapper->select()){
                    $data = $mapper->getFirstRow();
                    if(array_key_exists($array_key, $data)){
                        $found_id = $data[$array_key];
                        return $this->_getDataObject($classname, $found_id);
                    }
                }
                return null;
            }// end _findId
            
            protected function _findIdByData(\core\classes\sql\Strategy $strategy, $data, $array_key, $classname){
                $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                $data = new \core\classes\mapper\ResultSet(array($data));
                $mapper->setData($data);
                if($mapper->select()){
                    $data = $mapper->getFirstRow();
                    if(array_key_exists($array_key, $data)){
                        $found_id = $data[$array_key];
                        return $this->_getDataObject($classname, $found_id);
                    }
                }
                return null;
            }// end _findId
            
            protected function _getSetById(\core\classes\sql\Strategy $strategy, $id, $array_key, $offset, $count){
                $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                $data = new \core\classes\mapper\ResultSet(array(
                        array(
                            'id'        => $id, 
                            'offset'    => $offset, 
                            'count'     => $count
                        )
                    ));
                $mapper->setData($data);
                
                if($mapper->select()){
                    $data = $mapper->getResult();
                    if(!is_null($data)){
                        $iter = $data->getIterator();
                        $ids = array();
                        foreach($iter as $key => $row){
                            if(array_key_exists($array_key, $row)){
                                $ids[] = $row[$array_key];
                            }
                        }
                        return $this->_getSet($ids);
                    }
                }
                return null;
            }// end _getSetById
            
             protected function _getSetByData(\core\classes\sql\Strategy $strategy, array $params, $array_key){
                $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                $data = new \core\classes\mapper\ResultSet(array($params));
                $mapper->setData($data);
                
                if($mapper->select()){
                    $data = $mapper->getResult();
                    if(!is_null($data)){
                        $iter = $data->getIterator();
                        $ids = array();
                        foreach($iter as $key => $row){
                            if(array_key_exists($array_key, $row)){
                                $ids[] = $row[$array_key];
                            }
                        }
                        return $this->_getSet($ids);
                    }
                }
                return null;
            }// end _getSetByData
            
            protected function _getDataObject($classname, $id){
                return \core\classes\data\Repository::get($classname, $id);
            }// end _getDataObject
            
            abstract protected function _getSet(array $ids = array());
            
        // } private {
            
        // }
    // }
}