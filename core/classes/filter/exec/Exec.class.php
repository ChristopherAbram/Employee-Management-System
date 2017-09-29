<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\filter\exec
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2017
 */

namespace core\classes\filter\exec;

abstract class Exec {
    // vars {
    
        private		$_value = null;
        private		$_type	= _STRING;
        
    // } methods {
        // private {
        
        // } protected {
        
        // } public {
        
            public function setType( $type ){
                $this->_type = $type;
                return $this;
            } // end setType
            
            public function getType( ){
                return $this->_type;
            } // end setType
            
            public function setValue( $value ){
                $this->_value = $value;
                return $this;
            }// end setValue
            
            public function getValue(){
                return $this->_value;
            } // end getValue
            
        // } abstract {
            
            abstract protected function execute( $mode );
                
        // }
    // }
}