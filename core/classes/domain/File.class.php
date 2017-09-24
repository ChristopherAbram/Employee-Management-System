<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain;

class File extends Domain {
    // vars {
        
        // Data File Miniature:
        protected $_fileMiniature           = null;
        
        // Data File:
        protected $_file                    = null;
        
        // User reference:
        protected $_User                    = null;
        
        // Presentation data:
        protected $_presentation            = array(
            'id'                => '', 
            'name'              => '', 
            'description'       => '', 
            'size'              => '', 
            'mtime'             => '', 
            'cdate'             => '', 
            'mime'              => '', 
            'read'              => 1,
            'write'             => 1, 
            'locked'            => 0, 
            'hide'              => 0, 
            'bin'               => 0, 
            'width'             => 0, 
            'height'            => 0, 
            'extension'         => '', 
            'user_id'           => '',
            'user'              => array(),
            'miniature'         => '',
        );
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\FileInfo $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                } 
                else {
                    parent::__construct($id);
                    try {
                        $fileinfo_factory = new \core\classes\data\factory\FileInfo();
                        $this->_data = $fileinfo_factory->getById($this->_id);
                    } catch(\core\classes\data\DataException $ex){
                        throw new DomainException($ex->getMessage(), 0, $ex);
                    }
                }
                $this->_User = \core\classes\domain\factory\User::getConcreteByFileId($this->_id);
                try {
                    $fileminiature_factory = new \core\classes\data\factory\FileMiniature();
                    $this->_fileMiniature = $fileminiature_factory->getByFileInfoId($this->_id);
                    $file_factory = new \core\classes\data\factory\File();
                    $this->_file = $file_factory->getByFileInfoId($this->_id);
                } catch(\core\classes\data\DataException $ex){
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
            }// end __construct
            
            public function getFileMiniature(){
                return $this->_fileMiniature;
            }// end getFileMiniatureData
            
            public function loadFileMiniature(){
                try {
                    if(!is_null($this->_fileMiniature)){
                        $this->_fileMiniature->setAttributeList($this->_fileMiniature->getAllAttributeList());
                        return $this->_fileMiniature->read();
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
                return false;
            }// end loadFileMiniature
            
            public function getFile(){
                return $this->_file;
            }// end getFileData
            
            public function loadFile(){
                try {
                    if(!is_null($this->_file)){
                        $this->_file->setAttributeList($this->_file->getAllAttributeList());
                        return $this->_file->read();
                    }
                } catch(\core\classes\data\DataException $ex){
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
                return false;
            }// end loadFile
            
            public function getUser(){
                return $this->_User;
            }// end getUser
            
            public function isOwner(\core\classes\domain\User $User){
                if(!is_null($this->_User)){
                    if($User->getID() == $this->_User->getID()){
                        return true;
                    }
                }
                return false;
            }// end isOwner
            
            public function isVisible(\core\classes\domain\User $User){
                if($User instanceof \core\classes\domain\Administrator){
                    // Always:
                    return true;
                }
                else if($this->isOwner($User) || !($this->isHidden() || $this->isRemoved())){
                    return true;
                }
                return false;
            }// end isVisible
            
            public function isAvailable(\core\classes\domain\User $User){
                if($User instanceof \core\classes\domain\Administrator){
                    // Always:
                    return true;
                }
                else if($this->isOwner($User)){
                    return true;
                }
                return false;
            }// end isAvailable
            
            public function isAccessable(\core\classes\domain\User $User){
                if($this->isVisible($User)){
                    if($User instanceof \core\classes\domain\Administrator){
                        // Always:
                        return true;
                    } 
                    else if(!$this->isLocked()){
                        return true;
                    }
                }
                return false;
            }// end isAccessable
            
            public function isHidden(){
                $array = &$this->_data->getDataReference();
                if(isset($array['hide']) && ($array['hide'] == 1)){
                    return true;
                }
                return false;
            }// end isHidden
            
            public function isLocked(){
                $array = &$this->_data->getDataReference();
                if(isset($array['locked'])){
                    return $array['locked'] == 1;
                }
                return false;
            }// end isMarked
            
            public function isRemoved(){
                $array = &$this->_data->getDataReference();
                if(isset($array['bin']) && ($array['bin'] == 1)){
                    return true;
                }
                return false;
            }// end isRemoved
            
            public function isImage(){
                $array = &$this->_data->getDataReference();
                if(isset($array['mime'])){
                    return \preg_match('/^image/i', $array['mime']);
                }
                return false;
            }// end isImage
            
            public function &getPresentationData($user = true){
                $data = &$this->_data->getDataReference();
                if(isset($data['id'])) $this->_presentation['id'] = &$data['id'];
                if(isset($data['name'])) $this->_presentation['name'] = &$data['name'];
                if(isset($data['description'])) $this->_presentation['description'] = &$data['description'];
                if(isset($data['size'])) $this->_presentation['size'] = &$data['size'];
                if(isset($data['mtime'])) $this->_presentation['mtime'] = &$data['mtime'];
                if(isset($data['cdate'])) $this->_presentation['cdate'] = &$data['cdate'];
                if(isset($data['mime'])) $this->_presentation['mime'] = &$data['mime'];
                if(isset($data['read'])) $this->_presentation['read'] = &$data['read'];
                if(isset($data['write'])) $this->_presentation['write'] = &$data['write'];
                if(isset($data['locked'])) $this->_presentation['locked'] = &$data['locked'];
                if(isset($data['hide'])) $this->_presentation['hide'] = &$data['hide'];
                if(isset($data['bin'])) $this->_presentation['bin'] = &$data['bin'];
                if(isset($data['width'])) $this->_presentation['width'] = &$data['width'];
                if(isset($data['height'])) $this->_presentation['height'] = &$data['height'];
                if(isset($data['extension'])) $this->_presentation['extension'] = &$data['extension'];
                if(isset($data['user_id'])) $this->_presentation['user_id'] = &$data['user_id'];
                if(isset($data['id'], $data['extension'])){
                    $this->_presentation['miniature'] = self::getMiniaturePath($data['id'], $data['extension'], 'app/img/miniatures');
                }
                // User data:
                if($user && !is_null($this->_User)){
                    $this->_presentation['user'] = &$this->_User->getPresentationData();
                }
                return $this->_presentation;
            }// end getPresentationData
            
            public static function getMiniaturePath($id, $ext, $miniature_dir){
                global $ICO;
                $min = '';
		if(\array_key_exists($ext, $ICO)){
                    if($ICO[$ext] != 'miniature'){
                        $min = \core\functions\address().'/'.$miniature_dir.'/'.$ICO[$ext].'.png';
                    } 
                    else {
                        if($id){ $min = \core\functions\address().'/connector/miniature/'.$id; }
                        else { $min = ''; }
                    }
		} 
                else {
                    $min = \core\functions\address().'/'.$miniature_dir.'/1.png';
		}
		return $min;
            }// end getMiniaturePath
            
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}