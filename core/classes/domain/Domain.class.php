<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\domain;

abstract class Domain implements \core\interfaces\LazyLoad {
    // vars {
        
        // System Identifier:
        protected $_id          = null;
        
        // Data Object:
        protected $_data        = null;
    
    // } methods {
    
        // public {
            
            public function __construct($id = null){
                $this->_id = $id;
            }// end __construct
            
            public function load(\core\classes\sql\attribute\AttributeList $attributeList = null){
                if($this->_data instanceof \core\classes\data\Data){
                    try {
                        if(!is_null($attributeList)){
                            $this->_data->setAttributeList($attributeList);
                        }
                        return $this->_data->read();
                    } catch(core\classes\data\DataException $ex){
                        throw new DomainException(Error::get('load_domain_data'), 0, $ex);
                    }
                }
                return false;
            }// end load
            
            public function getID(){
                return $this->_id;
            }// end getID
            
            public function getData(){
                return $this->_data;
            }// end getData
        
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}