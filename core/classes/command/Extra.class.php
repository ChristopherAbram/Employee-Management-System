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

class Extra extends Registration {
    // vars {
        
        // MultiStep options:
        protected $_next        = null;
        protected $_prev        = 'Address';
        protected static $_step = 3;
        protected static $_cmd  = 'extra';
        
        protected $_done        = false;
        
        // Form:
        protected $__form       = null;
        private $__phone        = null;
        private $__desc         = null;
        private $__citation     = null;
        private $__profile      = null;
        protected $__submit     = null;
        
        protected $__user         = null;
        protected $__user_id    = null;
        
        // Table attributes:
        private $__attributes   = array(
            'id', 'phone', 'description', 'citation', 'profile'
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
            
            protected function _styles($status) {
                return array(
                    'registration.style.css',
                    'board.style.css',
                );
            }
            
            protected function _read(){
                $factory = new \core\classes\data\factory\User();
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    if(!$this->__user_id){
                        return false;
                    }
                    try {
                        $this->__user = $factory->getById($this->__user_id);
                        $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                        if($this->__user->read()){
                            $data = $this->__user->getData();
                            $this->__phone->value($data['phone']);
                            $this->__desc->value($data['description']);
                            $this->__citation->value($data['citation']);
                            if($data['profile'] == 1) $this->__profile->checked(true);
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
                return false;
            }// end _create
            
            protected function _update(){
                try {
                    $factory = new \core\classes\data\factory\User();
                    $this->__user = $factory->getById($this->__user_id);
                    $this->__user->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));

                    // Setting data:
                    $data = array(
                        'id'                => $this->__user->getID(),
                        'phone'             => $this->__phone->value(), 
                        'description'       => $this->__desc->value(), 
                        'citation'          => $this->__citation->value(),
                        'profile'           => $this->__profile->checked() ? 1 : 0,
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
                return false;
            }// end _update
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_DEFAULT;
                
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
                // Cancel:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($phone);
                $form->attach($desc);
                $form->attach($cit);
                $form->attach($profile);
                $form->attach($submit);
                //$form->attach($cancel);
                
                if($this->_opened()){
                    if(isset($this->_data()['id'])){
                        $this->__user_id = (int)$this->_data()['id'];
                    }
                    $d = $this->_data();
                    if(!is_null($d) && isset($d['id'])){
                        $this->_mode(self::UPDATE);
                    }
                    else {
                        $this->_mode(self::CREATE);
                    }
                }
                
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
                        $this->_done = true;
                        $this->_close();
                        $status = self::CMD_OK;
                    }
                }
                else if($form->submitted()){
                    $this->error(Error::get('form_incomplete'));
                }
                // Assignments:
                $this->assignAll(array(
                    'title'     => Text::get('extra_title'),
                    
                    'ancestors' => $this->_activeAncestors(),
                    
                    'done'      => $this->_done,
                    
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
                        'description'   => \core\functions\replace(Text::get('extra_profile_desc'), array('$link' => \core\functions\address().'/member/{user_id}')),
                    ),
                    
                    'submit'    => $submit,
                    'cancel'    => $cancel,
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __phone(){
                $f = new \core\classes\form\field\Text('phone');
                $f->expression('/^[0-9]{3,20}$/i', Error::get('extra_phone'));
                $this->__phone = $f;
                return $f;
            }// end __phone
            
            private function __desc(){
                $f = new \core\classes\form\field\Textarea('desc');
                $f->id('desc_input');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\-\.\/\,\(\)\!\?\%\&\*\_\{\}\[\]\:\;]{3,300}$/i', Error::get('extra_desc'));
                $this->__desc = $f;
                return $f;
            }// end __desc
            
            private function __citation(){
                $f = new \core\classes\form\field\Text('citate');
                $f->id('citation');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\-\,\.\?\!\:\;\s]{3,200}$/i', Error::get('extra_cit'));
                $this->__citation = $f;
                return $f;
            }// end street
            
            private function __profile(){
                $f = new \core\classes\form\field\Checkbox('profile');
                $f->id('profile_check');
                $this->__profile = $f;
                return $f;
            }// end __profile
            
            private function __submit(){
                $f = new \core\classes\form\field\Submit('end');
                $f->value('Save and finish');
                $this->__submit = $f;
                return $f;
            }// ens __submit
            
        // }
    // }
}