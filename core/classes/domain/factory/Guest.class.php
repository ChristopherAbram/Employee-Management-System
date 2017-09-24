<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\domain\factory;

class Guest extends User {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
        
        // } protected {
            
            protected function _getDomainObject($id = null, \core\classes\data\User $data = null){
                return new \core\classes\domain\Guest();
            }// end _getDomainObject
            
        // } private {
            
        // }
    // }
}