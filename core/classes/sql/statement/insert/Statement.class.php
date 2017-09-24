<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql\statement\insert;

abstract class Statement extends \core\classes\sql\statement\AttributeStatement {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            public function getRequiredParameters() {
                $requiredParameters = array();
                $attributeList = $this->getAttributeList();
                foreach($attributeList as $attribute){
                    foreach($this->_requiredParams as $parameterName => $attributeName){
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
                    $requiredParameters = $this->getRequiredParameters();
                    foreach($requiredParameters as $key => $value){
                        $requiredParameters[$key] = '`'.$value.'`';
                    }
                    $attributeList = implode(', ', array_values($requiredParameters));
                    
                    $tmp = array();
                    foreach($requiredParameters as $key => $value){
                        $tmp[] = ':'.$key;
                    }
                    $parameterList = implode(', ', $tmp);//implode(', ', array_walk(array_keys($requiredParameters), function(&$value, $key){ $value = ':'.$value; }));
                    $this->_builtQuery = \core\functions\replace(
                            $this->_query, 
                            array(
                                '$attributeList' => $attributeList,
                                '$parameterList' => $parameterList
                            ));
                } else {
                    $this->_builtQuery = $this->_query;
                }
                return;
            }// end _buildQuery
    
        // } private {
            
        // }
    // }
}