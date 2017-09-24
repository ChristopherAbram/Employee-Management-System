<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\classes\command;

class Registration extends MultiStepEditor {
    // vars {
        
        // MultiStep options:
        protected $_key         = 'register_user';
        protected $_begin       = 'Registration';
        protected $_end         = 'Extra';
        protected $_next        = 'Address';
        protected $_prev        = null;
        protected static $_step = 1;
        protected static $_cmd  = 'registration';
    
        protected $__form       = null;
        private $__firstname    = null;
        private $__lastname     = null;
        private $__email        = null;
        private $__password     = null;
        private $__password_con = null;
        private $__sex          = null;
        private $__male         = null;
        private $__female       = null;
        private $__bdate        = null;
        private $__captcha      = null;
        protected $__submit     = null;
        protected $_cancel      = null;
        
        protected $__user       = null;
        protected $__user_id    = null;
        
        private $__user_attribute = array(
            'password', 'firstname', 'lastname', 'email', 'user_role_id',
            'sex', 'cdate', 'bdate', 'token'
        );
    
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
            
            protected function _activeAncestors(){
                $ancestors = array(
                    Text::get('reg_data')     => \core\functions\address().'/registration',
                    Text::get('reg_addr')     => \core\functions\address().'/address',
                    Text::get('reg_extra')    => \core\functions\address().'/extra',
                );
                $step = (int)$this->_step();
                
                /*echo '<pre>';
                print_r($this->_step());
                echo '</pre>';
                die();*/
                
                $active = array();
                $i = 1;
                foreach($ancestors as $title => $link){
                    if($i > $step){
                        break;
                    }
                    $active[$title] = $link;
                    ++$i;
                }
                return $active;
            }// end _activeAncestors
            
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $d = $this->_data();
                    if(isset($d['id'])){
                        $this->__user_id = (int)$d['id'];
                    }
                    else {
                        return false;
                    }
                    try {
                        $this->__user = new \core\classes\data\User($this->__user_id);
                        $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__user_attribute));
                        if($this->__user->read()){
                            $data = $this->__user->getData();
                            $this->__firstname->value($data['firstname']);
                            $this->__lastname->value($data['lastname']);
                            $this->__email->value($data['email']);
                            $this->__password->value($data['password']);
                            $this->__password_con->value($data['password']);
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
                    } catch(\core\classes\data\DataException $ex){
                        $this->error(Error::get('user_read'));
                    }
                    return false;
                }
                return true;
            }// end _read
            
            protected function _create(){
                // If form completed properly:
                try {
                    $this->__user = new \core\classes\data\User();
                    $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__user_attribute));
                    // Setting data:
                    $data = array(
                        'password'          => \core\functions\password($this->__password->value()), 
                        'firstname'         => $this->__firstname->value(), 
                        'lastname'          => $this->__lastname->value(), 
                        'email'             => $this->__email->value(), 
                        'user_role_id'      => 1,  // plain user
                        'sex'               => $this->__sex->value(),
                        'cdate'             => \date(DATETIME), 
                        'bdate'             => $this->__bdate->value(), 
                        'token'             => \core\functions\token($this->__firstname->value().$this->__lastname->value().$this->__email->value())
                    );
                    $this->__user->setData($data);
                    // User creation:
                    if($this->__user->create()){
                        $this->correct(Correct::get('registration'));
                        $this->_open(array(
                            'id'    => $this->__user->getID(),
                            'token' => $data['token']
                        ));
                        return true;
                    }
                    else {
                        $this->error(Error::get('registration'));
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('user_create'));
                }
                return false;
            }// end _create
            
            protected function _update(){
                $d = $this->_data();
                if(isset($d['id'])){
                    $this->__user_id = (int)$d['id'];
                }
                else {
                    return false;
                }
                try {
                    $factory = new \core\classes\data\factory\User();
                    $this->__user = $factory->getById($this->__user_id);
                    $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'password', 'firstname', 'lastname', 'email',
                        'sex', 'bdate', 'token'
                    )));

                    // Setting data:
                    $data = array(
                        'id'                => $this->__user->getID(),
                        'password'          => \core\functions\password($this->__password->value()), 
                        'firstname'         => $this->__firstname->value(), 
                        'lastname'          => $this->__lastname->value(), 
                        'email'             => $this->__email->value(),
                        'sex'               => $this->__sex->value(),
                        'bdate'             => $this->__bdate->value(), 
                        'token'             => \core\functions\token($this->__firstname->value().$this->__lastname->value().$this->__email->value())
                    );
                    $this->__user->setData($data);

                     // Update user data:
                    if($this->__user->update()){
                        $d = $this->_data();
                        if(!is_null($d)){
                            $d['token'] = $data['token'];
                            $this->_data($d);
                        }
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
                //$this->_close();
                
                // Form:
                $form = new \core\classes\form\Form('registration');
                $this->__form = $form;
                // Firstname:
                $firstname = $this->__firstname();
                // Lastname:
                $lastname = $this->__lastname();
                // Email:
                $email = $this->__email();
                // Password:
                $password = $this->__password();
                $password_con = $this->__password_con();
                
                $pass_med = new \core\classes\form\Mediator();
                $pass_med->addAll(array($password, $password_con));
                $pass_med->dependency(function($password1, $password2){
                                            return ($password1->value() == $password2->value());
                                        });
                // Sex:
                $sex = $this->__sex();
                $male = $this->__male();
                $female = $this->__female();
                $sex->attach($male);
                $sex->attach($female);
                // Birth date:
                $bdate = $this->__bdate();
                // Captcha:
                $captcha = $this->__captcha();
                // Submit:
                $submit = $this->__submit();
                // Cancel:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($firstname);
                $form->attach($lastname);
                $form->attach($email);
                $form->attach($password);
                $form->attach($password_con);
                $form->attach($pass_med);
                $form->attach($sex);
                $form->attach($male);
                $form->attach($female);
                $form->attach($bdate);
                $form->attach($captcha);
                $form->attach($submit);
                //$form->attach($cancel);
                
                // End registration session:
                if($cancel->submitted()){
                    $this->_cancel();
                }
                
                // Reading data if user already exists:
                if(!$this->_read()){
                    $this->error(Error::get('user_read'));
                }
                
                // Performing the form and saving changes:
                if($form->perform()){
                    if($this->_save()){
                        $status = self::NEXT;
                    }
                } 
                else if($form->submitted()) {
                    $this->error(Error::get('form_incomplete'));
                }
                
                $this->assignAll(array(
                    'title'     => Text::get('reg_title'),
                    'description'   => Text::get('reg_desc'),
                    
                    'ancestors' => $this->_activeAncestors(),
                    
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
                    'password_med'  => $pass_med,
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
                    'captcha'  => array(
                        'title'         => Text::get('reg_captcha'),
                        'input'         => $captcha,
                        'description'   => Text::get('reg_captcha_desc'),
                    ),
                    'submit'    => $submit,
                    'cancel'    => $cancel,
                ));
                
                return $status;
            }// end _execute
            
            protected function _cancel(){
                if($this->_opened()){
                    $id = 0;
                    $d = $this->_data();
                    if(isset($d['id'])){
                        $id = (int)$d['id'];
                    }
                    if($id > 0){
                        $factory = new \core\classes\data\factory\User();
                        $user = $factory->getById($id);
                        if($user){
                            $user->delete();
                        }
                    }
                    $this->_close();
                }
                \core\functions\redirect(\core\functions\address());
            }// end _cancel
            
            protected function __cancel(){
                $f = new \core\classes\form\field\SubmitButton('cancel');
                $f->value('Cancel');
                $f->form('cancel');
                $this->_cancel = $f;
                return $f;
            }// end _cancel
            
        // } private {
            
            private function __firstname(){
                $firstname = new \core\classes\form\field\Text('firstname');
                $firstname->required(true);
                $firstname->id('firstname');
                $firstname->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{3,90}$/i', Error::get('reg_name'));
                $this->__firstname = $firstname;
                return $firstname;
            }
            
            private function __lastname(){
                $lastname = new \core\classes\form\field\Text('lastname');
                $lastname->required(true);
                $lastname->id('lastname');
                $lastname->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{3,90}$/i', Error::get('reg_lastname'));
                $this->__lastname = $lastname;
                return $lastname;
            }
            
            private function __email(){
                $email = new \core\classes\form\field\Email('email');
                $email->required(true);
                $email->id('user_email');
                $id = $this->_data();
                if(!is_null($id) && isset($id['id'])){
                    $id = (int)$id['id'];
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
                    } catch (Exception $ex) {
                        
                    }
                    return true;
                }, Error::get('email_already_exists'));
                $this->__email = $email;
                return $email;
            }
            
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
                if($this->_opened() && ($this->_mode() == self::UPDATE)){
                    $submit->value('Save and next');
                }
                else {
                    $submit->value('Sign Up');
                }
                $this->__submit = $submit;
                return $submit;
            }
            
        // }
    // }
}