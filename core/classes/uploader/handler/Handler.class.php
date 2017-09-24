<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\uploader\handler
 * @author     Christopher Abram
 * @version    1.0
 * @date	26.09.2016
 */

namespace core\classes\uploader\handler;

use core\classes\uploader\Uploader;

abstract class Handler {
    // vars {
        
        protected $_settings        = array( );
	
	protected $_files           = array( );
	
	protected $_name            = 'files';
	
	protected $_current         = 0;
	
	protected $_avaiableIMG     = array( );
	
	protected $_response        = '';
        
        protected $_data            = array();
	
	protected $_lastUPID        = null;
    
    // } methods {
    
        // public {
            
            public function __construct(array $options){
		global $IMG_TYPES;
		
		$max_w = 10000;
		$min_w = 2;
		$max_h = 10000;
		$min_h = 2;
		
		$max_s = 16 * 1024 * 1024;
		$min_s = 1;
                
		$this->_avaiableIMG = $IMG_TYPES;
		$this->_settings = $options;
		
		$this->_settings[ Uploader::MAX_WIDTH ] = isset( $this->_settings[ Uploader::MAX_WIDTH ] ) ? $this->_settings[ Uploader::MAX_WIDTH ] : $max_w;
		$this->_settings[ Uploader::MIN_WIDTH ] = isset( $this->_settings[ Uploader::MIN_WIDTH ] ) ? $this->_settings[ Uploader::MIN_WIDTH ] : $min_w;
		$this->_settings[ Uploader::MAX_HEIGHT ] = isset( $this->_settings[ Uploader::MAX_HEIGHT ] ) ? $this->_settings[ Uploader::MAX_HEIGHT ] : $max_h;
		$this->_settings[ Uploader::MIN_HEIGHT ] = isset( $this->_settings[ Uploader::MIN_HEIGHT ] ) ? $this->_settings[ Uploader::MIN_HEIGHT ] : $min_h;
		
		$this->_settings[ Uploader::MAX_SIZE ] = isset( $this->_settings[ Uploader::MAX_SIZE ] ) ? $this->_settings[ Uploader::MAX_SIZE ] : $max_s;
		$this->_settings[ Uploader::MIN_SIZE ] = isset( $this->_settings[ Uploader::MIN_SIZE ] ) ? $this->_settings[ Uploader::MIN_SIZE ] : $min_s;
		
                $this->_settings[ Uploader::MIN_DIR ] = isset( $this->_settings[ Uploader::MIN_DIR ] ) ? $this->_settings[ Uploader::MIN_DIR ] : '';
                
                $this->_settings[ Uploader::MINIATURE_WIDTH ] = isset( $this->_settings[ Uploader::MINIATURE_WIDTH ] ) ? $this->_settings[ Uploader::MINIATURE_WIDTH ] : 300;
                
            }// end __construct
            
            public function getResponse(){
		return $this->_response;
            }// end getResponse

            public function setCurrent($i){
                $this->_current = $i;
                return $this;
            }// end setCurrent

            public function getCurrent(){
                return $this->_current;
            }// end getCurrent
            
            public function getSettings(){
		return $this->_settings;
            }// end getSettings
            
            public function setName($name){
		if(isset($_FILES[ $name ])){
                    $this->_files = $_FILES[ $name ];
                }
		$this->_name = $name;
		return $this;
            }// end setName

            public function getName(){
                return $this->_name;
            }// end getName
            
            public function &getData(){
                return $this->_data;
            }// end getData

            public function isIMG($type){
                if(\in_array($type, $this->_avaiableIMG)){
                    return true;
                }
                return false;
            }// end isIMG
            
            public function getAllowedMIME(){
		global $MIME;
                
		if(isset($this->_settings[Uploader::ALLOWED]) and \is_array($this->_settings[Uploader::ALLOWED]) and \sizeof($this->_settings[Uploader::ALLOWED]) > 0){
                    $mime = array( );
                    foreach( $this->_settings[ Uploader::ALLOWED ] as $key => $value ){
                        if(\array_key_exists($value, $MIME)){
                            $mime[ $value ] = $MIME[ $value ];
                        }
                    }
                    return $mime;
		} 
                else {
                    return $MIME;
		}
            }// end getAllowedMIME
            
            abstract public function getLastID();

            abstract public function getMiniature();

            abstract public function miniature($path);
            
            abstract public function read($path);
            
            abstract public function save();

            abstract public function delete($path);
            
        // } protected {
            
            protected function _file_extension($name){
		$ext = \explode('.', $name);
		$ext = '.'.\strtolower(\end($ext));
		return $ext;
            }// end fileExtension
        
            protected static function _imgResize($path, $width, $height, $keepProportions = false, $resizeByBiggerSide = true, $destformat = null){
		return \core\functions\resize_image($path, $width, $height, $keepProportions, $resizeByBiggerSide, $destformat);
            }// end _imgResize
	
            protected static function _imgCrop($path, $width, $height, $x, $y, $destformat = null){
		return \core\functions\crop_image($path, $width, $height, $x, $y, $destformat);
            }// end imgCrop
	
            protected static function _imgSquareFit($path, $width, $height, $align = 'center', $valign = 'middle', $bgcolor = '#0000ff', $destformat = null){
		return \core\functions\square_fit_image($path, $width, $height, $align, $valign, $bgcolor, $destformat);
            }// end imgSquereFit
	
            protected static function _imgToSquare($path, $width, $destformat = null){
                return \core\functions\square_image($path, $width, $destformat);
            }// end _imgToSquare
            
        // } private {
            
        // }
    // }
}