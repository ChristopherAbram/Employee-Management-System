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

namespace core\classes\command\panel\administrator;

class Address extends \core\classes\command\Address {
    // vars {
        
        // MultiStep options:
        protected $_key         = '__adminregistration';
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = parent::_execute($request);
                
                $this->assignAll(array(
                    // Toolbar:
                    'toolbar_left'      => array($this->__submit),
                    'toolbar_right'     => array($this->_cancel),
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __country(){
                $f = new \core\classes\form\field\Select('country');
                $f->required(true);
                // Getting countries:
                try {
                    $factory = new \core\classes\data\factory\Country();
                    $set = $factory->getAll();
                    // Setting options:
                    foreach($set as $country){
                        if(!$country->read()){
                            $this->error(Error::get('addr_country_load'));
                            break;
                        }
                        $data = $country->getData();
                        if(isset($data['name'])){
                            $option = new \core\classes\form\field\Option($data['name'], $country->getID());
                            $f->add($option);
                        }
                        else {
                            $this->error(Error::get('addr_country_load'));
                            break;
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('addr_country_load'));
                }
                $this->__country = $f;
                return $f;
            }// end __country
            
            private function __city(){
                $f = new \core\classes\form\field\Text('city');
                $f->required(true);
                $f->expression('/[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{3,100}/i', Error::get('addr_city'));
                $this->__city = $f;
                return $f;
            }// end __city
            
            private function __zip(){
                $f = new \core\classes\form\field\Text('zip');
                $f->expression('/[0-9]{2,2}-[0-9]{3,3}/i', Error::get('addr_zip'));
                $this->__zip = $f;
                return $f;
            }// end __zip
            
            private function __street(){
                $f = new \core\classes\form\field\Text('street');
                $f->expression('/[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{3,100}/i', Error::get('addr_street'));
                $this->__street = $f;
                return $f;
            }// end street
            
            private function __house(){
                $f = new \core\classes\form\field\Text('house');
                $f->expression('/[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{1,15}/i', Error::get('addr_house'));
                $this->__house = $f;
                return $f;
            }// end __house
            
            private function __flat(){
                $f = new \core\classes\form\field\Text('flat');
                $f->expression('/[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż]{1,15}/i', Error::get('addr_flat'));
                $this->__flat = $f;
                return $f;
            }// end __flat
            
            private function __submit(){
                $f = new \core\classes\form\field\Submit('con');
                $f->value('Save');
                $this->__submit = $f;
                return $f;
            }// ens __submit
            
        // }
    // }
}