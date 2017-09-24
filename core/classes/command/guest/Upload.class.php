<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\command\guest;

class Upload extends Command {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                return array(
                    'ContentType: text/html; encoding=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    
                );
            }// end _styles
            
            protected function _execute(\core\classes\request\Request $request){
                
                $form = new \core\classes\form\Form('upload');
                
                $file = new \core\classes\form\field\File('files[]');
                $file->multiple(true);
                
                $submit = new \core\classes\form\field\Submit('up');
                $submit->value('Upload');
                
                $this->assign('file', $file);
                $this->assign('submit', $submit);
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}