<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller;

class Map {
    // vars {
        
        const DEFAULT_          = 'default';
        const DEFAULT_ROLE      = 'all';
    
        // View map:
        protected $_view        = array();
        
        // Layout map:
        protected $_layout      = array();
        
        // Forward map:
        protected $_forward     = array();
        
        // Classroot map:
        protected $_classroot   = array();
    
    // } methods {
    
        // public {
            
            public function addClassRoot($command, $classroot){
                $this->_classroot[$command] = $classroot;
            }// end addClassRoot
            
            public function getClassRoot($command){
                if(isset($this->_classroot[$command])){
                    return $this->_classroot[$command];
                }
                return $command;
            }// end getClassRoot
            
            public function addView($command, $status, $view){
                $this->_view[$command][$status] = $view;
            }// end addView
            
            public function getView($command = self::DEFAULT_, $status = 0){
                if(isset($this->_view[$command][$status])){
                    return $this->_view[$command][$status];
                }
                return null;
            }// end getView
            
            public function addLayout($command, $layout, $role = self::DEFAULT_ROLE){
                $this->_layout[$role][$command] = $layout;
            }// end addLayout
            
            public function getLayout($command, $role = self::DEFAULT_ROLE){
                if(isset($this->_layout[$role][$command])){
                    return $this->_layout[$role][$command];
                }
                return null;
            }// end getLayout
            
            public function addForward($command, $status, $forward){
                $this->_forward[$command][$status] = $forward;
            }// end addForward
            
            public function getForward($command = self::DEFAULT_, $status = 0){
                if(isset($this->_forward[$command][$status])){
                    return $this->_forward[$command][$status];
                }
                return null;
            }// end getForward
            
        // } protected {
        
            
            
        // } private {
            
            
        
        // }
    // }
}