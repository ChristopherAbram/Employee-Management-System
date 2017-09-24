<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\command\panel;

class DefaultCommand extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200),
                );
            }// end _headers
        
            protected function _execute(\core\classes\request\Request $request){
                
                \core\functions\redirect(\core\functions\address().'/panel/dashboard');
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
        // }
    // }
}