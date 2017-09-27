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

class Agreements extends \core\classes\command\panel\plain\Agreements {
    // vars {
    
        protected $_remove = null;
        protected $_terminate = null;
    
    // } methods {
    
        // public {
            
           public function remove(){
                
                $factory = new \core\classes\data\factory\Agreement();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('agreement');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $agreement = $factory->getById($id);
                    if(!is_null($agreement)){
                        return $agreement->delete();
                    }
                    return false;
                });
           }
           
           public function terminate(){
               $factory = new \core\classes\data\factory\Agreement();
                
                $operation = new \core\classes\operation\SingleRequest();
                $operation->setName('agreement');
                $operation->onsuccess(function(){
                    $this->correct(Correct::get('update'));
                });
                $operation->onerror(function(){
                    $this->error(Error::get('update'));
                });
                $operation->update(function($id, $val) use($factory){
                    $agreement = $factory->getById($id);
                    if(!is_null($agreement)){
                        return $agreement->terminate();
                    }
                    return false;
                });
           }
            
        // } protected {
    
            protected function _execute(\core\classes\request\Request $request) {
                // Form:
                $form = new \core\classes\form\Form('agreement');
                $this->__form = $form;
                
                $this->__remove();
                $this->__terminate();
                
                $this->_remove->onsubmit(array($this, 'remove'));
                $this->_terminate->onsubmit(array($this, 'terminate'));
                
                $this->__form->attach($this->_remove);
                $this->__form->attach($this->_terminate);
                
                $this->_retrieve_id();
                
                $this->_count_results();
                $this->_requested_page();
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting comments list:
                $this->_load_list();

                // Assignments:
                $this->assignAll(array(
                    'title'            => 'Agreements',
                    
                    'agreements'       => &$this->_list,
                    'page_number'      => $this->_page,

                    // Toolbar:
                    'toolbar_left'      => !empty($this->_list) ? array($this->_terminate) : array(),
                    'toolbar_right'     => !empty($this->_list) ?  array($this->_remove, $this->_switch()) : array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }
    
            protected function _retrieve_id(){
                $session = \core\classes\session\Session::getInstance();
                if(isset($session['member']))
                    $this->_user_id = (int)$session['member'];
            }
            
        // } private {
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->_remove = $f;
                return $f;
            }
            
            private function __terminate(){
                $f = new \core\classes\form\field\Submit('terminate_button');
                $f->value('Terminate agreement');
                $this->_terminate = $f;
                return $f;
            }
            
        // }
    // }
}