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

class Mediator {
    // vars {
        
        protected $_fields          = array();
        
        protected $_dependency      = null;
        
        protected $_is_correct      = true;
        
    // } methods {
    
        // public {
            
           public function __construct(){
               
           }// end __construct
           
           public function add(\core\classes\form\field\Field $field){
               $this->_fields[] = $field;
           }// end add
           
           public function addAll(array $fields){
               foreach($fields as $field){
                   $this->_fields[] = $field;
               }
           }// end addAll
           
           public function dependency($callback){
               if(is_callable($callback)){
                    $this->_dependency = $callback;
               }
           }// end dependency
           
           public function execute(){
               if(!is_null($this->_dependency)){
                    return ($this->_is_correct = \call_user_func_array($this->_dependency, $this->_fields));
               }
               return null;
           }// end execute
           
           public function correct(){
               return $this->_is_correct;
           }// end correct
           
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}