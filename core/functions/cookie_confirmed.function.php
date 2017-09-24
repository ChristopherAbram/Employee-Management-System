<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\functions;

require_once realpath( dirname(__FILE__).'/../classes/cookie/Cookie.class.php' );

function cookie_confirmed(){
    $cookie = \core\classes\cookie\Cookie::getInstance();
    if(isset($cookie['cookie_info']) && $cookie['cookie_info'] == 1){
        return true;
    }
    return false;
}