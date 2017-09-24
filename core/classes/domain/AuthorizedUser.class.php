<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\domain;

abstract class AuthorizedUser extends User {
    // vars {
    
        // Data address object:
        protected $_address      = null;
        
        // Data country object:
        protected $_country      = null;
        
        // Data user role object:
        protected $_userRole     = null;
        
        // Avatar File reference:
        protected $_Avatar       = null;
        
        // Presentation data:
        protected $_presentation = array(
            'id'                => '', 
            'email'             => '',
            'password'          => '', 
            'firstname'         => '', 
            'lastname'          => '',
            'phone'             => '', 
            'user_role_id'      => 3, 
            'firstaccess'       => '', 
            'lastaccess'        => '', 
            'lastlogin'         => '',
            'avatar'            => '', 
            'sex'               => 'M', 
            'cdate'             => '', 
            'bdate'             => '', 
            'description'       => '', 
            'citation'          => '',
            'isactive'          => 1, 
            'bin'               => 0, 
            'token'             => '',
            'profile'           => 0,
            'role'              => array(
                'id'                => '',
                'access_level'      => 2,
                'name'              => 'Plain'
            ),
            'address'           => array(
                'id'                => '', 
                'country_id'        => '', 
                'user_id'           => '', 
                'city'              => '', 
                'zip'               => '', 
                'street'            => '', 
                'house'             => '', 
                'flat'              => '',
            ),
            'country'           => array(
                'id'                => '',
                'name'              => '',
                'short'             => '',
            ),
            'avatar'            => array(
                
            ),
        );
    
    // } methods {
    
        // public {
            
            public function __construct($id = null, \core\classes\data\User $data = null){
                if(!is_null($data)){
                    $this->_data = $data;
                    parent::__construct($this->_data->getID());
                } 
                else {
                    parent::__construct($id);
                    try {
                        $user_factory = new \core\classes\data\factory\User();
                        $this->_data = $user_factory->getById($this->_id);
                        if(!is_null($this->_data)){
                            $this->_data->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'avatar')));
                            $this->_data->read();
                        }
                    } catch(\core\classes\data\DataException $ex){
                        throw new \DomainException($ex->getMessage(), 0, $ex);
                    }
                }
                try {
                    $address_factory = new \core\classes\data\factory\Address();
                    $this->_address = $address_factory->getByUserId($this->_id);
                    $country_factory = new \core\classes\data\factory\Country();
                    $this->_country = $country_factory->getByUserId($this->_id);
                    $userrole_factory = new \core\classes\data\factory\UserRole();
                    $this->_userRole = $userrole_factory->getByUserId($this->_id);
                    
                    /*if(!is_null($this->_data)){
                        $d = $this->_data->getData();
                        if(isset($d['avatar'])){
                            $file_factory = new \core\classes\domain\factory\File();
                            $avatar = (int)$d['avatar'];
                            $this->_Avatar = $file_factory->getById($avatar);
                        }
                    }*/
                } catch(\core\classes\data\DataException $ex){
                    throw new \DomainException($ex->getMessage(), 0, $ex);
                }
            }// end __construct
            
            public static function identified(){
                $user = \ApplicationRegistry::getCurrentUser();
                if($user instanceof AuthorizedUser){
                    return true;
                }
                return false;
            }// end identified
            
            public static function identification(AuthorizedUser $user, $remember = false){
                $session = \core\classes\session\Session::getInstance();
                $session['user'] = array('id' => $user->getID());
                try{
                    $user->loadBasic();
                } catch (Exception $ex) {}
                $data = $user->getData();
                if(is_null($data)){
                    return;
                }
                $d = $data->getData();
                if($remember && isset($d['token'])){
                    $cookie = \core\classes\cookie\Cookie::getInstance();
                    $cookie->setcookie('user_token', $d['token'], \time() + 7 * 24 * 60 * 60, '/');
                }
            }// end identification
            
            public function getAddressData(){
                return $this->_address;
            }// end getAddress
            
            public function loadAddress(){
                try {
                    if($this->_address){
                        return $this->_address->read();
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
                return false;
            }// end loadAddress
            
            public function getCountryData(){
                return $this->_country;
            }// end getCountry
            
            public function loadCountry(){
                try {
                    if($this->_country){
                        return $this->_country->read();
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
                return false;
            }// end loadCountry
            
            public function loadAvatar(){
                $this->getAvatar();
                if(!is_null($this->_Avatar)){
                    return $this->_Avatar->load(new \core\classes\sql\attribute\AttributeList(array('id', 'extension', 'name')));
                }
                return false;
            }// end loadAvatar
            
            public function getUserRoleData(){
                return $this->_userRole;
            }// end getUserRole
            
            public function loadUserRole(){
                try {
                    if($this->_userRole){
                        return $this->_userRole->read();
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new DomainException($ex->getMessage(), 0, $ex);
                }
                return false;
            }// end loadUserRole
            
            public function loadBasic(){
                return $this->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'user_role_id', 'avatar', 'token', 'profile', 'isactive')));
            }// end loadBasic
            
            public function loadAll(){
                $this->load($this->_data->getDefaultAttributeList());
                $this->loadAddress();
                $this->loadCountry();
                $this->loadUserRole();
                $Avatar = $this->getAvatar();
                if(!is_null($Avatar)){
                    $Avatar->load(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'name', 'extension'
                    )));
                }
            }// end loadAll
            
            public function getAvatar(){
                if(is_null($this->_Avatar) && !is_null($this->_data)){
                    $d = $this->_data->getData();
                    if(isset($d['avatar'])){
                        $file_factory = new \core\classes\domain\factory\File();
                        $avatar = (int)$d['avatar'];
                        $this->_Avatar = $file_factory->getById($avatar);
                    }
                }
                return $this->_Avatar;
            }// end getAvatar
            
            public function &getPresentationData(){
                $data = &$this->_data->getDataReference();
                if(\array_key_exists('id', $data)) $this->_presentation['id'] = &$data['id'];
                if(\array_key_exists('password', $data)) $this->_presentation['password'] = &$data['password'];
                if(\array_key_exists('firstname', $data)) $this->_presentation['firstname'] = &$data['firstname'];
                if(\array_key_exists('lastname', $data)) $this->_presentation['lastname'] = &$data['lastname'];
                if(\array_key_exists('email', $data)) $this->_presentation['email'] = &$data['email'];
                if(\array_key_exists('phone', $data)) $this->_presentation['phone'] = &$data['phone'];
                if(\array_key_exists('user_role_id', $data)) $this->_presentation['user_role_id'] = &$data['user_role_id'];
                if(\array_key_exists('firstaccess', $data)) $this->_presentation['firstaccess'] = &$data['firstaccess'];
                if(\array_key_exists('lastaccess', $data)) $this->_presentation['lastaccess'] = &$data['lastaccess'];
                if(\array_key_exists('lastlogin', $data)) $this->_presentation['lastlogin'] = &$data['lastlogin'];
                if(\array_key_exists('avatar', $data)) $this->_presentation['avatar'] = &$data['avatar'];
                if(\array_key_exists('sex', $data)) $this->_presentation['sex'] = &$data['sex'];
                if(\array_key_exists('cdate', $data)) $this->_presentation['cdate'] = &$data['cdate'];
                if(\array_key_exists('edate', $data)) $this->_presentation['edate'] = &$data['edate'];
                if(\array_key_exists('bdate', $data)) $this->_presentation['bdate'] = &$data['bdate'];
                if(\array_key_exists('description', $data)) $this->_presentation['description'] = &$data['description'];
                if(\array_key_exists('citation', $data)) $this->_presentation['citation'] = &$data['citation'];
                if(\array_key_exists('isactive', $data)) $this->_presentation['isactive'] = &$data['isactive'];
                if(\array_key_exists('bin', $data)) $this->_presentation['bin'] = &$data['bin'];
                if(\array_key_exists('token', $data)) $this->_presentation['token'] = &$data['token'];
                if(\array_key_exists('profile', $data)) $this->_presentation['profile'] = &$data['profile'];
                // User role data:
                if(!is_null($this->_userRole)){
                    $role = $this->_userRole;
                    $role_data = &$role->getDataReference();
                    if(\array_key_exists('id', $role_data)) $this->_presentation['role']['id'] = &$role_data['id'];
                    if(\array_key_exists('access_level', $role_data)) $this->_presentation['role']['access_level'] = &$role_data['access_level'];
                    if(\array_key_exists('name', $role_data)) $this->_presentation['role']['name'] = &$role_data['name'];
                }
                // Address:
                if(!is_null($this->_address)){
                    $address = &$this->_address->getDataReference();
                    if(\array_key_exists('id', $address)) $this->_presentation['address']['id'] = &$address['id'];
                    if(\array_key_exists('country_id', $address)) $this->_presentation['address']['country_id'] = &$address['country_id'];
                    if(\array_key_exists('user_id', $address)) $this->_presentation['address']['user_id'] = &$address['user_id'];
                    if(\array_key_exists('city', $address)) $this->_presentation['address']['city'] = &$address['city'];
                    if(\array_key_exists('zip', $address)) $this->_presentation['address']['zip'] = &$address['zip'];
                    if(\array_key_exists('street', $address)) $this->_presentation['address']['street'] = &$address['street'];
                    if(\array_key_exists('house', $address)) $this->_presentation['address']['house'] = &$address['house'];
                    if(\array_key_exists('flat', $address)) $this->_presentation['address']['flat'] = &$address['flat'];
                }
                // Country:
                if(!is_null($this->_country)){
                    $country = &$this->_country->getDataReference();
                    if(\array_key_exists('id', $country)) $this->_presentation['country']['id'] = &$country['id'];
                    if(\array_key_exists('name', $country)) $this->_presentation['country']['name'] = &$country['name'];
                    if(\array_key_exists('short', $country)) $this->_presentation['country']['short'] = &$country['short'];
                }
                // Avatar:
                if(!is_null($this->_Avatar)){
                    $this->_presentation['avatar'] = &$this->_Avatar->getPresentationData(false);
                }
                return $this->_presentation;
            }// end getPresentationData
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}