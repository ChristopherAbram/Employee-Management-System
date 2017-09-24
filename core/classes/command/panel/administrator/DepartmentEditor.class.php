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

class DepartmentEditor extends \core\classes\command\MultiStepEditor {
    // vars {
        
        protected $_key             = '__departmenteditor';
        
        protected static $_step     = 1;
        protected static $_cmd      = 'departmenteditor';
        
        protected $_next            = 'ArticleCategory';
        protected $_prev            = null;
        protected $_begin           = 'DepartmentEditor';
        protected $_end             = 'DepartmentEditor';
    
        private $__form             = null;
        private $__name            = null;
        private $__namepath         = null;
        private $__description      = null;
        private $__city             = null;
        private $__zip             = null;
        private $__street             = null;
        private $__house             = null;
        private $__flat             = null;
        
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
                $id = null;
                $data = $this->_data();
                if(isset($data['id'])){
                    $id = (int)$data['id'];
                }
                return $id;
            }// end _retrieveId
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = $this->_retrieveId();
                    try {
                        $factory = new \core\classes\data\factory\Department();
                        if(!is_null($id)){
                            $department = $factory->getById($id);
                            if(!is_null($department)){
                                $department->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name', 'description', 'city', 'zip', 'street', 'house', 'flat'
                                )));
                                if($department->read()){
                                    $data = $department->getData();
                                    $this->__name->value(isset($data['name']) ? $data['name'] : '');
                                    $this->__description->value(isset($data['description']) ? $data['description'] : '');
                                    $this->__city->value(isset($data['city']) ? $data['city'] : '');
                                    $this->__zip->value(isset($data['zip']) ? $data['zip'] : '');
                                    $this->__street->value(isset($data['street']) ? $data['street'] : '');
                                    $this->__house->value(isset($data['house']) ? $data['house'] : '');
                                    $this->__flat->value(isset($data['flat']) ? $data['flat'] : '');
                                    return true;
                                }
                            }
                        }
                        return false;
                    } catch (\core\classes\data\DataException $ex) {
                        $this->error(Error::get('dep_read'));
                    }
                }
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
                try {
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
                        /*$this->_open(array(
                            'id'    => $department->getID()
                        ));*/
                        return true;
                    }
                    else {
                        $this->error(Error::get('dep_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('dep_create'));
                }
                return false;
            }// end _create
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Open article:
                if(isset($request['namepath']) && !empty($request['namepath'])){
                    $Department = $this->_get_department_by_namepath($request['namepath']);
                    if(!is_null($Department)){
                        $this->_open(array(
                            'id'    => $Department->getID()
                        ));
                        $this->_step($this->_end()[self::STEP]);
                        $this->_mode(self::UPDATE);
                        \core\functions\redirect(\core\functions\address().'/panel/'.$this->_begin()[self::CMD]);
                    }
                    else {
                        $this->error(Error::get('department_not_exists'));
                    }
                }
                
                // User instance:
                $this->__user = \PanelRegistry::getCurrentUser();
                // Form:
                $form = new \core\classes\form\Form('departmenteditor');
                $this->__form = $form;
                // Title field:
                $name = $this->__name();
                // Namepath field:
                $namepath = $this->__namepath();
                // Description field:
                $description = $this->__description();
                
                $city = $this->__city();
                $zip = $this->__zip();
                $street = $this->__street();
                $house = $this->__house();
                $flat = $this->__flat();
                
                // Save button:
                $save = $this->__save();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($name);
                $form->attach($namepath);
                $form->attach($description);
                $form->attach($city);
                $form->attach($zip);
                $form->attach($street);
                $form->attach($house);
                $form->attach($flat);
                $form->attach($save);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('dep_read'));
                }
                
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
                    'name'       => array(
                        'title'         => 'Name of department',
                        'input'         => $name,
                        'description'   => '',
                    ),
                    'desc'       => array(
                        'title'         => 'Description',
                        'input'         => $description,
                        'description'   => '',
                    ),
                    'city'       => array(
                        'title'         => 'City',
                        'input'         => $city,
                        'description'   => '',
                    ),
                    'zip'       => array(
                        'title'         => 'Zip-Code',
                        'input'         => $zip,
                        'description'   => '',
                    ),
                    'street'       => array(
                        'title'         => 'Street',
                        'input'         => $street,
                        'description'   => '',
                    ),
                    'house'       => array(
                        'title'         => 'Number',
                        'input'         => $house,
                        'description'   => '',
                    ),
                    'flat'       => array(
                        'title'         => 'Flat',
                        'input'         => $flat,
                        'description'   => '',
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _get_department_by_namepath($namepath){
                try {
                    $factory = new \core\classes\domain\factory\Department();
                    return $factory->getByNamepath($namepath);
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end _get_article_by_namepath
            
            protected function _cancel(){
                if($this->_opened()){
                    $this->_close();
                }
                \core\functions\redirect(\core\functions\address().'/panel/departments');
            }// end _cancel
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            private function __namepath_sure($namepath){
                $id = $this->_retrieveId();
                $i = 0;
                do {
                    ++$i;
                    $art_id = \core\classes\data\factory\Department::namepathExists($namepath);
                    if(!is_null($art_id) && !is_null($id)){
                        if($art_id == $id){
                            return $namepath;
                        } else {
                            $namepath .= ''.$i;
                        }
                    }
                    else {
                        return $namepath;
                    }
                } while($i <= 1000);
                return $namepath;
            }// end __namepath_sure
            
            private function __name(){
                $f = new \core\classes\form\field\Text('name');
                $f->id('department_title');
                $f->expression('/^'.REGEX_TITLE.'{3,512}$/i', Error::get('invalid'));
                $f->required(true);
                $this->__name = $f;
                return $f;
            }// end __title
            
            private function __namepath(){
                $id = $this->_retrieveId();
                $f = new \core\classes\form\field\Text('namepath_input');
                $f->id('department_namepath');
                $f->expression('/^'.REGEX_NAMEPATH.'{1,128}$/i', Error::get('invalid'));
                $f->callback(function($field) use($id){
                    $art_id = null;//\core\classes\data\factory\Department::namepathExists($field->value());
                    if(!is_null($art_id)){
                        return ($art_id == $id);
                    }
                    return true;
                }, Error::get('namepath_exists'));
                $this->__namepath = $f;
                return $f;
            }// end __namepath
            
            private function __description(){
                $f = new \core\classes\form\field\Textarea('description');
                $f->id('editor');
                $this->__description = $f;
                return $f;
            }// end __description
            
            private function __city(){
                $f = new \core\classes\form\field\Text('city');
                $f->required(true);
                $f->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]{3,100}$/i', Error::get('addr_city'));
                $this->__city = $f;
                return $f;
            }// end __city
            
            private function __zip(){
                $f = new \core\classes\form\field\Text('zip');
                $f->expression('/^[0-9]{2,2}-[0-9]{3,3}$/i', Error::get('addr_zip'));
                $this->__zip = $f;
                return $f;
            }// end __zip
            
            private function __street(){
                $f = new \core\classes\form\field\Text('street');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]{3,100}$/i', Error::get('addr_street'));
                $this->__street = $f;
                return $f;
            }// end street
            
            private function __house(){
                $f = new \core\classes\form\field\Text('house');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]{1,15}$/i', Error::get('addr_house'));
                $this->__house = $f;
                return $f;
            }// end __house
            
            private function __flat(){
                $f = new \core\classes\form\field\Text('flat');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s]{1,15}$/i', Error::get('addr_flat'));
                $this->__flat = $f;
                return $f;
            }// end __flat
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Exit');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}