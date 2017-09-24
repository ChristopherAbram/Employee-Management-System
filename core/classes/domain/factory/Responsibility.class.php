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

class Responsibility extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\Responsibility($id);
            }// end getById
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}