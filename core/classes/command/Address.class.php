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

class Address extends Registration {
    // vars {
        
        // MultiStep options:
        protected $_next        = 'Extra';
        protected $_prev        = 'Registration';
        protected static $_step = 2;
        protected static $_cmd  = 'address';
        
        // Form:
        protected $__form       = null;
        private $__country      = null;
        private $__city         = null;
        private $__zip          = null;
        private $__street       = null;
        private $__house        = null;
        private $__flat         = null;
        protected $__submit     = null;
        
        private $__address      = null;
        protected $__user_id    = null;
        
        // Table attributes:
        private $__attributes   = array(
            'country_id', 'user_id', 'city', 'zip', 'street', 'house', 'flat'
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
            
            protected function _read(){
                $factory = new \core\classes\data\factory\Address();
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $d = $this->_data();
                    $id = null;
                    if(isset($d['address_id'])){
                        $id = (int)$d['address_id'];
                    }
                    else {
                        return false;
                    }
                    try {
                        $this->__address = $factory->getById($id);
                        $this->__address->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                        if($this->__address->read()){
                            $data = $this->__address->getData();
                            $this->__country->value($data['country_id']);
                            $this->__city->value($data['city']);
                            $this->__zip->value($data['zip']);
                            $this->__street->value($data['street']);
                            $this->__house->value($data['house']);
                            $this->__flat->value($data['flat']);
                            return true;
                        }
                    } catch(\core\classes\data\DataException $ex){
                        $this->error(Error::get('address_read'));
                    }
                    return false;
                }
                return true;
            }// end _read
            
            protected function _create(){
                // If form completed properly:
                try {
                    $this->__address = new \core\classes\data\Address();
                    $this->__address->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                    // Setting data:
                    $data = array(
                        'country_id'        => $this->__country->value(), 
                        'city'              => $this->__city->value(), 
                        'zip'               => $this->__zip->value(), 
                        'street'            => $this->__street->value(), 
                        'user_id'           => $this->__user_id,
                        'house'             => $this->__house->value(), 
                        'flat'              => $this->__flat->value(),
                    );
                    $this->__address->setData($data);
                    // Address creation:
                    if($this->__address->create()){
                        $this->correct(Correct::get('address_creation'));
                        $d = $this->_data();
                        if(!is_null($d)){
                            $d['address_id'] = $this->__address->getID();
                            $this->_data($d);
                        }
                        return true;
                    }
                    else {
                        $this->error(Error::get('address_creation'));
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('address_create'));
                }
                return false;
            }// end _create
            
            protected function _update(){
                $d = $this->_data();
                $id = null;
                if(isset($d['address_id'])){
                    $id = (int)$d['address_id'];
                }
                else {
                    return false;
                }
                try {
                    $factory = new \core\classes\data\factory\Address();
                    $this->__address = $factory->getById($id);
                    $this->__address->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'country_id', 'city', 'zip', 'street', 'house', 'flat'
                    )));

                    // Setting data:
                    $data = array(
                        'id'                => $this->__address->getID(),
                        'country_id'        => $this->__country->value(), 
                        'city'              => $this->__city->value(), 
                        'zip'               => $this->__zip->value(), 
                        'street'            => $this->__street->value(),
                        'house'             => $this->__house->value(), 
                        'flat'              => $this->__flat->value(),
                    );
                    $this->__address->setData($data);
                    // Address creation:
                    if($this->__address->update()){
                        $d = $this->_data();
                        if(!is_null($d)){
                            $d['address_id'] = $this->__address->getID();
                            $this->_data($d);
                        }
                        $this->correct(Correct::get('update'));
                        return true;
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error(Error::get('address_update'));
                }
                return false;
            }// end _update
            
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_ERROR;
                
                // Form:
                $this->__form = new \core\classes\form\Form('address');
                $form = $this->__form;
                // Country field:
                $country = $this->__country();
                // City field:
                $city = $this->__city();
                // Zip field:
                $zip = $this->__zip();
                // Street field:
                $street = $this->__street();
                // House field:
                $house = $this->__house();
                // Flat field:
                $flat = $this->__flat();
                // Submit button:
                $submit = $this->__submit();
                // Cancel:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($country);
                $form->attach($city);
                $form->attach($zip);
                $form->attach($street);
                $form->attach($house);
                $form->attach($flat);
                $form->attach($submit);
                //$form->attach($cancel);
                
                if($this->_opened()){
                    if(isset($this->_data()['id'])){
                        $this->__user_id = $this->_data()['id'];
                    }
                    $d = $this->_data();
                    if(!is_null($d) && isset($d['address_id'])){
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
                    $this->error(Error::get('address_read'));
                }
                // Performing the form and saving changes:
                if($form->perform()){
                    if($this->_save()){
                        $status = self::NEXT;
                    }
                }
                else if($form->submitted()){
                    $this->error(Error::get('form_incomplete'));
                }
                
                /*echo '<pre>';
                print_r($this->_activeAncestors());
                echo '</pre>';
                die();*/
                
                $this->assignAll(array(
                    'title'     => Text::get('addr_title'),
                    
                    'ancestors' => $this->_activeAncestors(),
                    
                    // form:
                    'country'     => array(
                        'title'         => Text::get('addr_country'),
                        'input'         => $country,
                        'description'   => Text::get('addr_country_desc'),
                    ),
                    
                    'city'     => array(
                        'title'         => Text::get('addr_city'),
                        'input'         => $city,
                        'description'   => Text::get('addr_city_desc'),
                    ),
                    
                    'zip'     => array(
                        'title'         => Text::get('addr_zip'),
                        'input'         => $zip,
                        'description'   => Text::get('addr_zip_desc'),
                    ),
                    
                    'street'     => array(
                        'title'         => Text::get('addr_street'),
                        'input'         => $street,
                        'description'   => Text::get('addr_street_desc'),
                    ),
                    
                    'house'     => array(
                        'title'         => Text::get('addr_house'),
                        'input'         => $house,
                        'description'   => Text::get('addr_house_desc'),
                    ),
                    
                    'flat'     => array(
                        'title'         => Text::get('addr_flat'),
                        'input'         => $flat,
                        'description'   => Text::get('addr_flat_desc'),
                    ),
                    
                    'submit'    => $submit,
                    'cancel'    => $cancel,
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
            
            private function __submit(){
                $f = new \core\classes\form\field\Submit('con');
                $f->value('Save and next');
                $this->__submit = $f;
                return $f;
            }// ens __submit
            
        // }
    // }
}