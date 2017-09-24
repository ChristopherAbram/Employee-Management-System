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

class ChangeUserAddress extends \core\classes\command\Editor {
    // vars {
        
        // Form:
        protected $__form       = null;
        private $__country      = null;
        private $__city         = null;
        private $__zip          = null;
        private $__street       = null;
        private $__house        = null;
        private $__flat         = null;
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
            
            protected function _read(){
                // If user is not pointed:
                $user_id = $this->__get_user_id($this->__request);
                if(is_null($user_id)){
                    return false;
                }
                
                // Get user by its identifier or quit if there is problem:
                $User = $this->__get_user_by_id($user_id);
                if(is_null($User)){
                    return false;
                }
                try {
                    $address = $User->getAddressData();
                    if(!is_null($address) && $address->read()){
                        $data = $address->getData();
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
                return true;
            }// end _read
            
            protected function _update(){
                // If user is not pointed:
                $user_id = $this->__get_user_id($this->__request);
                if(is_null($user_id)){
                    return false;
                }
                
                // Get user by its identifier or quit if there is problem:
                $User = $this->__get_user_by_id($user_id);
                if(is_null($User)){
                    return false;
                }
                try {
                    $address = $User->getAddressData();
                    if(is_null($address)){
                        return false;
                    }
                    $address->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'country_id', 'city', 'zip', 'street', 'house', 'flat'
                    )));
                    
                    // Setting data:
                    $data = array(
                        'id'                => $address->getID(),
                        'country_id'        => $this->__country->value(),
                        'city'              => $this->__city->value(),
                        'zip'               => $this->__zip->value(),
                        'street'            => $this->__street->value(),
                        'house'             => $this->__house->value(),
                        'flat'              => $this->__flat->value(),
                    );
                    $address->setData($data);
                    // Address creation:
                    if($address->update()){
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
            
            protected function _create(){}
            
            protected function _execute(\core\classes\request\Request $request){
                $status = self::CMD_OK;
                
                $this->__request = $request;
                
                // If user is not pointed:
                $user_id = $this->__get_user_id($request);
                if(is_null($user_id)){
                    return self::CMD_ERROR;
                }
                
                // Get user by its identifier or quit if there is problem:
                $User = $this->__get_user_by_id($user_id);
                if(is_null($User)){
                    return self::CMD_ERROR;
                }
                
                // Turn mode to UPDATE:
                $this->_mode(self::UPDATE);
                
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
                
                // Composing form:
                $form->attach($country);
                $form->attach($city);
                $form->attach($zip);
                $form->attach($street);
                $form->attach($house);
                $form->attach($flat);
                $form->attach($submit);
                
                // Performing save operation:
                if($this->__submit->submitted()){
                    if($this->_save()){ }
                }
                
                // Read user data:
                if(!$this->_read()){
                    $this->error(Error::get('address_read'));
                }
                
                $this->assignAll(array(
                    'title'     => Text::get('addr_title'),
                    
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
                    
                    'toolbar_left'  => array($submit),
                ));
                
                return $status;
            }// end _execute
            
        // } private {
            
            private function __get_user_id(\core\classes\request\Request $request){
                $session = \core\classes\session\Session::getInstance();
               if(isset($session['member'])){
                    return (int)$session['member'];
                }
                return null;
            }// end __get_user_id
            
            private function __get_user_by_id($id){
                try {
                    $factory = new \core\classes\domain\factory\Plain();
                    $User = $factory->getById($id);
                    if(!is_null($User->getData()) && !$User->getData()->exists()){
                        return null;
                    }
                    return $User;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end __get_user_by_id
            
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
                $f->expression('/^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\-\']{3,100}$/i', Error::get('addr_city'));
                $this->__city = $f;
                return $f;
            }// end __city
            
            private function __zip(){
                $f = new \core\classes\form\field\Text('zip');
                $f->expression('/^[0-9]{2,2}\-[0-9]{3,3}$/i', Error::get('addr_zip'));
                $this->__zip = $f;
                return $f;
            }// end __zip
            
            private function __street(){
                $f = new \core\classes\form\field\Text('street');
                $f->expression('/^[0-9A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż\s\'\-]{3,100}$/i', Error::get('addr_street'));
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
                $f->value('Save');
                $this->__submit = $f;
                return $f;
            }// ens __submit
            
        // }
    // }
}