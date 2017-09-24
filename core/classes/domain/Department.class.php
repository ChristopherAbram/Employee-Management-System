<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain;

class Department extends Domain {
    // vars {
        
        
        // Presentation data:
        protected $_presentation = array(
            
            'id'                => '', 
            'namepath'          => '', 
            'name'              => '', 
            'description'       => '', 
            'city'              => '',
            'zip'               => '', 
            'street'            => '', 
            'house'             => '', 
            'flat'              => '',
        );
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\Department $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                }
                else {
                    parent::__construct($id);
                    try {
                        $dep_factory = new \core\classes\data\factory\Department();
                        $this->_data = $dep_factory->getById($id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new DomainException($ex->getMessage(), 0, $ex);
                    }
                }
            }// end __construct
            
            public function &getPresentationData(){
                $data = &$this->_data->getDataReference();
                if(isset($data['id'])) $this->_presentation['id'] = &$data['id'];
                if(isset($data['namepath'])) $this->_presentation['namepath'] = &$data['namepath'];
                if(isset($data['name'])) $this->_presentation['name'] = &$data['name'];
                if(isset($data['description'])) $this->_presentation['description'] = &$data['description'];
                if(isset($data['city'])) $this->_presentation['city'] = &$data['city'];
                if(isset($data['zip'])) $this->_presentation['zip'] = &$data['zip'];
                if(isset($data['street'])) $this->_presentation['street'] = &$data['street'];
                if(isset($data['house'])) $this->_presentation['house'] = &$data['house'];
                if(isset($data['flat'])) $this->_presentation['flat'] = &$data['flat'];
                
                return $this->_presentation;
            }// end getPresentationData
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}