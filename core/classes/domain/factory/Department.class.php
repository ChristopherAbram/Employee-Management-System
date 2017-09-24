<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain\factory;

class Department extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\Department($id);
            }// end getById
            
            public function getByNamepath($namepath){
                try {
                    $factory = new \core\classes\data\factory\Department();
                    $data = $factory->getByNamepath($namepath);
                    if(!is_null($data)){
                        return new \core\classes\domain\Department(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('department_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}