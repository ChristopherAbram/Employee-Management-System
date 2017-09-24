<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql\statement\update;

abstract class Statement extends \core\classes\sql\statement\AttributeStatement {
    // vars {
        
        // All required parameters for set clause:
        protected $_setParameters      = array();
        
        // Rest of parameters should be listed in _requiredParams
        
    // } methods {
    
        // public {
            
            public function getRequiredParameters() {
                $requiredParameters = $this->_requiredParams;
                $attributeList = $this->getAttributeList();
                foreach($attributeList as $attribute){
                    foreach($this->_setParameters as $parameterName => $attributeName){
                        if($attribute == $attributeName){
                            $requiredParameters[$parameterName] = $attribute;
                            break;
                        }
                    }
                }
                return $requiredParameters;
            }// end getRequiredParameters
    
        // } protected {
        
            protected function _buildQuery() {
                if(!is_null($this->_attributeList)){
                    $set = array();
                    $attributeList = $this->getAttributeList();
                    foreach($attributeList as $attribute){
                        foreach($this->_setParameters as $parameterName => $attributeName){
                            if($attribute == $attributeName){
                                $set[] = '`'.$attribute.'`'.' = :'.$parameterName;
                                break;
                            }
                        }
                    }
                    $attributeList = implode(', ', $set);
                    $this->_builtQuery = \core\functions\replace(
                            $this->_query, 
                            array('$attributeList' => $attributeList));
                } else {
                    $this->_builtQuery = $this->_query;
                }
                return;
            }// end _buildQuery
    
        // } private {
            
        // }
    // }
}