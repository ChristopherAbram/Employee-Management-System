<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql\statement\select;

abstract class Statement extends \core\classes\sql\statement\AttributeStatement {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            protected function _buildQuery() {
                if(!is_null($this->_attributeList)){
                    $replacement = ''.$this->getAttributeList(); // convert to string
                    $this->_builtQuery = \core\functions\replace(
                            $this->_query, 
                            array('$attributeList' => $replacement));
                } else {
                    $this->_builtQuery = $this->_query;
                }
                return;
            }// end _buildQuery
    
        // } private {
            
        // }
    // }
}