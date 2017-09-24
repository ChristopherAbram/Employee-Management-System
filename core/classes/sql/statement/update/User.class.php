<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.08.2016
 */

namespace core\classes\sql\statement\update;

class User extends Statement {
    // vars {
        
        // Update query:
        protected $_query = 'UPDATE user SET $attributeList WHERE id = :identifier';
        
        // Used set parameters:
        protected $_setParameters = array(
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
        
        // Other parameters:
        protected $_requiredParams = array(
            'identifier'    => 'id'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}