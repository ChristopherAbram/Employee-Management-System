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

class PageParent extends PageEditor {
    // vars {
        
        protected static $_step     = 2;
        protected static $_cmd      = 'pageparent';
        
        protected $_next            = 'PageBody';
        protected $_prev            = 'PageEditor';
        
        private $__page_id          = 1;
        
        // Form fields:
        private $__form             = null;
        private $__parent           = null;
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
                    'panel/pageeditor.style.css',
                    'panel/list.style.css'
                );
            }// end _styles
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = (int)$this->_retrieveId();
                    try {
                        $factory = new \core\classes\data\factory\Page();
                        if(!is_null($id)){
                            $page = $factory->getById($id);
                            if(!is_null($page)){
                                $page->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'page_id'
                                )));
                                if($page->read()){
                                    $data = $page->getData();
                                    $this->__page_id = isset($data['page_id']) ? $data['page_id'] : 1;
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
                                'id', 'page_id', 'edate'
                            )));
                            // Setting data:
                            $data = array(
                                'id'            => $page->getID(),
                                'page_id'       => $this->__parent->value(),
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
                $form = new \core\classes\form\Form('pageparent');
                $this->__form = $form;
                //Parent page id:
                $parent = new \core\classes\form\field\Radio('page_id');
                $this->__parent = $parent;
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Compose form:
                $form->attach($parent);
                $form->attach($next);
                $form->attach($save);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('page_read'));
                }
                
                $page_list = array('children' => array($this->__page_list()));
                $this->__select_checked($page_list, $this->__page_id);
                
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
                    'title'         => Text::get('pageparent'),
                    'description'   => Text::get('parent_desc'),
                    
                    // Form:
                    'parent_page_list'  => $this->__html_list($page_list),
                    
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
            
            private function __page_list(){
                $factory = new \core\classes\domain\factory\Page();
                $Page = $factory->getRoot();
                if(!is_null($Page)){ 
                    // Build page tree:
                    $Page->tree();
                    
                    // Load tree data:
                    try {
                        
                        $visitor = new \core\classes\visitor\PageLoader();
                        $visitor->attributes(array('id', 'title'));
                        $Page->acceptTree($visitor);
                        
                    } catch (\core\classes\domain\DomainException $ex) {
                        $this->error($ex->getMessage());
                    }
                    
                    // Get multidimensional page data array:
                    return $Page->getPageTreeAsDataArray();
                }
                return array();
            }// end __page_list
            
            private function __select_checked(array &$page_list, $id){
                if(isset($page_list['children'])){
                    foreach($page_list['children'] as &$child){
                        if($child['id'] == $id){
                            $child['checked'] = true;
                        }
                        else if(isset($child['children']) && !empty($child['children'])) {
                            $this->__select_checked($child, $id);
                        }
                    }
                }
            }// end __select_checked
            
            private function __html_list(array &$pages, $level = 0){
                $id = $this->_retrieveId();
                $html = '';
                if(isset($pages['id']) && ($pages['id'] == $id)){
                    return $html;
                }
                if(isset($pages['children']) && !empty($pages['children'])){
                    $html = '<div class="list level'.$level.'">';
                    foreach($pages['children'] as &$data){
                        if(isset($data['id']) && ($data['id'] == $id)){
                            continue;
                        }
                        $html .= '<div class="item">
            <div class="left"><input type="radio" name="page_id" value="'.$data['id'].'" '.((isset($data['checked']) && ($data['checked'] == true)) ? 'checked="checked"' : '').' /></div>
            <div class="center">'.$data['title'].'</div>
            <div class="right"></div>
        </div>';
                        $html .= $this->__html_list($data, $level + 1);
                    }
                    $html .= '</div>';
                }
                return $html;
            }// end __html_list
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep2');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep2');
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