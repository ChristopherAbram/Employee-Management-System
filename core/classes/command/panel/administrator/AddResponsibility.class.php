<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\administrator;

class AddResponsibility extends Command {
    // vars {
        
        // Form fields:
        private $__form         = null;
        // Buttons:
        
        private $__name       = null;
        private $__desc      = null;
        private $__add       = null;
    
    // } methods {
    
        // public {
            
            public function add(){
                try {
                    $responsibility = new \core\classes\data\Responsibility();
                    
                    // Setting data:
                    $data = array(
                        'name'         => \htmlentities($this->__name->value()),
                        'description'   => \htmlentities($this->__desc->value())
                    );
                    $responsibility->setData($data);
                    
                    if($responsibility->create()){
                        $this->correct(Correct::get('res_create'));
                        return true;
                    }
                    else {
                        $this->error(Error::get('res_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('res_create'));
                }
                return false;
            }
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_DEFAULT || $status == self::CMD_OK){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(200)
                    );
                }
                else if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
            }// end _headers
            
            protected function _styles($status){
                return array();
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // Form:
                $form = new \core\classes\form\Form('add_responsibility');
                $this->__form = $form;
                
                $name = $this->__name();
                $desc = $this->__desc();
                
                // Buttons:
                $add = $this->__add();
                
                // Compose form:
                $form->attach($name);
                $form->attach($desc);
                $form->attach($add);
                
                // Button functions:
                $add->onsubmit(array($this, 'add'));
                
                $this->assignAll(array(
                    'name'       => array(
                        'title'         => 'Name of responsibility',
                        'input'         => $name,
                        'description'   => '',
                    ),
                    'desc'       => array(
                        'title'         => 'Description',
                        'input'         => $desc,
                        'description'   => '',
                    ),
                    'add'       => array(
                        'title'         => 'Add',
                        'input'         => $add,
                        'description'   => '',
                    ),
                ));
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            private function __name(){
                $f = new \core\classes\form\field\Text('name');
                $f->id('responsibility_name');
                $f->expression('/^'.REGEX_TITLE.'{3,512}$/i', Error::get('invalid'));
                $f->required(true);
                $this->__name = $f;
                return $f;
            }
            
            private function __desc(){
                $f = new \core\classes\form\field\Text('desc');
                $f->id('responsibility_desc');
                $f->required(true);
                $this->__desc = $f;
                return $f;
            }
            
            private function __add(){
                $f = new \core\classes\form\field\Submit('add');
                $f->value('Add');
                $this->__add = $f;
                return $f;
            }
            
        // }
    // }
}