<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\administrator;

class AddAgreement extends \core\classes\command\Editor {
    // vars {
        
        private $__user_id          = null;
    
        private $__form             = null;
        
        private $__department       = null;
        private $__responsibility   = null;
        private $__working_time     = null;
        private $__salary           = null;
        private $__from             = null;
        private $__to               = null;
        private $__description      = null;
       
        private $__save             = null;
        private $__cancel           = null;

    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/pageeditor.style.css'
                );
            }// end _styles
    
            protected function _retrieveId(){
                $session = \core\classes\session\Session::getInstance();
                if(isset($session['member'])){
                    $this->__user_id = (int)$session['member'];
                    return $this->__user_id;
                }
                return null;
            }// end _retrieveId
        
            protected function _read(){
                
                return true;
            }// end _read
            
            protected function _update(){
                
                return false;
            }// end _update
            
            protected function _create(){
                try {
                    $agr = new \core\classes\data\Agreement();
                    
                    // Setting data:
                    $data = array(
                        'user_id'               => $this->__user_id,
                        'department_id'         => (int)$this->__department->value(),
                        'responsibility_id'     => (int)$this->__responsibility->value(),
                        'working_time_id'       => (int)$this->__working_time->value(),
                        'salary'                => $this->__salary->value(),
                        'from_date'             => empty($this->__from->value()) ? \date(DATE) : $this->__from->value(),
                        'to_date'               => empty($this->__to->value()) ? null : $this->__to->value(),
                        'description'           => $this->__desc->value(),
                    );
                    $agr->setData($data);
                    
                    if($agr->create()){
                        $this->correct(Correct::get('agr_create'));
                        return true;
                    }
                    else {
                        $this->error(Error::get('agr_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('agr_create'));
                }
                return false;
            }// end _create
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Get user id:
                $this->_retrieveId();
                if(is_null($this->__user_id))
                    return self::CMD_ERROR;
                
                // Only creation mode:
                $this->_mode(self::CREATE);
                
                
                // Form:
                $form = new \core\classes\form\Form('agreement');
                $this->__form = $form;
                
                // Save button:
                $save = $this->__save();
                $cancel = $this->__cancel();
                
                $form->attach($save);
                $form->attach($cancel);
                
                $department = $this->__department();
                $responsibility = $this->__responsibility();
                $working_time = $this->__working_time();
                $salary = $this->__salary();
                $from = $this->__from();
                $to = $this->__to();
                $description = $this->__description();
                
                // Composing form:
                $form->attach($department);
                $form->attach($responsibility);
                $form->attach($working_time);
                $form->attach($salary);
                $form->attach($from);
                $form->attach($to);
                $form->attach($description);
                
                
                // Executing form:
                if($save->submitted()){
                    
                    if($form->perform()){
                        if($this->_save()){
                            $this->correct(Correct::get('agr_create'));
                            return self::CMD_OK;
                        }
                    }
                    else {
                        $this->error(Error::get('form_incomplete'));
                    }
                }
                else if($cancel->submitted()){
                    $this->_cancel();
                }
                
                $this->assignAll(array(
                    
                    // form:
                    'department'       => array(
                        'title'         => 'Select department',
                        'input'         => $department,
                        'description'   => '',
                    ),
                    'responsibility'       => array(
                        'title'         => 'Select responsibility',
                        'input'         => $responsibility,
                        'description'   => '',
                    ),
                    'working_time'       => array(
                        'title'         => 'Select working time',
                        'input'         => $working_time,
                        'description'   => '',
                    ),
                    'salary'       => array(
                        'title'         => 'Specify salary',
                        'input'         => $salary,
                        'description'   => '',
                    ),
                    
                    'from_date'       => array(
                        'title'         => 'Agreement valid since the date',
                        'input'         => $from,
                        'description'   => 'Today is set by default.',
                    ),
                    'to_date'       => array(
                        'title'         => 'Agreement valid until the date',
                        'input'         => $to,
                        'description'   => 'Not required',
                    ),
                    'desc'       => array(
                        'title'         => 'Extra data',
                        'input'         => $description,
                        'description'   => '',
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save),
                    'toolbar_right' => array($cancel),
                ));
                
                return self::CMD_DEFAULT;
            }// end _execute
            
            protected function _cancel(){
                \core\functions\redirect(\core\functions\address().'/panel/add-agreement');
            }// end _cancel
            
        // } private {
            
            private function __department(){
                $f = new \core\classes\form\field\Select('department');
                $f->required(true);
                $f->id('departments');
                
                try {
                    $factory = new \core\classes\data\factory\Department();
                    $set = $factory->getAll(1, 1000);
                    // Setting options:
                    foreach($set as $item){
                        if(!$item->read()){
                            $this->error(Error::get('departments_load'));
                            break;
                        }
                        $data = $item->getData();
                        if(isset($data['name'])){
                            $option = new \core\classes\form\field\Option($data['name'], $item->getID());
                            $f->add($option);
                        }
                        else {
                            $this->error(Error::get('departments_load'));
                            break;
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('departments_load'));
                }
                $this->__department = $f;
                return $f;
            }
            
            private function __responsibility(){
                $f = new \core\classes\form\field\Select('responsibility');
                $f->required(true);
                $f->id('responsibilities');
                
                try {
                    $factory = new \core\classes\data\factory\Responsibility();
                    $set = $factory->getAll(1, 1000);
                    // Setting options:
                    foreach($set as $item){
                        if(!$item->read()){
                            $this->error(Error::get('responsibility_load'));
                            break;
                        }
                        $data = $item->getData();
                        if(isset($data['name'])){
                            $option = new \core\classes\form\field\Option($data['name'], $item->getID());
                            $f->add($option);
                        }
                        else {
                            $this->error(Error::get('responsibility_load'));
                            break;
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('responsibility_load'));
                }
                $this->__responsibility = $f;
                return $f;
            }
            
            private function __working_time(){
                $f = new \core\classes\form\field\Select('working_time');
                $f->required(true);
                $f->id('working-times');
                
                try {
                    $factory = new \core\classes\data\factory\WorkingTime();
                    $set = $factory->getAll();
                    // Setting options:
                    foreach($set as $item){
                        if(!$item->read()){
                            $this->error(Error::get('working_time_load'));
                            break;
                        }
                        $data = $item->getData();
                        if(isset($data['name'])){
                            $option = new \core\classes\form\field\Option($data['name'], $item->getID());
                            $f->add($option);
                        }
                        else {
                            $this->error(Error::get('working_time_load'));
                            break;
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('working_time_load'));
                }
                $this->__working_time = $f;
                return $f;
            }
            
            private function __salary(){
                $f = new \core\classes\form\field\Number('salary');
                $f->required(true);
                $f->id('salary');
                $f->step(0.01);
                if(!$this->__form->submitted())
                    $f->value(1950.51);
                $this->__salary = $f;
                return $f;
            }
            
            private function __from(){
                $f = new \core\classes\form\field\Date('from_date');
                $f->min(\date(DATE));
                $f->callback(function($field){
                    if(!empty($field->value()) && ($field->value() < \date(DATE)))
                        return false;
                    return true;
                }, Error::get('since_date'));
                if(!$this->__form->submitted())
                    $f->value(\date(DATE));
                $this->__from = $f;
                return $f;
            }
            
            private function __to(){
                $f = new \core\classes\form\field\Date('to_date');
                $f->required(false);
                $f->min(\date(DATE));
                $from = $this->__from;
                $f->callback(function($field) use($from){
                    if(!empty($field->value()) && ($field->value() < \date(DATE)))
                        return false;
                    if(!empty($field->value()) && !empty($from->value()) && ($field->value() < $from->value()))
                        return false;
                    return true;
                }, Error::get('to_date'));
                $this->__to = $f;
                return $f;
            }
            
            private function __description(){
                $f = new \core\classes\form\field\Textarea('desc');
                $f->id('desc_input');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\-\.\/\,\(\)\!\?\%\&\*\_\{\}\[\]\:\;]{3,300}$/i', Error::get('desc'));
                $this->__desc = $f;
                return $f;
            }
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save');
                $f->value('Sign agreement');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Cancel');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}