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

abstract class AttributeStatement extends Statement {
    // vars {
        
        // Attribute list for sql query:
        protected $_attributeList = null;
        
        // Concrete query (with attribute list):
        protected $_builtQuery = '';
        
    // } methods {
    
        // public {
            
            public function __construct(\core\classes\sql\attribute\AttributeList $attributeList = null){
                if(is_null($attributeList)){
                    $this->_attributeList = new \core\classes\sql\attribute\AttributeList(array());
                }
                else {
                    $this->_attributeList = $attributeList;
                }
            }
            
            public function getQuery() {
                $this->_buildQuery();
                return $this->_builtQuery;
            }// end getQuery
            
            public function getAttributeList(){
                return $this->_attributeList;
            }// end getAttributeList
            
            public function setAttributeList(\core\classes\sql\attribute\AttributeList $attributeList){
                $this->_attributeList = $attributeList;
                return;
            }// end setAttributeList
        
        // } protected {
        
            abstract protected function _buildQuery();
    
        // } private {
            
        // }
    // }
}