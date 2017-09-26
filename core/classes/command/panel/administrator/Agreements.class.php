<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\administrator;

class Agreements extends \core\classes\command\panel\ListCommand {
    // vars {
    
        protected $_list        = array();
        
        // Form fields:
        private $__form         = null;
        // Buttons:
        private $__remove       = null;
    
    // } methods {
    
        // public {
            
            public function remove(){
                // Page factory:
                $factory = new \core\classes\data\factory\Department();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('agreement');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $department = $factory->getById($id);
                    if(!is_null($department)){
                        return $department->delete();
                    }
                    return false;
                });
            }
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_DEFAULT || $status == self::CMD_OK){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(200)
                    );
                }
                else if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/articlelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Form:
                $form = new \core\classes\form\Form('department_list');
                $this->__form = $form;
                
                // Buttons:
                $remove = $this->__remove();
                
                // Compose form:
                $form->attach($remove);
                
                // Button functions:
                $remove->onsubmit(array($this, 'remove'));
                
                $this->assign('title', 'Departments management list');
                
                // Count all results:
                $this->_count_results();
                // Retrieve a pointer (current page):
                $this->_requested_page();
                // Page exists?:
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting article list:
                $this->_load_list($this->_page);

                // Assignments:
                $this->assignAll(array(

                    // Article list
                    'departments'      => &$this->_list,
                    'page_number'      => $this->_page,

                    // Toolbar:
                    'toolbar_left'      => !empty($this->_list) ? array() : array(),
                    'toolbar_right'     => !empty($this->_list) ? array($remove, $this->_switch()) : array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_results(){
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(is_null($User)){
                        return;
                    }
                    $count = \core\classes\data\Department::count();
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _load_list() {
                try {
                    $factory = new \core\classes\data\factory\Department();
                    $set = $factory->getAll($this->_page, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Department(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }
            
            protected function _get_data(\core\classes\domain\collection\set\Department $set){
                try {
                    // Load article data:
                    $set->load(new \core\classes\sql\attribute\AttributeList(array('id', 'namepath', 'name', 'description', 'city', 'zip', 'street', 'house', 'flat')));
                    
                    /*// Load additional data:
                    $set->accept(function($Article){
                        
                        return true;
                    });*/
                    
                    // Extract data:
                    foreach($set as $Department){
                        $this->_list[$Department->getID()] = &$Department->getPresentationData();
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _get_data
            
        // } private {
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
        // }
    // }
}