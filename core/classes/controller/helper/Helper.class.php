<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\front
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\controller\helper;

abstract class Helper {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _load_user_basic_data(\core\classes\domain\User $User){
                if($User instanceof \core\classes\domain\AuthorizedUser){
                    $User->loadAll();
                }
            }// end _load_user_basic_data
            
        // } private {
            
            
        
        // }
    // }
}