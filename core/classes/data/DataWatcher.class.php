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

class DataWatcher implements \core\interfaces\IdentityMap, \core\interfaces\UnitOfWork {
    // vars {
        
        // instance:
        private static $__instance = null;
        
        // Containers for data object that are in different states:
        private $_new           = array();
        private $_clean         = array();  // clean = unmodified or updated
        private $_delete        = array();
        private $_dirty         = array();  // dirty = modified
    
    // } methods {
    
        // public {
        
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
        
            public function add(\core\classes\data\Data $object){
                $this->addNew($object); // add as new
            }// end add
            
            public function exists(\core\classes\data\Data $object){
                $id = $object->getID();
                if(Data::correctID($id)){
                    $key = $this->key($object);
                    return (isset($this->_clean[$key]) || isset($this->_dirty[$key]) || isset($this->_delete[$key]));
                } 
                else {
                    return in_array($object, $this->_new, true);
                }
                return false;
            }// end exists
            
            public function get($classname, $id){
                $id = (int)$id;
                $key = $classname.$id;
                if(Data::correctID($id)){
                    if(isset($this->_clean[$key])){
                        return $this->_clean[$key];
                    }
                    else if(isset($this->_dirty[$key])){
                        return $this->_dirty[$key];
                    }
                    else if(isset($this->_delete[$key])){
                        return $this->_delete[$key];
                    }
                }
                return null;
            }// end get
            
            public function keyExists($classname, $id){
                $id = (int)$id;
                $key = $classname.$id;
                if(Data::correctID($id)){
                    return (isset($this->_clean[$key]) || isset($this->_dirty[$key]) || isset($this->_delete[$key]));
                }
                return false;
            }// end keyExists
            
            public function key(\core\classes\data\Data $object){
                return get_class($object).$object->getID();
            }// end key
            
            public function addClean(\core\classes\data\Data $object){
                if($this->__consistency($object)){
                    $this->_clean[$this->key($object)] = $object;
                }
            }// end addClean
            
            public function addDirty(\core\classes\data\Data $object){
                if($this->__consistency($object)){
                    $this->_dirty[$this->key($object)] = $object;
                }
            }// end addDirty
            
            public function addNew(\core\classes\data\Data $object){
                if(!Data::correctID($object->getID()) && $this->__consistency($object)){
                    $this->_new[] = $object;
                }
            }// end addNew
            
            public function addDelete(\core\classes\data\Data $object){
                if($this->__consistency($object)){
                    $this->_delete[$this->key($object)] = $object;
                    $object->notify(Data::DELETE_);
                }
            }// end addDelete
            
            public function remove(\core\classes\data\Data $object){
                if(Data::correctID($object->getID())){
                    $key = $this->key($object);
                    if(isset($this->_clean[$key])){
                        unset($this->_clean[$key]);
                    }
                    if(isset($this->_dirty[$key])){
                        unset($this->_dirty[$key]);
                    }
                    if(isset($this->_delete[$key])){
                        unset($this->_delete[$key]);
                    }
                }
                else {
                    $this->_new = array_filter(
                            $this->_new, 
                            function($ob) use ($object) { 
                                return !($ob === $object);
                            }
                        );
                }
            }// end remove
            
            public function perform(){
                $p = true;
                // Save new data objects:
                foreach($this->_new as $object){
                    if(!$object->create()){
                        $p = false;
                    }
                }
                $this->_new = array();
                
                // Update "dirty" data objects:
                foreach($this->_dirty as $object){
                    if(!$object->update()){
                        $p = false;
                    }
                }
                $this->_dirty = array();
                
                // Delete data objects marked to be deleted:
                foreach($this->_delete as $object){
                    if(!$object->delete()){
                        $p = false;
                    }
                }
                $this->_delete = array();
                return $p;
            }// end perform
        
        // } protected {
            
            
            
        // } private {
            
            private function __construct(){}
            
            private function __notifyExistance(
                    \core\classes\data\Data $ob1,
                    \core\classes\data\Data $ob2){
                if(!($ob1 === $ob2)){
                    $ob1->notify(Data::ALREADY_EXISTS_);
                    return false;
                }
                return true;
            }// end __notifyExistance
            
            private function __consistency(\core\classes\data\Data $object){
                $id = $object->getID();
                $p = true;
                $q = true;
                $s = true;
                if(Data::correctID($id)){
                    $key = $this->key($object);
                    if(isset($this->_clean[$key])){
                        $p = $this->__notifyExistance($object, $this->_clean[$key]);
                        if($p) unset($this->_clean[$key]);
                    }
                    if(isset($this->_dirty[$key])){
                        $q = $this->__notifyExistance($object, $this->_dirty[$key]);
                        if($q) unset($this->_dirty[$key]);
                    }
                    if(isset($this->_delete[$key])){
                        $s = $this->__notifyExistance($object, $this->_delete[$key]);
                        if($s) unset($this->_delete[$key]);
                    }
                }
                else {
                    $this->_new = array_filter(
                            $this->_new, 
                            function($ob) use ($object) { 
                                return !($ob === $object);
                            }
                        );
                }
                return ($p && $q && $s);
            }// end __consistency
        
        // }
    // }
}