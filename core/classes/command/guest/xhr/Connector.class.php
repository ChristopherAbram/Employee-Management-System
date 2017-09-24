<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\command\guest\xhr;

class Connector extends Command {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                return array(
                    //'ContentType: text/html; encoding=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    
                );
            }// end _styles
            
            protected function _execute(\core\classes\request\Request $request){
                
                // Uploader options:
                $opts = array(
                    'max_size'			=> 1024 * 1024, // 1MB
                    'min_size'			=> 64,
                    'mime'                      => array(
                        //'image/png', 'image/jpeg', 'image/bmp'
                    ),
                    'miniatures_dir'            => 'app/img/miniatures',
                    'miniature_width'           => 300, // px
		);
                
		// Initialization:
                try {
                    $name = 'files';
                    $up = new \core\classes\uploader\Uploader(new \core\classes\uploader\handler\File($opts), $name);
                    $up->setMode(array(
                        // only read allowed:
                        \core\classes\uploader\Uploader::READ              
                    ));
                    $up->run( );
                } catch(\core\classes\uploader\UploaderException $ex){
                    echo $ex->getMessage();
                }
                die();
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}