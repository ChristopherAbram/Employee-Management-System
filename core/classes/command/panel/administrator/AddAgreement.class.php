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
                $id = $this->_retrieveId();
                try {
                    if(!is_null($id)){
                        $factory = new \core\classes\data\factory\Department();
                        $department = $factory->getById($id);
                        if(!is_null($department)){
                            $department->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'name', 'description', 'city','zip', 'street', 'house', 'flat'
                            )));
                            // Setting data:
                            $data = array(
                                'id'            => $department->getID(),
                                
                                'name'         => $this->__name->value(),
                                'description'   => $this->__description->value(),
                                'city'          => $this->__city->value(),
                                'zip'          => $this->__zip->value(),
                                'street'          => $this->__street->value(),
                                'house'          => $this->__house->value(),
                                'flat'          => $this->__flat->value(),
                                
                            );
                            $department->setData($data);
                            if($department->update()){
                                $this->correct(Correct::get('update'));
                                return true;
                            }
                        }
                    }
                    $this->error(Error::get('update'));
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('dep_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                /*try {
                    $department = new \core\classes\data\Department();
                    //$department->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                    // Setting data:
                    $data = array(
                        'name'         => $this->__name->value(),
                        'namepath'      => !empty($this->__namepath->value()) ? $this->__namepath->value() : $this->__namepath_sure(\core\functions\namepath($this->__name->value())),
                        'description'   => $this->__description->value(),
                        'city'          => $this->__city->value(),
                        'zip'          => $this->__zip->value(),
                        'street'          => $this->__street->value(),
                        'house'          => $this->__house->value(),
                        'flat'          => $this->__flat->value(),
                    );
                    $department->setData($data);
                    
                    if($department->create()){
                        $this->correct(Correct::get('dep_create'));
                       
                        return true;
                    }
                    else {
                        $this->error(Error::get('dep_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('dep_create'));
                }
                return false;*/
                return true;
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
                
                $department = $this->__department();
                $responsibility = $this->__responsibility();
                $working_time = $this->__working_time();
                $salary = $this->__salary();
                $from = $this->__from();
                $to = $this->__to();
                
                // Save button:
                $save = $this->__save();
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($department);
                $form->attach($responsibility);
                $form->attach($working_time);
                $form->attach($salary);
                $form->attach($from);
                $form->attach($to);
                $form->attach($save);
                $form->attach($cancel);
                
                // Executing form:
                if($save->submitted()){
                    if($form->perform()){
                        if($this->_save()){
                            // ...
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
                        'description'   => '',
                    ),
                    'to_date'       => array(
                        'title'         => 'Agreement valid until the date',
                        'input'         => $to,
                        'description'   => '',
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _cancel(){
                \core\functions\redirect(\core\functions\address().'/panel/add-agreement');
            }// end _cancel
            
        // } private {
            
            private function __department(){
                $f = new \core\classes\form\field\Select('department');
                $f->required(true);
                
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
                $this->__salary = $f;
                return $f;
            }
            
            private function __from(){
                $f = new \core\classes\form\field\Date('from_date');
                $f->required(true);
                $f->min('');
                $this->__from = $f;
                return $f;
            }
            
            private function __to(){
                $f = new \core\classes\form\field\Date('to_date');
                $f->required(false);
                $f->min('');
                $this->__to = $f;
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