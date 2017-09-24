<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\collection\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\domain\collection\set;

abstract class Set extends \SplObjectStorage {
    // vars {
    
        
    
    // } methods {
    
        // public {
            
            public function __construct(array $ids = array(), \core\classes\data\collection\set\Set $set = null){
                if(!empty($ids)){
                    foreach($ids as $id){
                        $object = $this->_getDomainObject($id);
                        $this->attach($object);
                    }
                }
                else if(!is_null($set)){
                    foreach($set as $dataObject){
                        $object = $this->_getDomainObject(null, $dataObject);
                        $this->attach($object);
                    }
                }
            }// end __construct
            
            public function load(\core\classes\sql\attribute\AttributeList $attributeList = null){
                foreach($this as $obj){
                    if($obj instanceof \core\classes\domain\Domain){
                        $obj->load($attributeList);
                    }
                }
                return;
            }// end load
            
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
        
        // } protected {
            
            abstract protected function _getDomainObject($id = null, \core\classes\data\Data $dataObject = null);
            
        // } private {
            
        // }
    // }
}