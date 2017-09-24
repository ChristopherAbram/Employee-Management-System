<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\command;

class Login extends Command {
    // vars {
        
        private $__form         = null;
        private $__email        = null;
        private $__password     = null;
        private $__remember     = null;
        private $__submit       = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'ContentType: text/html; encoding=utf-8'
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    'login.style.css',
                    'form.style.css'
                );
            }
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Form:
                $form = new \core\classes\form\Form('signin');
                $this->__form = $form;
                // E-mail:
                $email = $this->__email();
                // Password: 
                $password = $this->__password();
                // Remember:
                $remember = $this->__remember();
                // Submit:
                $submit = $this->__submit();
                
                // Composing form:
                $form->attach($email);
                $form->attach($password);
                $form->attach($remember);
                $form->attach($submit);
                
                if(\ApplicationRegistry::getCurrentUser() instanceof \core\classes\domain\AuthorizedUser)
                    \core\functions\redirect(\core\functions\address().'/panel');
                
                /*echo '<pre>';
                print_r($_REQUEST);
                echo '</pre>';
                die();*/
                
                $this->assign('front_menu', array('home' => 'Home'));
                
                // Executing form:
                if($form->perform()){
                    $user = \core\classes\domain\factory\User::identify(
                            \core\functions\filter($email->value()), 
                            \core\functions\password($password->value()));
                    if(!is_null($user)){
                        $r_flag = $remember->checked() == true;
                        
                        // Check if user is active:
                        try {
                            $user->loadBasic();
                            $userdata = $user->getData();
                            $data = $userdata->getData();
                            if(isset($data['isactive']) && $data['isactive'] == 0){
                                $this->assign('error_login', true);
                                $this->assign('login_message', Error::get('active'));
                                return self::CMD_OK;
                            }
                        } catch (Exception $ex) {
                        }
                        
                        \core\classes\domain\AuthorizedUser::identification($user, $r_flag);
                        $this->_update_user($user);
                        // redirect to user panel:
                        if(isset($request['url']) && !empty($request['url'])){
                            \core\functions\redirect($request['url']);
                        } 
                        else {
                            \core\functions\redirect(\core\functions\address().'/panel');
                        }
                    }
                    else {
                        $this->assign('error_login', true);
                        $this->assign('login_message', Error::get('login'));
                    }
                }
                
                
                
                //\core\functions\redirect(\core\functions\address());
                return self::CMD_OK;
            }// end _execute
            
            protected function _update_user(\core\classes\domain\User $User){
                try {
                    $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'firstaccess', 'lastaccess'));
                    $User->load($attributes);
                    $user = $User->getData();
                    if(is_null($user)){
                        return false;
                    }
                    $data = $user->getData();
                    if(\array_key_exists('firstaccess', $data) && empty($data['firstaccess'])){
                        $data['firstaccess'] = \time();
                    }
                    $data['lastaccess'] = \time();
                    
                    $user->setData($data);
                    return $user->update();
                } catch (\Exception $ex) {}
                return false;
            }// end _update_user
            
        // } private {
            
            private function __email(){
                $f = new \core\classes\form\field\Email('email');
                $f->required(true);
                $f->expression('//i', '');
                $this->__email = $f;
                return $f;
            }// end __email
            
            private function __password(){
                $f = new \core\classes\form\field\Password('password');
                $f->required(true);
                $f->expression('//i', '');
                $this->__password = $f;
                return $f;
            }// end __password
            
            private function __remember(){
                $f = new \core\classes\form\field\Checkbox('remember');
                $this->__remember = $f;
                return $f;
            }// end __remember
            
            private function __submit(){
                $f = new \core\classes\form\field\Submit('confirm');
                //$f->value('Login');
                $this->__submit = $f;
                return $f;
            }// end __submit
            
        // }
    // }
}