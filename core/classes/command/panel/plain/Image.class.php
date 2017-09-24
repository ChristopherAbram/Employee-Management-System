<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\plain
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\plain;

class Image extends Command {
    // vars {
        
        // Form fields:
        private $__form             = null;
        private $__radio            = null;
        private $__save             = null;
        private $__next             = null;
        private $__cancel           = null;
        
        protected $_data            = array();
    
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
                    'panel/pageeditor.style.css',
                    'panel/upload.style.css'
                );
            }// end _styles
        
            protected function _read(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return false;
                }
                $user = $User->getData();
                if(is_null($user)){
                    return false;
                }
                $data = $user->getData();
                try {
                    //if(!isset($data['avatar'])){
                     //   return true;
                    //}/
                    
                    $factory = new \core\classes\domain\factory\File();
                    $File = $factory->getAvatarByUserId($User->getID());
                    if(is_null($File)){
                        return false;
                    }
                    
                    if($File->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension')))){
                        $this->_data = $File->getPresentationData();
                        return true;
                    }
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_read'));
                }
                
                return true;
            }// end _read
            
            protected function _update(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return false;
                }
                $user = $User->getData();
                if(is_null($user)){
                    return false;
                }
                $data = $user->getData();
                try {
                    if(isset($this->__request['file']) && !empty($this->__request['file'])){
                        
                        $file = $this->__radio->value();
                        if(\is_array($file)){
                            $file = \current($file);
                        }
                        $file = (int)$file;
                        $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'avatar')));
                        $data = array(
                            'id'        => $user->getID(),
                            'avatar'    => $file
                        );
                        $user->setData($data);
                            
                        if($user->update()){
                            $this->correct(Correct::get('update'));
                            return true;
                        }
                        
                        
                            /*$data_obj = $Article->getData();
                            if(!is_null($data_obj)){
                                $data_obj->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'file_id')));
                                $data = $data_obj->getData();
                                $data['file_id'] = $file;
                                $data_obj->setData($data);
                                if($data_obj->update()){
                                    $this->correct(Correct::get('update'));
                                    $Article = $factory->getById($id);
                                    if(!is_null($Article)){
                                        $p = $Article->loadFile(array('id', 'name', 'extension'));
                                        if($p){
                                            $this->__data = $Article->getPresentationData();
                                        }
                                    }
                                    return true;
                                }
                            }*/
                        
                        $this->error(Error::get('update'));
                    }
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_update'));
                }
                return false;
            }// end _update
        
            protected function _execute(\core\classes\request\Request $request){
                
                $this->__request = $request;
                
                $status = self::CMD_OK;
                
                // Form:
                $form = new \core\classes\form\Form('avatar');
                $this->__form = $form;
                // File radio:
                $radio = $this->__radio();
                // Save button:
                $save = $this->__save();
                
                // Compose form:
                $form->attach($save);
                $form->attach($radio);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('art_read'));
                }
                
                // Execute form:
                if($save->submitted()){
                    if($form->perform()){
                        if($this->_update()){
                            $status = self::CMD_OK;
                        }
                    }
                    else {
                        $this->error(Error::get('form_incomplete'));
                    }
                }
                
                /*echo '<pre>';
                var_dump($this->_data);
                echo '</pre>';
                die();*/
                
                $this->assignAll(array(
                    'title'         => Text::get('article_picture_title'),
                    'description'   => Text::get('picture_desc'),
                    
                    'image'         => $this->_data,
                    
                    // Toolbar:
                    'toolbar_left'  => array($save),
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __radio(){
                $f = new \core\classes\form\field\Radio('file[]');
                $this->__radio = $f;
                return $f;
            }// end __radio
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
        // }
    // }
}