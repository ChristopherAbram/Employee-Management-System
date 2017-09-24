<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\uploader\handler
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\uploader\handler;

use core\classes\uploader\Uploader;

class File extends Handler {
    // vars {
        
        
        
    // } methods {
    
        // public {
    
            public function __construct(array $options){
                parent::__construct($options);
                
                /*
                $sth = $this->_db->prepare( 'SET GLOBAL max_allowed_packet=4294967296;' );//'SET GLOBAL max_buffer_length=1000000;' 
		$sth->execute( );
		$sth = $this->_db->prepare( 'SET GLOBAL max_buffer_length=1000000;' );// 
		$sth->execute( );
                */
            }// end __construct
            
            public function getLastID(){
                return $this->_lastUPID;
            }// end getLastID

            public function getMiniature(){
                $current = $this->getCurrent();
                $id = $this->getLastID();
                $ext = isset($this->_files[Uploader::NAME][$current]) ? $this->_file_extension($this->_files[Uploader::NAME][$current]) : '';
                $miniature_dir = $this->_settings[Uploader::MIN_DIR];
                
                return \core\classes\domain\File::getMiniaturePath($id, $ext, $miniature_dir);
            }// end getMiniature

            public function miniature($path){
                try {
                    $factory = new \core\classes\domain\factory\File();
                    $file = $factory->getById((int)$path);
                    if(is_null($file)){
                        return false;
                    }
                    
                    // Get file metadata:
                    $load = $file->load(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'name', 'size', 'mime', 'hide', 'bin', 'locked'
                    )));
                    if(!$load){ return false; }
                    
                    // Checking visibility:
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User) || !$file->isVisible($User)){
                        return false;
                    }
                    
                    // Get file content:
                    $load = $file->loadFileMiniature();
                    if(!$load){ return false; }
                    
                    // Fetch data:
                    $file_info = $file->getData();
                    $content = $file->getFileMiniature();
                    if(is_null($file_info) || is_null($content)){ return false; }
                    
                    $metadata = &$file_info->getDataReference();
                    $data = &$content->getDataReference();
                    
                    // Extract data:
                    $this->_data = &$metadata;
                    $this->_data['content'] = &$data['content'];
                    return true;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->_response = Error::get('read_file_miniature');
                }
                return false;
            }// end miniature
            
            public function read($path){
                try {
                    $factory = new \core\classes\domain\factory\File();
                    $file = $factory->getById((int)$path);
                    if(is_null($file)){
                        return false;
                    }
                    // Get file metadata:
                    $load = $file->load(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'name', 'size', 'mime', 'hide', 'bin', 'locked'
                    )));
                    if(!$load){ return false; }
                    
                    // Checking visibility:
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User) || !$file->isVisible($User)){
                        return false;
                    }
                    
                    // Get file content:
                    $load = $file->loadFile();
                    if(!$load){ return false; }
                    
                    // Fetch data:
                    $file_info = $file->getData();
                    $content = $file->getFile();
                    if(is_null($file_info) || is_null($content)){ return false; }
                    
                    $metadata = &$file_info->getDataReference();
                    $data = &$content->getDataReference();
                    
                    // Extract data:
                    $this->_data = &$metadata;
                    $this->_data['content'] = &$data['content'];
                    return true;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->_response = Error::get('read_file');
                }
                return false;
            }// end read

            public function save(){
                
                // Inserting file metadata:
                $p = false;
                $file_info = new \core\classes\data\FileInfo();
                $filename = '';
                try {
                    if(!is_null($file_info)){
                        
                        // Change attributes:
                        $file_info->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                            'id', 'name', 'size', 'mtime', 'cdate', 'mime', 'width', 'height', 'extension', 'user_id'
                        )));
                        
                        // Get file data:
                        $data = $this->_acquire_file_metadata();
                        if(!empty($data)){
                            $filename = isset($data['name']) ? $data['name'] : '';
                            $file_info->setData($data);
                            
                            // Execute insert:
                            $p = $file_info->create();
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->_response = Error::get('insert_file_info');
                    return false;
                }
                
                // Quit if sth went wrong:
                if(!$p){
                    return false;
                }
                $id = $file_info->getID();
                
                // Inserting file content:
                $content = new \core\classes\data\File();
                try {
                    // Get file content:
                    $data = $this->_acquire_file_content($id);
                    if(!empty($data)){
                        $content->setData($data);

                        // Execute insert:
                        $p = $content->create();
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->_response = Error::get('insert_file');
                    return false;
                }
                
                // Quit if sth went wrong:
                if(!$p){
                    // Delete metadata if file was not uploaded:
                    try {
                        $file_info->delete();
                    } catch (\Exception $ex) {}
                    return false;
                }
                
                // Inserting file miniature:
                $miniature = new \core\classes\data\FileMiniature();
                try {
                    // Get file content:
                    $data = $this->_acquire_file_miniature($id);
                    if(!empty($data)){
                        $miniature->setData($data);
                        
                        // Execute insert:
                        $p = $miniature->create();
                        //if(!empty($filename)){
                        //    \unlink($filename);
                        //}
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->_response = Error::get('insert_miniature');
                    return false;
                }
                
                // Quit if sth went wrong:
                if(!$p){
                    // Delete metadata and content if file was not uploaded:
                    try {
                        $file_info->delete();
                        $content->delete();
                    } catch (\Exception $ex) {}
                    return false;
                }
                $this->_lastUPID = $id;
                return $p;
            }// end save

            public function delete($path){
                try {
                    // Get requested file:
                    $factory = new \core\classes\domain\factory\File();
                    $File = $factory->getById((int)$path);
                    if(is_null($File)){ return false; }
                    
                    // Load necessary data:
                    $load = $File->load(new \core\classes\sql\attribute\AttributeList(array('id', 'bin', 'hide', 'locked')));
                    if(!$load){ return false; }
                    
                    // Check availability:
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User) || !$File->isAvailable($User)){ return false; }
                    
                    // Get data object:
                    $file_info = $File->getData();
                    if(!is_null($file_info)){
                        return $file_info->delete();
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->_response = Error::get('delete');
                } catch(\core\classes\domain\DomainException $ex){
                    $this->_response = Error::get('delete');
                }
                return false;
            }// end delete
            
        // } protected {
            
            protected function _acquire_file_metadata(){
                global $MIME;
                $data = array();
                // Get user:
                $User = \ApplicationRegistry::getCurrentUser();
                if(!is_null($User)){
                    $current = $this->getCurrent();
                    // name:
                    $data['name'] = isset($this->_files[Uploader::NAME][$current]) ? $this->_files[Uploader::NAME][$current] : '';
                    // size:
                    $data['size'] = isset($this->_files[Uploader::SIZE][$current]) ? (int)$this->_files[Uploader::SIZE][$current] : 0;
                    // mtime:
                    $data['mtime'] = \time();
                    // cdate:
                    $data['cdate'] = \date(DATETIME);
                    // mime:
                    $data['mime'] = isset($this->_files[Uploader::TYPE][$current]) ? $this->_files[Uploader::TYPE][$current] : 'unknown';
                    // dimensions:
                    $data['height'] = 0;
                    $data['width'] = 0;
                    if(isset($this->_files[Uploader::TMP_NAME][$current], $this->_files[Uploader::TYPE][$current]) && $this->isIMG($this->_files[Uploader::TYPE][$current])){
                        $dimensions = $this->_get_image_dimensions($this->_files[Uploader::TMP_NAME][$current]);
                        $data['height'] = $dimensions[1];
                        $data['width'] = $dimensions[0];
                    }
                    // extension:
                    $data['extension'] = 'unknown';
                    if(isset($this->_files[Uploader::TYPE][$current], $this->_files[Uploader::NAME][$current]) && \array_key_exists($this->_files[Uploader::TYPE][$current], $MIME)){
                        $data['extension'] = $this->_file_extension($this->_files[Uploader::NAME][$current]);
                    } 
                    // user_id;
                    $data['user_id'] = $User->getID();
                }
                return $data;
            }// end _acquire_file_data
            
            protected function _acquire_file_content($id){
                $data = array();
                $current = $this->getCurrent();
                
                if(isset($this->_files[Uploader::TMP_NAME][$current])){
                    $fp = @fopen($this->_files[Uploader::TMP_NAME][$current], 'rb');
                    if(\is_resource($fp) && \get_resource_type($fp) == 'stream'){
                        // Metadata reference:
                        $data['file_info_id'] = (int)$id;
                        // File Content:
                        $data['content'] = $fp;
                    }
                }
                
                return $data;
            }// end _acquire_file_content
            
            protected function _acquire_file_miniature($id){
                $data = array();
                $current = $this->getCurrent();
                
                if(isset($this->_files[Uploader::TMP_NAME][$current], $this->_files[Uploader::TYPE][$current])){
                    
                    if($this->isIMG($this->_files[Uploader::TYPE][$current])){
                        
                        // Copy image tmp file:
                        $filename = realpath($this->_files[Uploader::TMP_NAME][$current]);
			$new_tmp = \ApplicationRegistry::getTmpDir().DIRECTORY_SEPARATOR.'tmp'.\time().'.tmp';
                        
			if(!\copy($filename, $new_tmp)){
                            return $data;
                        }
                        
                        if(!\chmod($new_tmp, 0666)){
                            return $data;
                        }
                        
                        // Transform image to jpg square image (default 300 x 300px):
			$min_path = self::_imgToSquare($new_tmp, $this->_settings[Uploader::MINIATURE_WIDTH], 'jpg');
			if(!$min_path){
                            return $data;
                        }
                        
                        // Open file:
                        $fp = @fopen($min_path, 'rb');
                        if(\is_resource($fp) && \get_resource_type($fp) == 'stream'){
                            // Metadata reference:
                            $data['file_info_id'] = (int)$id;
                            // File Content:
                            $data['content'] = $fp;
                        }
                    }
                }
                
                return $data;
            }// end _acquire_file_content
            
            protected function _get_image_dimensions($filename){
                try {
                    $size = \getimagesize($filename);
                    if(isset($size[0], $size[1])){
                        return array((int)$size[0], (int)$size[1]);
                    }
                } catch (\Exception $ex) {
                    $this->_response = Error::get('get_dimensions');
                }
                return array(0, 0);
            }// end _get_image_dimensions
            
        // } private {
            
        // }
    // }
}