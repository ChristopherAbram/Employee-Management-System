<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\command\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	14.09.2016
 */

namespace core\classes\command\panel\plain;

class Text extends \Text {
    
    protected static $_message = array(
        // Registration:
        'reg_data'              => 'Basic data',
        'reg_addr'              => 'Address',
        'reg_extra'             => 'Extra data',
        'reg_title'             => 'Registration',
        'reg_desc'              => '',
        'reg_firstname'         => 'Firstname',
        'reg_firstname_desc'    => 'Enter your name, at least 3 characters',
        'reg_lastname'          => 'Lastname',
        'reg_lastname_desc'     => 'Enter your lastname, at least 3 characters',
        'reg_email'             => 'Email',
        'reg_email_desc'        => 'Enter your e-mail',
        'reg_pass'              => 'New password',
        'reg_pass_desc'         => 'Only basic characters available: A-Z, a-z, 0-9',
        'reg_con_pass'          => 'Confirm password',
        'reg_con_pass_desc'     => '',
        'reg_old_pass'          => 'Old password',
        'reg_old_pass_desc'     => 'Enter your current password',
        'reg_sex'               => 'Sex',
        'reg_male'              => 'Male',
        'reg_female'            => 'Female',
        'reg_sex_desc'          => 'Choose one option',
        'reg_bdate'             => 'Birth date',
        'reg_bdate_desc'        => 'Enter your birth date: YYYY-MM-DD',
        'reg_captcha'           => 'Captcha',
        'reg_captcha_desc'      => 'Prove you are not a robot',

        // Address:
        'addr_title'            => 'Your address',
        'addr_country'          => 'Country',
        'addr_country_desc'     => 'Choose one option',
        'addr_city'             => 'City',
        'addr_city_desc'        => 'Enter your city',
        'addr_zip'              => 'Zip Code',
        'addr_zip_desc'         => 'Your zip code in form: xx-xxx',
        'addr_street'           => 'Street',
        'addr_street_desc'      => 'Enter street name',
        'addr_house'            => 'House',
        'addr_house_desc'       => 'Enter house name/number',
        'addr_flat'             => 'Flat',
        'addr_flat_desc'        => 'Enter flat number',
        'addr_country_load'     => 'Error while loading countries list',

        // Extra:
        'extra_title'           => 'Your profile',
        'extra_phone'           => 'Phone',
        'extra_phone_desc'      => 'Your phone number',
        'extra_desc'            => 'Describe yourself',
        'extra_desc_desc'       => 'Enter here some short description about you - who you are and what you are doing. Only 500 characters.',
        'extra_cit'             => 'Your motto',
        'extra_cit_desc'        => 'Enter here some words of wisdom, e.g: A friend in need is a friend indeed.',
        'extra_profile'         => 'Show public profile',
        'extra_profile_desc'    => 'If you want to show your profile under link: $link, just select above checkbox. Only your photo, firstname, lastname, description and motto will be presented.',
    );
    
    private function __construct(){}
}

class Correct extends \Correct {
    
    protected static $_message = array(
        'update'            => 'Changes accepted',

        // Registration:
        'registration'      => 'Correctly register new user',

        // Address:
        'address_creation'  => 'Correctly added new address',
    );
    
    private function __construct(){}
}

class Error extends \Error {
    
    protected static $_message = array(
        'form_incomplete'   => 'All fields must be correctly filled in',
        'update'            => 'Error, changes can not be accepted, try again later',

        // Registration:
        'user_read'         => 'Unable to read user data',
        'user_create'       => 'An error occurred while creating new user',
        'user_update'       => 'An error occurred while updating user data',
        'registration'      => 'Error while trying to register new user. Try again later.',
        'reg_name'          => 'Invalid firstname',
        'reg_lastname'      => 'Invalid lastname',
        'reg_password'      => 'Invalid password',
        'reg_captcha'       => 'Invalid word from captcha image',
        'email_already_exists'  => 'This email already exists in our database',
        'wrong_email'       => 'This is probably not an email',

        // Address:
        'address_read'      => 'Unable to read address data',
        'address_create'    => 'An error occurred while creating new address',
        'address_update'    => 'An error occurred while updating address data',
        'address_creation'  => 'Error while trying to add new address. Try again later.',
        'addr_city'         => 'Invalid city name',
        'addr_zip'          => 'Invalid zip code',
        'addr_street'       => 'Invalid street',
        'addr_house'        => 'Invalid house number',
        'addr_flat'         => 'Invalid flat number',

        // Extra:
        'extra_phone'       => 'Invalid phone number',
        'extra_desc'        => 'Invalid description, at least 5 and at most 500 characters',
        'extra_cit'         => 'Invalid citation',

        // Login:
        'login'             => 'User does not exist, incorrect email or password',
    );
    
    private function __construct(){}
}