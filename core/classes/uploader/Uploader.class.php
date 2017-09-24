<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\uploader
 * @author     Christopher Abram
 * @version    1.0
 * @date	26.09.2016
 */

namespace core\classes\uploader;

class Uploader {
    // vars {
        
        private	$_mime              = array( );
		
	private	$_handler           = null;
	
	private	$_files             = array( );
	
	private	$_name              = 'files';
	
	private	$_request           = null;
	
	private	$_cmd               = 'save';
	
	private	$_file              = 'false';
	
	private	$_responseTPL       = '';
	
	private	$_httpREFERER       = '';
	
	private	$_modes             = array( );
	
	// MESSAGES {
	static public $messages = array(
		'upOK' => 'File uploaded successfully.',
		
		'okDelete' => 'File deleted successfully.',
		
		'errBadCmd' => 'Error, unknown operation command.',
		
		'errType' => 'Invalid file type. You can not upload this file.',
		
		'errNotFound' => 'An error occured while getting file. Try again.',
		
		'errSizeBig' => 'Error, file is too large.',
		
		'errSizeSmall' => 'Error, file is to small.',
		
		'errDimensionWrong' => 'Error, file has wrong dimensions.',
		
		'errWrite' => 'Failed to save data to the database. Try again.',
		
		'errDelete' => 'Failed to delete data. Try again.',
		
		'errPDO' => 'An error occured while getting file. Try again.',
		
		'errDownload' => 'An error occurred while downloading file.',
		
		'errAdress' => 'Bad adress.',
		
		'infoPermissionRead' => 'You have no permission to read this file.',
		
		'infoPermissionWrite' => 'You have no permission to upload any file.',
		
		'infoPermissionDelete' => 'You have no permission to delete this file.',
	);
	
	// } constans :
	const NAME          = 'name';
	const TYPE          = 'type';
	const TMP_NAME      = 'tmp_name';
	const ERROR         = 'error';
	const SIZE          = 'size';
	const FILE_ID       = 'file_id';
	const FILE_REMOVE   = 'remove';
	
	const MAX_SIZE      = 'max_size';
	const MIN_SIZE      = 'min_size';
	
	const MAX_WIDTH     = 'max_width';
	const MIN_WIDTH     = 'min_width';
	const MAX_HEIGHT    = 'max_height';
	const MIN_HEIGHT    = 'min_height';
	
        const ALLOWED       = 'mime';
        const MIN_DIR       = 'miniatures_dir';
        
        const MINIATURE_WIDTH = 'miniature_width';
        
	// uri properties
	const CMD           = 'command';
	const FILE          = 'file';
	const MINIATURE     = 'miniature';
	
	// uri allowed values:
	// CMD :
	const _SAVE         = 'save';
	const _GET          = 'get';
	const _MIN          = 'miniature';
	const _DELETE       = 'delete';
		
	// FILE :
	const _FALSE        = 'false';
	const _INT          = TRUE;
		
	const ALLOWED_REFERER = '';
	
	// messages :
	const UPLOAD_FILE_OK            = 'File uploaded successfully.';
	const UPLOAD_ERR_BAD_TYPE       = 'Invalid file type. You can not upload this file.';
	const UPLOAD_ERR_FILE_NOT_FOUND = 'Error occured while getting selected files. Try again.';
	
	// modes :
	const WRITE         = 'writeonly';
	const READ          = 'readonly';
	const REMOVE        = 'deleteonly';
    
    // } methods {
    
        // public {
            
            public function __construct(\core\classes\uploader\handler\Handler $handler, $name ){
		
                // Handler settings:
                $this->_handler = $handler;
		$this->_mime = $this->_handler->getAllowedMIME();
		$this->_handler->setName($name);
                
		$this->_modes = array( self::WRITE, self::READ, self::REMOVE );
		if(isset($_FILES[$name])){
                    $this->_files = $_FILES[$name];
                }
		
		// set request:
		$this->_request = \RequestRegistry::getRequest();
		// command :
		$this->_cmd = isset($this->_request[self::CMD]) ? $this->_request[self::CMD] : $this->_cmd;
		// file id ( if 'false' -> uploading )
		$this->_file = isset($this->_request[self::FILE]) ? $this->_request[self::FILE] : $this->_file;
			
		// set time limit (unlimited) :
		@set_time_limit( 0 );
		
		// http referer :
		$this->_httpREFERER = @$_SERVER[ 'HTTP_REFERER' ];
            }// end __construct	
            
            final public function run(){
                
		// Save file:
		if( $this->_cmd == self::_SAVE ){
                    if( \in_array( self::WRITE, $this->_modes ) ){
			$this->_save();
                    } 
                    else {
                        $json_response = \json_encode( array( 
                            'status'	=> 0,
                            'message'	=> self::$messages[ 'infoPermissionWrite' ]
                        ));
                        
                        \header(\core\functions\status(403, false));
                        \header('Content-Type: application/json');
                        \header( 'Content-Length: '.strlen( $json_response ) );
                        
                        //\ob_end_clean( );
                        echo $json_response;
                    }
		} 
                // Read file:
                else if( $this->_cmd == self::_GET || $this->_cmd == self::_MIN  ){
                    if( \in_array( self::READ, $this->_modes ) ){
                        $this->_file();
                    } 
                    else {
                        $json_response = \json_encode( array( 
                            'status'	=> 0,
                            'message'	=> self::$messages[ 'infoPermissionRead' ]
                        ) );

                        \header(\core\functions\status(403, false));
                        \header('Content-Type: application/json');
                        \header( 'Content-Length: '.strlen( $json_response ) );

                        //\ob_end_clean( );
                        echo $json_response;
                    }
		}
                // Delete file:
                else if( $this->_cmd == self::_DELETE ){
                    if( \in_array( self::REMOVE, $this->_modes ) ){
                        $this->_delete();
                    } 
                    else {
                        $json_response = \json_encode( array( 
                            'status'	=> 0,
                            'message'	=> self::$messages[ 'infoPermissionDelete' ]
                        ) );

                        \header(\core\functions\status(403, false));
                        \header('Content-Type: application/json');
                        \header('Content-Length: '.strlen( $json_response ) );

                        //\ob_end_clean( );
                        echo $json_response;
                    }
		} 
                
                else {
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> self::$messages[ 'errBadCmd' ]
                    ));
                    
                    \header(\core\functions\status(404, false));
                    \header('Content-Type: application/json');
                    \header('Content-Length: '.strlen( $json_response ));
                    
                    //\ob_end_clean( );
                    echo $json_response;
                    return false;
		}
		return true;
            }// end run

            public function setMode( array $modes ){
                $this->_modes = array();
                foreach( $modes as $val ){
                    if(!\in_array( $val, array( self::WRITE, self::READ, self::REMOVE))){ 
                        continue;
                    }
                    $this->_modes[] = $val;
                }
                return $this;
            }// end setMode
            
        // } protected {
        
            protected function _ext( $name ){
		$ext = explode( '.', $name );
		$ext = '.'.strtolower( end( $ext ) );
		return $ext;
            }// end fileExtension

            protected function _header( $headers ){
                foreach( $headers as $pos => $header ){
                    \header( $header );
                }
            }// end header
            
            protected function _save( ){
		$meassage = '';
		$status = 2;
                
                if(!isset($this->_files[self::TMP_NAME])){
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> self::$messages[ 'errNotFound' ]
                    ) );

                    \header(\core\functions\status(200, false));
                    \header('Content-Type: application/json');
                    \header( 'Content-Length: '.strlen( $json_response ) );

                    //\ob_end_clean( );
                    echo $json_response;
                    return;
                }
                
                if(!\is_array($this->_files[self::TMP_NAME])){
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> self::$messages[ 'errNotFound' ]
                    ));

                    \header(\core\functions\status(200, false));
                    \header('Content-Type: application/json');
                    \header('Content-Length: '.strlen( $json_response ));

                    //\ob_end_clean( );
                    echo $json_response;
                    return;
                }
                
                // getting settings :
                $json_response = array();
                $opts = $this->_handler->getSettings();
                foreach($this->_files[self::TMP_NAME] as $hand => $tmp_name){
                    if($this->__valid($this->_files[self::TYPE][$hand])){
                        if( $this->__validSize($this->_files[ self::SIZE ][ $hand ])){
                            $t = true;
                            if($this->__isImage($this->_files[ self::TYPE ][ $hand ])){
                                $dim = $this->__getImageSize($tmp_name);
                                $t = $this->__validDimensions($dim[ 0 ], $dim[ 1 ]);
                            }
                            if( $t ){
                                // setting curent file:
                                $this->_handler->setCurrent($hand);
                                // executing:
                                $p = $this->_handler->save();
                                
                                $response = $this->_handler->getResponse();
                                // message displaing:
                                if( !$p ){
                                    $message = !empty($response) ? $response : self::$messages[ 'errPDO' ];
                                    $status = 0;
                                } 
                                else {
                                    $message = !empty($response) ? $response : self::$messages[ 'upOK' ];
                                    $status = 2;
                                }
                            } 
                            else {
                                $message = self::$messages[ 'errDimensionWrong' ];
                                $status = 0;
                            }
                        } 
                        else {
                            $status = 0;
                            if( $opts[self::MAX_SIZE] < $this->_files[ self::SIZE ][ $hand ] ){
                                $message = self::$messages[ 'errSizeBig' ];
                            }
                            else {
                                $message = self::$messages[ 'errSizeSmall' ];
                            }
                        }
                    }
                    else {
                        $message = self::$messages[ 'errType' ];
                        $status = 0;
                    }
                    // preparing file info :
                    $name = isset( $this->_files[ self::NAME ][ $hand ] ) ? $this->_files[ self::NAME ][ $hand ] : 'unknown';
                    $size = isset( $this->_files[ self::SIZE ][ $hand ] ) ? $this->_files[ self::SIZE ][ $hand ] : 0;
                    $extn = isset( $this->_files[ self::NAME ][ $hand ] ) ? $this->_ext( $this->_files[ self::NAME ][ $hand ] ) : 'unknown';
                    $mime = isset( $this->_files[ self::TYPE ][ $hand ] ) ? $this->_files[ self::TYPE ][ $hand ] : 'unknown';

                    $json_response[] = array( 
                        'id'                => $this->_handler->getLastID(),
                        'image'             => $this->_handler->getMiniature(),
                        'name'              => $name,
                        'size'              => $size,
                        'extension'         => $extn,
                        'mime'              => $mime,
                        'status'            => $status,
                        'message'           => $message
                    );
                }
                $json_response = \json_encode($json_response);
                \header(\core\functions\status(200, false));
                \header('Content-Type: application/json');
                \header('Content-Length: '.strlen($json_response));
                
                echo $json_response;
                
                return;
            }// end _save
            
            protected function _file(){
		if($this->_file == 'false'){
                    return false;
                }
                
		$load = false;
		// getting file:
		if($this->_cmd == self::_MIN){
                    $load = $this->_handler->miniature($this->_file);
		} 
                else if($this->_cmd == self::_GET){
                    $load = $this->_handler->read($this->_file);
		}
		if($load){
                    // Extract the file data:
                    $file = &$this->_handler->getData();
                    $filename = isset($file[ 'name' ]) ? $file[ 'name' ] : '';
                    $mime = isset($file[ 'mime' ]) ? $file[ 'mime' ] : '';
                    $size = isset($file[ 'size' ]) ? $file[ 'size' ] : '';
                    $content = '';
                    if(isset($file['content'])){
                        $content = &$file['content'];
                    }
                    
                    // Determine the content disposition:
                    $disp = 'attachment';
                    if( $mime ==  'application/octet-stream' ){
                        $disp = 'attachment';
                    } 
                    else {
                        $disp = \preg_match('/^(image|text)/i', $mime) || $mime == 'application/x-shockwave-flash' 
                                ? 'inline' 
                                : 'attachment';
                    }
			
                    // While getting miniature :
                    if($this->_cmd == self::_MIN && !\preg_match('/^image/i', $mime)){
                        $mime = 'image/jpg';
                        $filename = $this->_file.'.jpeg';
                        $disp = 'inline';
                    }
			
                    // http referer :
                    if($this->_httpREFERER !== '' && self::ALLOWED_REFERER !== ''){
                        if(\strpos($this->_httpREFERER, self::ALLOWED_REFERER)){
                            \header(\core\functions\status(501, false) );
                            \header('Content-Type: application/json');
                            $json_response = \json_encode(array( 
                                'status'	=> 0,
                                'message'	=> self::$messages[ 'errAdress' ]
                            ));

                            \header( 'Content-Length: '.strlen( $json_response ) );

                            //\ob_end_clean( );
                            echo $json_response;
                            return;
                        }
                    }
			
                    while(\ob_get_level()){ 
                        \ob_end_clean();	
                    }
                    if(\ob_get_level() == 0){ 
                        \ob_start();
                    }
                    \ob_implicit_flush( true );
			
                    $r = array( 
                        
                        'header' => array( 
                            'Content-Description: File Transfer',
                            'Content-Type: '.$mime,
                            'Accept-Ranges: bytes',
                            'Content-Disposition: '.$disp.'; filename="'.$filename.'"',
                            'Accept-Ranges: binary',
                            'Pragma: public',
                            'Expires: 0',
                            'Cache-Control: must-revalidate, post-check=0, pre-check=0',
                            'Cache-Control: no-cache',
                            'Content-Transfer-Encoding: binary',
                            'Connection: close',
                        ), 
                    );
                    
                    \header(\core\functions\status(200, false));
                    $this->_header($r[ 'header' ]);
                    \header( 'Cache-Control: private', false );
			
                    if($this->_cmd == self::_GET){
                        \header( 'Content-Length: '.$size );
                        echo $content;
                    } 
                    else if($this->_cmd == self::_MIN){
                        \header( 'Content-Length: '.strlen($content));
                        echo $content;
                    }
		} else {
                    $response = $this->_handler->getResponse();
                    $message = !empty($response) ? $response : self::$messages[ 'errDownload' ];
                    
                    $json_response = \json_encode(array( 
                        'status'	=> 0,
                        'message'	=> $message
                    ));
                    
                    \header(\core\functions\status(404, false));
                    \header( 'Content-Length: '.strlen( $json_response ) );
                    
                    //\ob_end_clean( );
                    echo $json_response;
		}
            }// end file
            
            protected function _delete(){
		// Get file ids:
                $files = isset($this->_request[self::FILE_REMOVE]) ? $this->_request[self::FILE_REMOVE] : array();
                
                // Send headers:
                \header(\core\functions\status(200, false));
                \header('Content-Type: application/json');
                
                // Quit if there are no ids:
                if(empty($files)){
                    $json_response = \json_encode(array( 
                        'status'	=> 0,
                        'message'	=> self::$messages[ 'errDelete' ]
                    ));
                    
                    \header( 'Content-Length: '.strlen( $json_response ) );

                    //\ob_end_clean( );
                    echo $json_response;
                    return;
                }
		$p = false;
                foreach($files as $id){
                    
                    // deleting file:
                    $p = $this->_handler->delete($id);

                    // skipping deleting file:
                    if( $p ){ continue; }
                    
                    $json_response = \json_encode( array( 
                        'status'	=> 0,
                        'message'	=> self::$messages[ 'errDelete' ]
                    ) );
                    
                    \header( 'Content-Length: '.strlen($json_response));

                    //\ob_end_clean( );
                    echo $json_response;
                    return;
                }
                if( $p ){
                    $json_response = \json_encode(array( 
                        'status'	=> 2,
                        'message'	=> self::$messages[ 'okDelete' ]
                    ));
                    
                    \header('Content-Length: '.strlen($json_response));

                    //\ob_end_clean( );
                    echo $json_response;
                }
            }// end delete
            
        // } private {
            
            private function __valid($type){
		return \array_key_exists($type, $this->_mime);
            }// end __valid
            
            private function __validSize($size){
		$opts = $this->_handler->getSettings( );
		return ($size <= $opts[ self::MAX_SIZE ] && $size >= $opts[ self::MIN_SIZE ]);
            }// end __validSize
            
            private function __isImage($type){
		if(\preg_match('/^image/i', $type)){
                    return true;
                }
		return false;
            }// end __isImage
            
            private function __getImageSize($path){
		if($s = @getimagesize($path)){
                    return $s;
		}
		return array(0, 0);
            }// end __getImageSize
            
            private function __validDimensions($x, $y){
		$opts = $this->_handler->getSettings();
		$p = false;
		if( $x <= $opts[ self::MAX_WIDTH ] && $x >= $opts[ self::MIN_WIDTH ] ){ 
                    $p = true;
                }
		else {
                    $p = false;
                }
		
		if($p and $y <= $opts[ self::MAX_HEIGHT ] && $y >= $opts[ self::MIN_HEIGHT ] ){ 
                    $p = true;
                }
		else {
                    $p = false;
                }
		return $p;
            }// end __validDimensions
        
        // }
    // }
}