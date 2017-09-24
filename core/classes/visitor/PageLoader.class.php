<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\visitor
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.09.2016
 */

namespace core\classes\visitor;

class PageLoader extends Visitor {
    // vars {
        
        // A attribute list:
        protected $_attributes    = null;
        
    // } methods {
    
        // public {
        
            public function attributes(array $attributes = array()){
                if(!empty($attributes)){
                    $this->_attributes = new \core\classes\sql\attribute\AttributeList($attributes);
                }
                return $this->_attributes;
            }// end attributes
            
            public function visit($page){
                $attributes = $this->attributes();
                if($page instanceof \core\classes\domain\Page){
                    return $page->load($attributes);
                }
                return false;
            }// end visit
            
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}