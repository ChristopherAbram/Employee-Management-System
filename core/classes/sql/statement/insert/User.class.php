<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\insert
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.08.2016
 */

namespace core\classes\sql\statement\insert;

class User extends Statement {
    // vars {
        
        // Insert query:
        protected $_query = 'INSERT INTO user($attributeList) VALUES($parameterList)';
        
        // Used parameters:
        protected $_requiredParams = array(
            'password'          => 'password',
            'firstname'         => 'firstname',
            'lastname'          => 'lastname',
            'email'             => 'email',
            'phone'             => 'phone',
            'urid'              => 'user_role_id',
            'firstaccess'       => 'firstaccess',
            'lastaccess'        => 'lastaccess',
            'lastlogin'         => 'lastlogin',
            'avatar'            => 'avatar',
            'sex'               => 'sex',
            'cdate'             => 'cdate',
            'bdate'             => 'bdate',
            'description'       => 'description',
            'citation'          => 'citation',
            'isactive'          => 'isactive',
            'bin'               => 'bin',
            'token'             => 'token',
            'profile'           => 'profile'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}