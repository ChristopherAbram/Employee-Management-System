<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\command\panel\administrator\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\command\panel\administrator;

class Text extends \Text {
    
    protected static $_message = array(
        // Page editor:
        'editor'                => 'Page editor',
        'page_title'            => 'Title',
        'page_title_desc'       => '',
        'page_namepath'         => 'Namepath',
        'page_namepath_desc'    => '',
        'page_desc'             => 'Short description',
        'page_desc_desc'        => '',
        'page_link'             => 'Link',
        'page_link_desc'        => '',


        // Page parent:
        'pageparent'            => 'Parent page',
        'parent_desc'           => 'Choose parent page, select one option',

        // Page body:
        'pagebody'              => 'Content',
        'body_desc'             => '',
        'page_body'             => 'Page content',
        'page_body_desc'        => '',

        // Page options:
        'pageoptions'           => 'Options',
        'page_options_desc'     => '',
        'page_keywords'         => 'Keywords',
        'page_keywords_desc'    => '',
        'page_ord'              => 'List order',
        'page_ord_desc'         => '',
        'page_hide'              => 'Hide',
        'page_hide_desc'         => '',
        'page_mark'              => 'Mark',
        'page_mark_desc'         => '',

        // Registration:
        'reg_data'              => 'Basic data',
        'reg_addr'              => 'Address',
        'reg_extra'             => 'Extra data',
        'reg_title'             => 'Registration',
        'reg_desc'              => '',
        'reg_firstname'         => 'Firstname',
        'reg_firstname_desc'    => '',
        'reg_lastname'          => 'Lastname',
        'reg_lastname_desc'     => '',
        'reg_email'             => 'Email',
        'reg_email_desc'        => '',
        'reg_pass'              => 'Password',
        'reg_pass_desc'         => '',
        'reg_con_pass'          => 'Confirm password',
        'reg_con_pass_desc'     => '',
        'reg_sex'               => 'Sex',
        'reg_male'              => 'Male',
        'reg_female'            => 'Female',
        'reg_sex_desc'          => '',
        'reg_bdate'             => 'Birth date',
        'reg_bdate_desc'        => '',
        'reg_captcha'           => 'Captcha',
        'reg_captcha_desc'      => 'Prove you are not a robot',

        // Address:
        'addr_title'            => 'Your address',
        'addr_country'          => 'Country',
        'addr_country_desc'     => '',
        'addr_city'             => 'City',
        'addr_city_desc'        => '',
        'addr_zip'              => 'Zip Code',
        'addr_zip_desc'         => '',
        'addr_street'           => 'Street',
        'addr_street_desc'      => '',
        'addr_house'            => 'House',
        'addr_house_desc'       => '',
        'addr_flat'             => 'Flat',
        'addr_flat_desc'        => '',
        'addr_country_load'     => 'Error while loading countries list',

        // Extra:
        'extra_title'           => 'Your profile',
        'extra_phone'           => 'Phone',
        'extra_phone_desc'      => '',
        'extra_desc'            => 'Describe yourself',
        'extra_desc_desc'       => '',
        'extra_cit'             => 'Your motto',
        'extra_cit_desc'        => '',
    );
    
    private function __construct(){}
}

class Correct extends \Correct {
    
    protected static $_message = array(
        'update'                => 'Changes accepted',
        // Page editor:
        'page_create'           => 'Successfully created new page',
        
        'dep_create'            => 'Successfully created new department',
        'res_create'            => 'Successfully created new responsibility',
        'agr_create'            => 'Successfully created new agreement',
    );
    
    private function __construct(){}
}

class Error extends \Error {
    
    protected static $_message = array(
        'form_incomplete'       => 'Form requires to be properly fulfilled',
        'update'                => 'Changes can not be accepted, try again later',
        'invalid'               => 'Invalid, content too long, too short or used a forbidden character',

        // Page editor:
        'page_read'             => 'Unable to read page data',
        'page_create'           => 'An error occurred while creating new page',
        'page_update'           => 'An error occurred while updating page data',
        'invalid_link'          => 'This is probably not valid link',
        'namepath_exists'       => 'This namepath already exist',
        
        'department_not_exists' => 'Unable to open department. Department probably does not exist or you can not modify it.',
        'dep_read'              => 'Unable to read department data',
        'dep_create'            => 'An error occurred while creating new department',
        'dep_update'            => 'An error occurred while updating department data',
        
        'res_create'            => 'An error occurred while creating new department',

        // Page options:
        'invalid_ord'           => 'This is not a number',

        // Member:
        'user_read'             => 'Unable to read user data',  
        
        'addr_city'         => 'Invalid city name',
        'addr_zip'          => 'Invalid zip code',
        'addr_street'       => 'Invalid street',
        'addr_house'        => 'Invalid house number',
        'addr_flat'         => 'Invalid flat number',
        
        'departments_load'  => 'Unable to load departments',
        'responsibility_load'  => 'Unable to load responsibilities',
        'working_time_load'  => 'Unable to load working times',
        
        'desc'              => 'Used inappropriate letters',
        
        'agr_read'              => 'Unable to read agreement data',
        'agr_create'            => 'An error occurred while creating new agreement',
        'agr_update'            => 'An error occurred while updating agreement data',
        
        'since_date'            => 'Invalid since date - can not be in the past',
        'to_date'               => 'Invalid until date - can\'t be lower then since date',
    );
    
    private function __construct(){}
}