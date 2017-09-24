<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form;

class Form extends \SplObjectStorage {
    // vars {
        
        protected $_id              = null;
        
        protected $_submits         = array();
        
        protected $_dependencies    = array();
        
        
    // } methods {
    
        // public {
            
           public function __construct($id){
               $this->_id = $id;
           }// end __construct
           
           public function id($id = null){
               if(!is_null($id)){
                   $this->_id = $id;
               }
               return $this->_id;
           }// end id
           
           public function attach($object, $data = null) {
               if($object instanceof \core\classes\form\field\Field){
                   $object->form($this->_id);
                   parent::attach($object, $data);
               }
               else if($object instanceof Mediator){
                   $this->addDependency($object);
               }
               if(($object instanceof \core\classes\form\field\Submit) ||
                  ($object instanceof \core\classes\form\field\SubmitButton)){
                   $this->_submits[$object->name()] = $object;
                   //parent::attach($object, $data);
               }
           }// end attach
           
           public function addSubmit(\core\classes\form\field\Field $field){
               $this->attach($field);
               $this->_submits[$field->name()] = $field;
           }// end addSubmit
           
           public function addDependency(Mediator $mediator){
                $this->_dependencies[] = $mediator;
           }// end addDependency
           
           public function perform(){
                $p = false;
                if($this->_submitted()){
                    $p = true;
                    // Validating form:
                    foreach($this as $field){
                        $field->validate();
                        if($field->error()){
                            $p = false;
                        }
                    }
                    // Executing additional dependencies:
                    foreach($this->_dependencies as $dependency){
                        $dependency->execute();
                        if(!$dependency->correct()){
                            $p = false;
                        }
                    }
                }
                return $p;
           }// end perform
           
           public function submitted(){
               return $this->_submitted();
           }// end submitted
           
        // } protected {
            
            protected function _submitted(){
                foreach($this->_submits as $button){
                    if($button->submitted()){
                        return true;
                    }
                }
                return false;
            }// end _submitted
            
        // } private {
            
            
            
        // }
    // }
}