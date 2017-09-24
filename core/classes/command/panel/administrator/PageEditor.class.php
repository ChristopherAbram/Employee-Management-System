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

class PageEditor extends \core\classes\command\MultiStepEditor {
    // vars {
        
        protected $_key             = '__pageeditor';
        
        protected static $_step     = 1;
        protected static $_cmd      = 'pageeditor';
        
        protected $_next            = 'PageParent';
        protected $_prev            = null;
        protected $_begin           = 'PageEditor';
        protected $_end             = 'PageOptions';
        
        // Form:
        
        private $__form             = null;
        private $__title            = null;
        private $__namepath         = null;
        private $__description      = null;
        private $__link             = null;
        private $__next             = null;
        private $__save             = null;
        private $__cancel           = null;
        
        private $__user             = null;


        private $__attributes       = array(
            'title', 'namepath', 'description', 'link', 'user_id', 'cdate', 'hide', 'bin'
        );

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
            
            protected function _retrieveId(){
                $id = null;
                $data = $this->_data();
                if(isset($data['id'])){
                    $id = (int)$data['id'];
                }
                return $id;
            }// end _retrieveId
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = $this->_retrieveId();
                    try {
                        $factory = new \core\classes\data\factory\Page();
                        if(!is_null($id)){
                            $page = $factory->getById($id);
                            if(!is_null($page)){
                                $page->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'title', 'namepath', 'description', 'link'
                                )));
                                if($page->read()){
                                    $data = $page->getData();
                                    $this->__title->value(isset($data['title']) ? $data['title'] : '');
                                    $this->__namepath->value(isset($data['namepath']) ? $data['namepath'] : '');
                                    $this->__description->value(isset($data['description']) ? \core\functions\decode_content($data['description']) : '');
                                    $this->__link->value(isset($data['link']) ? $data['link'] : '');
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
                $id = $this->_retrieveId();
                try {
                    if(!is_null($id)){
                        $factory = new \core\classes\data\factory\Page();
                        $page = $factory->getById($id);
                        if(!is_null($page)){
                            $page->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'title', 'namepath', 'description', 'link',
                                'edate'
                            )));
                            // Setting data:
                            $data = array(
                                'id'            => $page->getID(),
                                'title'         => $this->__title->value(),
                                'namepath'      => !empty($this->__namepath->value()) ? $this->__namepath->value() : $this->__namepath_sure(\core\functions\namepath($this->__title->value())),
                                'description'   => \core\functions\encode_content($this->__description->value()),
                                'link'          => $this->__link->value(),
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
                try {
                    $page = new \core\classes\data\Page();
                    $page->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                    // Setting data:
                    $data = array(
                        'title'         => $this->__title->value(),
                        'namepath'      => !empty($this->__namepath->value()) ? $this->__namepath->value() : $this->__namepath_sure(\core\functions\namepath($this->__title->value())),
                        'description'   => \core\functions\encode_content($this->__description->value()),
                        'link'          => $this->__link->value(),
                        'user_id'       => $this->__user->getID(),
                        'cdate'         => \date(DATETIME),
                        'hide'          => 1,
                        'bin'           => 0
                    );
                    $page->setData($data);
                    // User creation:
                    if($page->create()){
                        $this->correct(Correct::get('page_create'));
                        $this->_open(array(
                            'id'    => $page->getID()
                        ));
                        return true;
                    }
                    else {
                        $this->error(Error::get('page_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('page_create'));
                }
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Open page:
                if(isset($request['namepath']) && !empty($request['namepath'])){
                    $factory = new \core\classes\data\factory\Page();
                    $page = $factory->getByNamepath($request['namepath']);
                    if(!is_null($page)){
                        $this->_open(array(
                            'id'    => $page->getID()
                        ));
                        $this->_step(4);
                        $this->_mode(self::UPDATE);
                        \core\functions\redirect(\core\functions\address().'/panel/pageeditor');
                    }
                }
                
                // User instance:
                $this->__user = \PanelRegistry::getCurrentUser();
                // Form:
                $form = new \core\classes\form\Form('pageeditor');
                $this->__form = $form;
                // Title field:
                $title = $this->__title();
                // Namepath field:
                $namepath = $this->__namepath();
                // Link field:
                $link = $this->__link();
                // Description field:
                $description = $this->__description();
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($title);
                $form->attach($namepath);
                $form->attach($link);
                $form->attach($description);
                $form->attach($save);
                $form->attach($next);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('page_read'));
                }
                
                // Executing form:
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
                    'title'     => Text::get('editor'),
                    
                    // form:
                    'tit'       => array(
                        'title'         => Text::get('page_title'),
                        'input'         => $title,
                        'description'   => Text::get('page_title_desc'),
                    ),
                    'namepath'       => array(
                        'title'         => Text::get('page_namepath'),
                        'input'         => $namepath,
                        'description'   => Text::get('page_namepath_desc'),
                    ),
                    'desc'       => array(
                        'title'         => Text::get('page_desc'),
                        'input'         => $description,
                        'description'   => Text::get('page_desc_desc'),
                    ),
                    'link'       => array(
                        'title'         => Text::get('page_link'),
                        'input'         => $link,
                        'description'   => Text::get('page_link_desc'),
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save, $next),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _cancel(){
                if($this->_opened()){
                    $this->_close();
                }
                \core\functions\redirect(\core\functions\address().'/panel/page');
            }// end _cancel
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            private function __namepath_sure($namepath){
                $id = $this->_retrieveId();
                $i = 0;
                do {
                    ++$i;
                    $page_id = \core\classes\data\factory\Page::namepathExists($namepath);
                    if(!is_null($page_id) && !is_null($id)){
                        if($page_id == $id){
                            return $namepath;
                        } else {
                            $namepath .= ''.$i;
                        }
                    }
                    else {
                        return $namepath;
                    }
                } while($i <= 1000);
                return $namepath;
            }// end __namepath_sure
            
            private function __title(){
                $f = new \core\classes\form\field\Text('title');
                $f->id('page_title');
                $f->expression('/^'.REGEX_TITLE.'{3,512}$/i', Error::get('invalid'));
                $f->required(true);
                $this->__title = $f;
                return $f;
            }// end __title
            
            private function __namepath(){
                $id = $this->_retrieveId();
                $f = new \core\classes\form\field\Text('namepath_input');
                $f->id('page_namepath');
                $f->expression('/^'.REGEX_NAMEPATH.'{1,128}$/i', Error::get('invalid'));
                $f->callback(function($field) use($id){
                    $page_id = \core\classes\data\factory\Page::namepathExists($field->value());
                    if(!is_null($page_id)){
                        return ($page_id == $id);
                    }
                    return true;
                }, Error::get('namepath_exists'));
                $this->__namepath = $f;
                return $f;
            }// end __namepath
            
            private function __link(){
                $f = new \core\classes\form\field\Text('link');
                $f->id('page_link');
                $f->expression('/^'.REGEX_PATH.'$/i', Error::get('invalid_link'));
                $this->__link = $f;
                return $f;
            }// end __lnik
            
            private function __description(){
                $f = new \core\classes\form\field\Textarea('description');
                $f->id('editor');
                $this->__description = $f;
                return $f;
            }// end __description
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep1');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep1');
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