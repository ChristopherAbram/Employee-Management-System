<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\publicist;

class ArticlePicture extends ArticleEditor {
    // vars {
        
        protected static $_step     = 4;
        protected static $_cmd      = 'articlepicture';
        
        protected $_next            = 'ArticleOptions';
        protected $_prev            = 'ArticleBody';
        
        private $__data             = array();
        
        // Form fields:
        private $__form             = null;
        private $__radio            = null;
        private $__save             = null;
        private $__next             = null;
        private $__cancel           = null;
        
        private $__request          = null;
    
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
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = $this->_retrieveId();
                    try {
                        $factory = new \core\classes\domain\factory\Article();
                        if(!is_null($id)){
                            $Article = $factory->getById($id);
                            if(!is_null($Article)){
                                // Load article data:
                                $p = $Article->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'file_id'
                                )));
                                
                                if($p && $Article->fileExists()){
                                    $p = $Article->loadFile(array('id', 'name', 'extension'));
                                    if($p){
                                        $this->__data = $Article->getPresentationData();
                                        return true;
                                    }
                                }
                                return true;
                            }
                        }
                        return false;
                    } catch (\core\classes\domain\DataException $ex) {
                        $this->error(Error::get('art_read'));
                    }
                }
                return true;
            }// end _read
            
            protected function _update(){
                $id = $this->_retrieveId();
                try {
                    if(isset($this->__request['file']) && !empty($this->__request['file']) && !is_null($id)){
                        $factory = new \core\classes\domain\factory\Article();
                        $Article = $factory->getById($id);
                        if(!is_null($Article)){
                            $file = $this->__radio->value();
                            if(\is_array($file)){
                                $file = \current($file);
                            }
                            $file = (int)$file;
                            
                            $data_obj = $Article->getData();
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
                            }
                        }
                        $this->error(Error::get('update'));
                    }
                    
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $this->__request = $request;
                
                $status = self::CMD_OK;
                
                // Form:
                $form = new \core\classes\form\Form('articlepicture');
                $this->__form = $form;
                // File radio:
                $radio = $this->__radio();
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Compose form:
                $form->attach($save);
                $form->attach($radio);
                $form->attach($next);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('art_read'));
                }
                
                // Execute form:
                if($save->submitted() || $next->submitted()){
                    if($form->perform()){
                        if($this->_save()){
                            if($next->submitted()){
                                $status = self::NEXT;
                            }
                        }
                    }
                    else {
                        $this->error(Error::get('form_incomplete'));
                    }
                }
                else if($cancel->submitted()){
                    $this->_cancel();
                }
                
                $this->assignAll(array(
                    'title'         => Text::get('article_picture_title'),
                    'description'   => Text::get('picture_desc'),
                    
                    'image'         => isset($this->__data['picture']) ? $this->__data['picture'] : array(),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save, $next),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            private function __radio(){
                $f = new \core\classes\form\field\Radio('file[]');
                $this->__radio = $f;
                return $f;
            }// end __radio
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep4');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep4');
                $f->value('Save and next');
                $this->__next = $f;
                return $f;
            }// end __next
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Cancel');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}