<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\plain;

class YourAgreements extends Agreements {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _retrieve_id(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(!is_null($User))
                    $this->_user_id = $User->getID();
            }
            
        // } private {
            
            
            
        // }
    // }
}