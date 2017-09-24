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

class Account extends Command {
    // vars {
        
        protected $__form       = null;
        private $__firstname    = null;
        private $__lastname     = null;
        private $__email        = null;
        private $__sex          = null;
        private $__male         = null;
        private $__female       = null;
        private $__bdate        = null;
        private $__captcha      = null;
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
                try {
                    $user = $User->getData();
                    $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'password', 'firstname', 'lastname', 'email', 'user_role_id', 'sex', 'cdate', 'bdate', 'token'
                    )));
                    if($user->read()){
                        $data = $user->getData();
                        $this->__firstname->value($data['firstname']);
                        $this->__lastname->value($data['lastname']);
                        $this->__email->value($data['email']);
                        if($data['sex'] == 'M'){
                            $this->__male->checked(true);
                            $this->__female->checked(false);
                        } else if($data['sex'] == 'F') {
                            $this->__male->checked(false);
                            $this->__female->checked(true);
                        } else {
                            $this->__male->checked(true);
                            $this->__female->checked(false);
                        }
                        $this->__bdate->value($data['bdate']);
                        return true;
                    }
                    return false;
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('user_read'));
                }
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
                        'id', 'firstname', 'lastname', 'email', 'sex', 'bdate', 'token'
                    )));
                    
                    // Setting data:
                    $data = array(
                        'id'                => $user->getID(),
                        'firstname'         => $this->__firstname->value(), 
                        'lastname'          => $this->__lastname->value(), 
                        'email'             => $this->__email->value(),
                        'sex'               => $this->__sex->value(),
                        'bdate'             => $this->__bdate->value(), 
                        'token'             => \core\functions\token($this->__firstname->value().$this->__lastname->value().$this->__email->value())
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
                $form = new \core\classes\form\Form('userdata');
                $this->__form = $form;
                // Firstname:
                $firstname = $this->__firstname();
                // Lastname:
                $lastname = $this->__lastname();
                // Email:
                $email = $this->__email();
                
                // Sex:
                $sex = $this->__sex();
                $male = $this->__male();
                $female = $this->__female();
                $sex->attach($male);
                $sex->attach($female);
                // Birth date:
                $bdate = $this->__bdate();
                // Submit:
                $submit = $this->__submit();
                
                // Composing form:
                $form->attach($firstname);
                $form->attach($lastname);
                $form->attach($email);
                $form->attach($sex);
                $form->attach($male);
                $form->attach($female);
                $form->attach($bdate);
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
                    'title'         => 'Your data',
                    'description'   => Text::get('reg_desc'),
                    
                    // form:
                    'firstname'     => array(
                        'title'         => Text::get('reg_firstname'),
                        'input'         => $firstname,
                        'description'   => Text::get('reg_firstname_desc'),
                    ),
                    'lastname'      => array(
                        'title'         => Text::get('reg_lastname'),
                        'input'         => $lastname,
                        'description'   => Text::get('reg_lastname_desc'),
                    ),
                    'email'      => array(
                        'title'         => Text::get('reg_email'),
                        'input'         => $email,
                        'description'   => Text::get('reg_email_desc'),
                    ),
                    'sex'           => array(
                        'title'         => Text::get('reg_sex'),
                        'male'          => $male,
                        'male_title'    => Text::get('reg_male'),
                        'female'        => $female,
                        'female_title'  => Text::get('reg_female'),
                        'description'   => Text::get('reg_sex_desc'),
                    ),
                    'bdate'  => array(
                        'title'         => Text::get('reg_bdate'),
                        'input'         => $bdate,
                        'description'   => Text::get('reg_bdate_desc'),
                    ),
                    
                    'toolbar_left'  => array($submit),
                    
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __firstname(){
                $firstname = new \core\classes\form\field\Text('firstname');
                $firstname->required(true);
                $firstname->id('firstname');
                $firstname->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\'\-\s]{3,90}$/i', Error::get('reg_name'));
                $this->__firstname = $firstname;
                return $firstname;
            }
            
            private function __lastname(){
                $lastname = new \core\classes\form\field\Text('lastname');
                $lastname->required(true);
                $lastname->id('lastname');
                $lastname->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\'\-\s]{3,90}$/i', Error::get('reg_lastname'));
                $this->__lastname = $lastname;
                return $lastname;
            }
            
            private function __email(){
                $email = new \core\classes\form\field\Email('email');
                $email->required(true);
                $email->id('user_email');
                
                $User = \ApplicationRegistry::getCurrentUser();
                $id = null;
                if(!is_null($User)){
                    $id = $User->getID();
                }
                
                $email->callback(function($field) use($id){
                    
                    if(!\core\functions\is_email($field->value())){
                        $field->setCallbackError(true);
                        $field->setCallbackErrorMessage(Error::get('wrong_email'));
                    }
                    
                    try {
                        $value = $field->value();
                        $iddb = \core\classes\data\factory\User::emailExists($value);
                        if(!is_null($iddb) && ($iddb != $id)){
                            return false;
                        }
                    } catch (\Exception $ex) {
                        
                    }
                    return true;
                }, Error::get('email_already_exists'));
                $this->__email = $email;
                return $email;
            }
            
            private function __sex(){
                $sex = new \core\classes\form\field\RadioGroup('sex');
                $this->__sex = $sex;
                return $sex;
            }
            
            private function __male(){
                $male = new \core\classes\form\field\Radio('sex');
                $male->checked(true);
                $male->value('M');
                $this->__male = $male;
                return $male;
            }
            
            private function __female(){
                $female = new \core\classes\form\field\Radio('sex');
                $female->value('F');
                $this->__female = $female;
                return $female;
            }
            
            private function __bdate(){
                $bdate = new \core\classes\form\field\Date('birth_date');
                $bdate->id('bdate');
                $bdate->required(true);
                $bdate->min('1900-01-01');
                $bdate->max('2016-01-01');
                $this->__bdate = $bdate;
                return $bdate;
            }
            
            private function __captcha(){
                $captcha = new \core\classes\form\field\Captcha('captcha');
                $captcha->pluginLink(\core\functions\address().'/captcha');
                $captcha->required(true);
                $captcha->id('captcha_input');
                $captcha->callback(function($field){
                                    $session = \core\classes\session\Session::getInstance();
                                    if(isset($session['captcha'])){
                                        return ($session['captcha'] == $field->value());
                                    }
                                    return false;
                                }, Error::get('reg_captcha'));
                $this->__captcha = $captcha;
                return $captcha;
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