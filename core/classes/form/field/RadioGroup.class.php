<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form\field;

class RadioGroup extends Field {
    // vars {
        
        protected $_radios      = array();
    
    // } methods {
    
        // public {
        
            public function attach(\core\classes\form\field\Radio $radio){
                $radio->name($this->name());
                $radio->form($this->form());
                $radio->disabled($this->disabled());
                $radio->readonly($this->readonly());
                $radio->fill($this->fill());
                $this->_radios[] = $radio;
                return;
            }// end attach
            
            public function name($name = null){
                foreach($this->_radios as $radio){
                    $radio->name($name);
                }
                return parent::name($name);
            }// end name
            
            public function form($form = null){
                foreach($this->_radios as $radio){
                    $radio->form($form);
                }
                return parent::form($form);
            }// end form
            
            public function disabled($disabled = null){
                foreach($this->_radios as $radio){
                    $radio->disabled($disabled);
                }
                return parent::disabled($disabled);
            }// end disabled
            
            public function readonly($readonly = null){
                foreach($this->_radios as $radio){
                    $radio->readonly($readonly);
                }
                return parent::readonly($readonly);
            }// end readonly
            
            public function fill($fill = null){
                foreach($this->_radios as $radio){
                    $radio->fill($fill);
                }
                return parent::fill($fill);
            }// end fill
            
        // } protected {
        
            protected function _toString(){
                $text = '';
                foreach($this->_radios as $radio){
                    $text .= ''.$radio;
                }
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}