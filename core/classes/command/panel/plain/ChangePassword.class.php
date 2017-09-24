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

class ChangePassword extends Command {
    // vars {
        
        protected $__form       = null;
        private $__password_old = null;
        private $__password     = null;
        private $__password_con = null;
        protected $__submit     = null;
        protected $_cancel      = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200),
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'registration.style.css'
                );
            }// end _styles
            
            protected function _read(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return false;
                }
                $id = $User->getID();
                
                return true;
            }// end _read
            
            protected function _update(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return false;
                }
                $id = $User->getID();
                try {
                    $factory = new \core\classes\data\factory\User();
                    $user = $factory->getById($id);
                    $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'password'
                    )));
                    
                    // Setting data:
                    $data = array(
                        'id'                => $user->getID(),
                        'password'          => \core\functions\password($this->__password->value())
                    );
                    $user->setData($data);

                     // Update user data:
                    if($user->update()){
                        $this->correct(Correct::get('update'));
                        return true;
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('user_update'));
                }
                return false;
            }// end _update
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_ERROR;
                
                // Form:
                $form = new \core\classes\form\Form('changepassword');
                $this->__form = $form;
                
                // Password:
                $password = $this->__password();
                $password_con = $this->__password_con();
                $password_old = $this->__password_old();
                
                $pass_med = new \core\classes\form\Mediator();
                $pass_med->addAll(array($password, $password_con, $password_old));
                $pass_med->dependency(function($password1, $password2, $password_old){
                    $old = \core\functions\password($password_old->value());
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(!is_null($User)){
                        $user = $User->getData();
                        $data = $user->getData();
                        if(isset($data['password']) && ($old == $data['password'])){
                            return ($password1->value() == $password2->value());
                        }
                    }
                    return false;
                });
                
                $submit = $this->__submit();
                
                // Composing form:
                $form->attach($password);
                $form->attach($password_con);
                $form->attach($password_old);
                $form->attach($pass_med);
                $form->attach($submit);
                
                // Performing the form and saving changes:
                if($form->perform()){
                    if($this->_update()){
                        $status = self::CMD_OK;
                    }
                } 
                else if($form->submitted()) {
                    $this->error(Error::get('form_incomplete'));
                }
                
                // Reading data if user already exists:
                if(!$this->_read()){
                    $this->error(Error::get('user_read'));
                }
                
                $this->assignAll(array(
                    'title'     => 'Change password',
                    'description'   => Text::get('reg_desc'),
                    
                    // form:
                    'password'      => array(
                        'title'         => Text::get('reg_pass'),
                        'input'         => $password,
                        'description'   => Text::get('reg_pass_desc'),
                    ),
                    'confirm_password'  => array(
                        'title'         => Text::get('reg_con_pass'),
                        'input'         => $password_con,
                        'description'   => Text::get('reg_con_pass_desc'),
                    ),
                    'old_password'  => array(
                        'title'         => Text::get('reg_old_pass'),
                        'input'         => $password_old,
                        'description'   => Text::get('reg_old_pass_desc'),
                    ),
                    'password_med'  => $pass_med,
                    
                    'toolbar_left'  => array($submit),
                    
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __password(){
                $password = new \core\classes\form\field\Password('password', false);
                $password->required(true);
                $password->id('user_password');
                $password->expression('/^[A-Za-z0-9]{3,39}$/i', Error::get('reg_password'));
                $this->__password = $password;
                return $password;
            }
            
            private function __password_con(){
                $password_con = new \core\classes\form\field\Password('confirm_password', false);
                $password_con->required(true);
                $password_con->id('confirm_password');
                $password_con->expression('/^[A-Za-z0-9]{3,39}$/i', Error::get('reg_password'));
                $this->__password_con = $password_con;
                return $password_con;
            }
            
            private function __password_old(){
                $password_old = new \core\classes\form\field\Password('old_password', false);
                $password_old->required(true);
                $password_old->id('old_password');
                $password_old->expression('/^[A-Za-z0-9]{3,39}$/i', Error::get('reg_password'));
                $this->__password_old = $password_old;
                return $password_old;
            }
            
            private function __submit(){
                $submit = new \core\classes\form\field\Submit('confirm'); 
                $submit->value('Save');
                $this->__submit = $submit;
                return $submit;
            }
            
        // }
    // }
}