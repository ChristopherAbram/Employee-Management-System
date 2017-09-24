<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\classes\command\panel\administrator;

class Extra extends \core\classes\command\Extra {
    // vars {
        
        // MultiStep options:
        protected $_key         = '__adminregistration';
        
        protected $__level1     = null;
        protected $__level2     = null;
        protected $__level3     = null;
        
        private $__request      = null;
        
        // Table attributes:
        private $__attributes   = array(
            'id', 'phone', 'description', 'citation'
        );
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _read(){
                $factory = new \core\classes\data\factory\User();
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    if(parent::_read()){
                        try {
                            $this->__user = $factory->getById($this->__user_id);
                            $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'user_role_id')));
                            if($this->__user->read()){
                                $data = $this->__user->getData();
                                if(isset($data['user_role_id'])){
                                    $role = $data['user_role_id'];
                                    if($role == 1){ $this->__level1->checked(true); }
                                    else if($role == 2){ $this->__level2->checked(true); }
                                    else if($role == 3){ $this->__level3->checked(true); }
                                    else { $this->__level1->checked(true); }
                                }
                                return true;
                            }
                        } catch(\core\classes\data\DataException $ex){
                            $this->error(Error::get('user_read'));
                        }
                        return false;
                    }
                }
                return true;
            }// end _read
            
            protected function _create(){
                return false;
            }// end _create
            
            protected function _update(){
                if(parent::_update()){
                    try {
                        $factory = new \core\classes\data\factory\User();
                        $this->__user = $factory->getById($this->__user_id);
                        $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'user_role_id')));
                        
                        // Setting data:
                        $data = array(
                            'id'                => $this->__user->getID(),
                            'user_role_id'      => isset($_POST['user_r']) ? (int)\core\functions\filter($_POST['user_r']) : 3,
                        );
                        $this->__user->setData($data);
                        // Address creation:
                        if($this->__user->update()){
                            $this->correct(Correct::get('update'));
                            return true;
                        }
                        else {
                            $this->error(Error::get('update'));
                        }
                    } catch(\core\classes\data\DataException $ex){
                        $this->error('user_update');
                    }
                }
                return false;
            }// end _update
            
            protected function _execute(\core\classes\request\Request $request){
                
                $this->__request = $request;
                
                $this->__level1();
                $this->__level2();
                $this->__level3();
                
                $status = parent::_execute($request);
                
                // Assignments:
                $this->assignAll(array(
                    
                    // form:
                    'role'     => array(
                        'title'         => 'User role',
                        'title1'        => 'Administrator',
                        
                        'title2'        => 'Plain',
                        'input1'        => $this->__level1,
                        'input2'        => $this->__level3,
                        'description'   => '',
                    ),
                    
                    // Toolbar:
                    'toolbar_left'      => array($this->__submit),
                    'toolbar_right'     => array($this->_cancel),
                    
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
           private function __level1(){
               $f = new \core\classes\form\field\Radio('user_r');
               //$f->form('ext');
               $f->value(1);
               $this->__level1 = $f;
               return $f;
           }// end __level1
           
           private function __level2(){
               $f = new \core\classes\form\field\Radio('user_r');
               //$f->form('ext');
               $f->value(2);
               $this->__level2 = $f;
               return $f;
           }// end __level2
           
           private function __level3(){
               $f = new \core\classes\form\field\Radio('user_r');
               //$f->form('ext');
               $f->value(2);
               $this->__level3 = $f;
               return $f;
           }// end __level3
            
        // }
    // }
}