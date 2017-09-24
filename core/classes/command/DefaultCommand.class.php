<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\command;

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
                
                $this->assignAll(array(
                    'front_menu'  => array('login' => 'Sign in'),
                ));
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
        // }
    // }
}