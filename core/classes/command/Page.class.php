<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\command;

class Page extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'ContentType: text/html; encoding=utf-8'
                );
            }// end _headers
        
            protected function _execute(\core\classes\request\Request $request){
                
                //echo '<b>End!!!</b><br />';
                
                $u = \ApplicationRegistry::getCurrentUser();
                
                //echo '<pre>';
                //print_r($u->getID());
                //echo '</pre>';
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
        // }
    // }
}