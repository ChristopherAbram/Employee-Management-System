<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.09.2016
 */

namespace core\classes\command\plain\xhr;

class ImageConnector extends Command {
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
                
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> Error::get('user_unknown')
                    ));

                    \header(\core\functions\status(200, false));
                    \header('Content-Type: application/json');
                    \header( 'Content-Length: '.strlen( $json_response ) );
                    
                    echo $json_response;
                    die();
                }
                
                if(!$this->_limits($User)){
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> Error::get('limits')
                    ));

                    \header(\core\functions\status(200, false));
                    \header('Content-Type: application/json');
                    \header( 'Content-Length: '.strlen( $json_response ) );
                    
                    echo $json_response;
                    die();
                }
                
                // Uploader options:
                $opts = array(
                    'max_size'			=> 5*1024 * 1024, // 1MB
                    'min_size'			=> 64,
                    'max_width'                 => 10000,
                    'max_height'                => 10000,
                    'min_width'                 => 10,
                    'min_height'                => 10,       
                    'mime'                      => array(
                        'image/png', 'image/jpeg', 'image/bmp', 'image/gif', 'image/tiff'
                    ),
                    'miniatures_dir'            => 'app/img/miniatures',
                    'miniature_width'           => 300, // px
		);
                
		// Initialization:
                try {
                    $name = 'files';
                    $up = new \core\classes\uploader\Uploader(new \core\classes\uploader\handler\File($opts), $name);
                    $up->setMode(array(
                        // read allowed:
                        \core\classes\uploader\Uploader::READ,
                        // write allowed:
                        \core\classes\uploader\Uploader::WRITE,
                        // delete allowed:
                        \core\classes\uploader\Uploader::REMOVE
                    ));
                    $up->run( );
                } catch(\core\classes\uploader\UploaderException $ex){
                    echo $ex->getMessage();
                }
                die();
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _limits(\core\classes\domain\User $User){
                if($User instanceof \core\classes\domain\Plain){
                    try {
                        $count = \core\classes\data\FileInfo::countByUserId($User->getID());
                        return !($count > 0);
                    } catch (Exception $ex) {}
                }
                else {
                    return true;
                }
                return false;
            }// end _limits
            
        // } private {
            
            
            
        // }
    // }
}