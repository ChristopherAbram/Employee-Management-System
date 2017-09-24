<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\operation
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\operation;

class MultipleRequest extends Operation {
    // vars {
        
        protected $_names       = array();
        
        protected $_arguments   = array();
        
    // } methods {
    
        // public {
            
            public function __construct(){
                parent::__construct();
            }
            
            public function setNames(array $names){
                $this->_names = $names;
            }// end setNames
            
        // } protected {
            
            protected function _perform(){
                
            }
            
            protected function _save(){
                
            }
            
            protected function _update(){
                if($this->_extractRequest()){
                    \rewind($this->_names);
                    $key = \current($this->_names);
                    foreach($this->_arguments[$key] as $name => $value){
                        
                        $args = array();
                        foreach($this->_names as $n){
                            
                        }
                        
                        /*$page = $factory->getById($id);
                        if(!is_null($page)){
                            $page->setAttributeList($attributes);
                            $data = $page->getData();
                            // Change data:
                            $data[$column] = $value;
                            $page->setData($data);
                        }*/
                    }
                }
            }
            
            protected function _delete(){
                
            }
            
            protected function _extractRequest(){
                foreach($this->_names as $name){
                    if(!isset($this->_request[$name])){
                        return false;
                    }
                    $this->_arguments[$name] = $this->_arguments[$name];
                }
                return true;
            }// end _extractRequest
            
        // } private {
            
            
            
        // }
    // }
}