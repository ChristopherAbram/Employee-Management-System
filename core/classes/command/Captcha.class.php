<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\command;

class Captcha extends Command {
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
                
                include_once realpath( dirname(__FILE__).'/../../../plugins/captcha/captcha.php' );
                
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}