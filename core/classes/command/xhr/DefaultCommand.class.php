<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\xhr;

class DefaultCommand extends Command {
    // vars {
        
        
        
    // } methods {
        
        // public {
            
            
            
        // } protected {
    
            protected function _styles($status) {
                return array(
                    
                );
            }// end _styles
            
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200),
                );
            }// end _headers
            
            protected function _execute(\core\classes\request\Request $request){
                
                
                
                /*echo '<pre>';
                var_dump($_REQUEST);
                echo '</pre>';
                die();*/
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}