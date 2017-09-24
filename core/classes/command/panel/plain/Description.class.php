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

class Description extends Command {
    // vars {
        
        // Form:
        protected $__form       = null;
        private $__phone        = null;
        private $__desc         = null;
        private $__citation     = null;
        private $__profile      = null;
        protected $__submit     = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200),
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    'registration.style.css',
                    'board.style.css',
                );
            }
            
            protected function _read(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return $User;
                }
                try {
                    $user = $User->getData();
                    if(is_null($user)){
                        return false;
                    }
                    $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'phone', 'description', 'citation', 'profile')));
                    if($user->read()){
                        $data = $user->getData();
                        $this->__phone->value($data['phone']);
                        $this->__desc->value($data['description']);
                        $this->__citation->value($data['citation']);
                        if($data['profile'] == 1) $this->__profile->checked(true);
                        return true;
                    }
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
                try {
                    $user = $User->getData();
                    if(is_null($user)){
                        return false;
                    }
                    $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'phone', 'description', 'citation', 'profile')));
                    
                    // Setting data:
                    $data = array(
                        'id'                => $user->getID(),
                        'phone'             => $this->__phone->value(), 
                        'description'       => $this->__desc->value(), 
                        'citation'          => $this->__citation->value(),
                        'profile'           => $this->__profile->checked() ? 1 : 0,
                    );
                    $user->setData($data);
                    // Address creation:
                    if($user->update()){
                        $this->correct(Correct::get('update'));
                        return true;
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error('user_update');
                }
                return false;
            }// end _update
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_DEFAULT;
                
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    return self::CMD_ERROR;
                }
                
                // Form:
                $this->__form = new \core\classes\form\Form('ext');
                $form = $this->__form;
                // Phone field:
                $phone = $this->__phone();
                // Description field:
                $desc = $this->__desc();
                // Citation field:
                $cit = $this->__citation();
                $profile = $this->__profile();
                // Submit button:
                $submit = $this->__submit();
                
                // Composing form:
                $form->attach($phone);
                $form->attach($desc);
                $form->attach($cit);
                $form->attach($profile);
                $form->attach($submit);
                
                // Performing the form and saving changes:
                if($form->perform()){
                    if($this->_update()){
                        $status = self::CMD_OK;
                    }
                }
                else if($form->submitted()){
                    $this->error(Error::get('form_incomplete'));
                }
                
                // Reading data if user already exists:
                if(!$this->_read()){
                    $this->error(Error::get('user_read'));
                }
                
                // Assignments:
                $this->assignAll(array(
                    'title'     => Text::get('extra_title'),
                    
                    // form:
                    'phone'     => array(
                        'title'         => Text::get('extra_phone'),
                        'input'         => $phone,
                        'description'   => Text::get('extra_phone_desc'),
                    ),
                    
                    'desc'     => array(
                        'title'         => Text::get('extra_desc'),
                        'input'         => $desc,
                        'description'   => Text::get('extra_desc_desc'),
                    ),
                    
                    'citation'     => array(
                        'title'         => Text::get('extra_cit'),
                        'input'         => $cit,
                        'description'   => Text::get('extra_cit_desc'),
                    ),
                    
                    'profile'     => array(
                        'title'         => Text::get('extra_profile'),
                        'input'         => $profile,
                        'description'   => \core\functions\replace(Text::get('extra_profile_desc'), array('$link' => \core\functions\address().'/member/'.$User->getID())),
                    ),
                    
                    'toolbar_left'  => array($submit),
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __phone(){
                $f = new \core\classes\form\field\Text('phone');
                $f->expression('/^[0-9\s]{3,20}$/i', Error::get('extra_phone'));
                $this->__phone = $f;
                return $f;
            }// end __phone
            
            private function __desc(){
                $f = new \core\classes\form\field\Textarea('desc');
                $f->id('desc_input');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\-\.\/\,\(\)\!\?\%\&\*\_\{\}\[\]\:\;\'\"]{5,500}$/i', Error::get('extra_desc'));
                $this->__desc = $f;
                return $f;
            }// end __desc
            
            private function __citation(){
                $f = new \core\classes\form\field\Text('citate');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\-\,\.\?\!\:\;\'\"\s]{3,200}$/i', Error::get('extra_cit'));
                $this->__citation = $f;
                return $f;
            }// end street
            
            private function __profile(){
                $f = new \core\classes\form\field\Checkbox('profile');
                //$f->value('on');
                $f->id('profile_check');
                $this->__profile = $f;
                return $f;
            }// end __profile
            
            private function __submit(){
                $f = new \core\classes\form\field\Submit('end');
                $f->value('Save');
                $this->__submit = $f;
                return $f;
            }// ens __submit
            
        // }
    // }
}