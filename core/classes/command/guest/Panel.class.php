<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\command\guest;

class Panel extends Command {
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
                
                \core\functions\redirect(\core\functions\address());
                die();
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}