<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\command\panel\publicist;

class Upload extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/upload.style.css'
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}