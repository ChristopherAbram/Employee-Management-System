<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql\statement;

abstract class Statement {
    // vars {
        
        // Query syntax:
        protected $_query           = '';
        
        // List of parameters for query:
        protected $_parameters      = array();
        
        // List of required parameter names:
        protected $_requiredParams  = array();
        
    // } methods {
        
        // public {
            
            public function getQuery(){
                return $this->_query;
            }// end getQuery
            
            public function getRequiredParameters(){
                return $this->_requiredParams;
            }// end getRequiredParameters
            
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}