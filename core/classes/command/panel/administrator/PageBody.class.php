<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\command\panel\administrator;

class PageBody extends PageEditor {
    // vars {
        
        protected static $_step     = 3;
        protected static $_cmd      = 'pagebody';
        
        protected $_next            = 'PageOptions';
        protected $_prev            = 'PageParent';
    
        // Form fields:
        private $__content          = null;
        private $__form             = null;
        private $__save             = null;
        private $__next             = null;
        private $__cancel           = null;
    
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
                    'panel/pageeditor.style.css'
                );
            }// end _styles
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = null;
                    $d = $this->_data();
                    if(isset($d['id'])){
                        $id = (int)$d['id'];
                    }
                    else {
                        return false;
                    }
                    try {
                        $factory = new \core\classes\data\factory\Page();
                        if(!is_null($id)){
                            $page = $factory->getById($id);
                            if(!is_null($page)){
                                $page->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'body'
                                )));
                                if($page->read()){
                                    $data = $page->getData();
                                    $this->__content->value(isset($data['body']) ? \core\functions\decode_content($data['body']) : '');
                                    return true;
                                }
                            }
                        }
                        return false;
                    } catch (\core\classes\data\DataException $ex) {
                        $this->error(Error::get('page_read'));
                    }
                }
                return true;
            }// end _read
            
            protected function _update(){
                $id = null;
                $d = $this->_data();
                if(isset($d['id'])){
                    $id = (int)$d['id'];
                }
                else {
                    return false;
                }
                try {
                    if(!is_null($id)){
                        $factory = new \core\classes\data\factory\Page();
                        $page = $factory->getById($id);
                        if(!is_null($page)){
                            $page->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'body', 'edate'
                            )));
                            // Setting data:
                            $data = array(
                                'id'            => $page->getID(),
                                'body'          => \core\functions\encode_content($this->__content->value()),
                                'edate'         => \date(DATETIME)
                            );
                            $page->setData($data);
                            if($page->update()){
                                $this->correct(Correct::get('update'));
                                return true;
                            }
                        }
                    }
                    $this->error(Error::get('update'));
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('page_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Form:
                $form = new \core\classes\form\Form('pagebody');
                $this->__form = $form;
                // Textarea field:
                $content = $this->__content();
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Compose form:
                $form->attach($content);
                $form->attach($save);
                $form->attach($next);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('page_read'));
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
                    'title'         => Text::get('pagebody'),
                    'description'   => Text::get('body_desc'),
                    
                    // Form:
                    'body'       => array(
                        'title'         => Text::get('page_body'),
                        'input'         => $content,
                        'description'   => Text::get('page_body_desc'),
                    ),
                    
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
            
            private function __content(){
                $f = new \core\classes\form\field\Textarea('body');
                $f->id('editor');
                $this->__content = $f;
                return $f;
            }// end __content
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep3');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep3');
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