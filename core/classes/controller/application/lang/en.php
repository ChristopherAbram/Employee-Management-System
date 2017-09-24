<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\controller\application\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller\application;

class Error extends \Error {
    
    protected static $_message = array(
        'cmd_not_exists'            => 'Error, command does not exist',
        'looping'                   => 'Detect loop in control chain',
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    'cmd_not_exists'            => 'Error, command does not exist',
    'looping'                   => 'Detect loop in control chain',
));*/