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

class Page extends Command {
    // vars {
        
    
        // Form fields:
        private $__form         = null;
        // Buttons:
        private $__hide         = null;
        private $__unhide       = null;
        private $__mark         = null;
        private $__unmark       = null;
        private $__remove       = null;
        private $__save         = null;
        
        private $__request      = null;
        
        private $__pageTree     = array();
        
    
    // } methods {
    
        // public {
            
            public function _bin(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('page');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->bin();
                    }
                    return false;
                });
            }
            
            public function _hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('page');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->hide();
                    }
                    return false;
                });
            }
            
            public function _show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('page');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->show();
                    }
                    return false;
                });
            }
            
            public function _mark(){
                $this->_modify('mark', 1);
            }// end _mark
            
            public function _unmark(){
                $this->_modify('mark', 0);
            }// end _unmark
            
            public function _save(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'ord'));
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('ord');
                
                $operation->onsuccess(function(){
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                
                $operation->update(function($id, $value) use($factory, $attributes){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        $page->setAttributeList($attributes);
                        $data = $page->getData();
                        // Change data:
                        $data['ord'] = $value;
                        $page->setData($data);
                        return true;
                    }
                    return false;
                });
            }// end _save
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/itemlist.style.css'
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                // Form:
                $form = new \core\classes\form\Form('page_list');
                $this->__form = $form;
                
                // Buttons:
                $hide = $this->__hide();
                $unhide = $this->__unhide();
                $mark = $this->__mark();
                $unmark = $this->__unmark();
                $save = $this->__save();
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($hide);
                $form->attach($unhide);
                $form->attach($mark);
                $form->attach($unmark);
                $form->attach($save);
                $form->attach($remove);
                
                // Button functions:
                $hide->onsubmit(array($this, '_hide'));
                $unhide->onsubmit(array($this, '_show'));
                $mark->onsubmit(array($this, '_mark'));
                $unmark->onsubmit(array($this, '_unmark'));
                $save->onsubmit(array($this, '_save'));
                $remove->onsubmit(array($this, '_bin'));
                
                // List buttons:
                $this->_onclick_hide();
                $this->_onclick_show();
                $this->_onclick_mark();
                $this->_onclick_unmark();
                
                // Extracting page list (tree):
                $this->__page_list();
                
                $this->assignAll(array(
                    
                    'title'             => 'Page management list',
                    
                    // Page tree html:
                    'page_tree'         => $this->__html_list($this->__pageTree),
                    
                    // Toolbar:
                    'toolbar_left'      => array($save, $hide, $mark),
                    'toolbar_right'     => array($remove, $unhide, $unmark),
                    
                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _modify($column, $value){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('page');
                
                $operation->onsuccess(function(){
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                
                $operation->update(function($id, $val) use($factory, $attributes, $column, $value){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        $page->setAttributeList($attributes);
                        $data = $page->getData();
                        // Change data:
                        $data[$column] = $value;
                        $page->setData($data);
                        return true;
                    }
                    return false;
                });
            }// end _modify
            
            protected function _onclick_hide(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('hide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->hide();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _onclick_show(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('unhide');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $value) use($factory){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        return $page->show();
                    }
                    return false;
                });
            }// end _onclick_hide
            
            protected function _onclick_mark(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'mark'));
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('mark');
                
                $operation->onsuccess(function(){
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                
                $operation->update(function($id, $value) use($factory, $attributes){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        $page->setAttributeList($attributes);
                        $data = $page->getData();
                        // Change data:
                        $data['mark'] = 1;
                        $page->setData($data);
                        return true;
                    }
                    return false;
                });
            }// end _onclick_mark
            
            protected function _onclick_unmark(){
                // Page factory:
                $factory = new \core\classes\data\factory\Page();
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'mark'));
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('unmark');
                
                $operation->onsuccess(function(){
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                
                $operation->update(function($id, $value) use($factory, $attributes){
                    $page = $factory->getById($id);
                    if(!is_null($page)){
                        $page->setAttributeList($attributes);
                        $data = $page->getData();
                        // Change data:
                        $data['mark'] = 0;
                        $page->setData($data);
                        return true;
                    }
                    return false;
                });
            }// end _onclick_mark
            
        // } private {
            
            private function __page_list(){
                $factory = new \core\classes\domain\factory\Page();
                try {
                    $Page = $factory->getRoot();
                    if(!is_null($Page)){ 
                        // Build page tree:
                        $Page->availableTree();
                        
                        // Load tree data:
                        $visitor = new \core\classes\visitor\PageLoader();
                        $visitor->attributes(
                                array('id', 'title', 'namepath', 'hide', 'mark', 'ord', 'bin'));
                        $Page->acceptTree($visitor);
                        
                        // Get multidimensional page data array:
                        $tree = &$Page->getPageTreeAsDataArray();
                        $this->__pageTree = isset($tree['children']) ? array('children' => &$tree['children']) : array();
                        
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __page_list
            
            private function __html_list(array &$pages, $level = 0){
                $html = '';
                if(isset($pages['children']) && !empty($pages['children'])){
                    
                    $html = '<div class="list level'.$level.'">';
                    
                    foreach($pages['children'] as &$data){
                        
                        // Extract data:
                        $id = $data['id'];
                        $title = $data['title'];
                        $namepath = $data['namepath'];
                        $hide = $data['hide'];
                        $mark = $data['mark'];
                        $ord = $data['ord'];
                        $visits = isset($data['visits']) ? (int)$data['visits'] : 0;
                        
                        // html view:
                        $html .= 
                        '<div class="item">
                            <div class="left">
                                <input class="check" type="checkbox" name="page['.$id.']" value="1" />
                                <input class="'.($hide ? 'hide_button_active' : 'hide_button').'" title="hide" type="submit" name="'.($hide ? 'unhide' : 'hide').'['.$id.']" value="" />
                                <input class="'.($mark ? 'mark_button_active' : 'mark_button').'" title="mark" type="submit" name="'.($mark ? 'unmark' : 'mark').'['.$id.']" value="" />
                                <a class="edit_button" href="'.\core\functions\address().'/panel/pageeditor/'.$namepath.'">edit</a>
                            </div>
                            <div class="center">
                                <span class="item_title">'.$title.'</span>
                                <a class="preview_button" title="Preview" href="'.\core\functions\address().'/page/'.$namepath.'" target="_blank"></a>
                            </div>
                            <div class="right">
                                <!--<span class="item_visits">'.$visits.'</span>-->
                                <span class="item_info" title="See statistics"></span>
                                <input class="ord_input" type="number" name="ord['.$id.']" value="'.$ord.'" />
                            </div>
                        </div>';
                        
                        // Next level (if exists):
                        $html .= $this->__html_list($data, $level + 1);
                    }
                    $html .= '</div>';
                }
                return $html;
            }// end __html_list
            
            private function __hide(){
                $f = new \core\classes\form\field\Submit('hide_button');
                $f->value('Hide');
                $this->__hide = $f;
                return $f;
            }// end __hide
            
            private function __unhide(){
                $f = new \core\classes\form\field\Submit('unhide_button');
                $f->value('Unhide');
                $this->__unhide = $f;
                return $f;
            }// end __unhide
            
            private function __mark(){
                $f = new \core\classes\form\field\Submit('mark_button');
                $f->value('Mark');
                $this->__mark = $f;
                return $f;
            }// end __mark
            
            private function __unmark(){
                $f = new \core\classes\form\field\Submit('unmark_button');
                $f->value('Unmark');
                $this->__unmark = $f;
                return $f;
            }// end __unmark
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save_button');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}