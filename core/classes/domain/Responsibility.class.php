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

class Responsibility extends Domain {
    // vars {
        
        
        // Presentation data:
        protected $_presentation = array(
            'id'                => '',
            'name'              => '', 
            'description'       => ''
        );
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\Responsibility $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                }
                else {
                    parent::__construct($id);
                    try {
                        $res_factory = new \core\classes\data\factory\Responsibility();
                        $this->_data = $res_factory->getById($id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new DomainException($ex->getMessage(), 0, $ex);
                    }
                }
            }// end __construct
            
            public function &getPresentationData(){
                $data = &$this->_data->getDataReference();
                if(isset($data['id'])) $this->_presentation['id'] = &$data['id'];
                if(isset($data['name'])) $this->_presentation['name'] = &$data['name'];
                if(isset($data['description'])) $this->_presentation['description'] = &$data['description'];
                
                return $this->_presentation;
            }// end getPresentationData
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}