<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\controller\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller;

class Error extends \Error {
    
    protected static $_message = array(
        
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    
));*/