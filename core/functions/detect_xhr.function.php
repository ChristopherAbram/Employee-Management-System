<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\functions;

function detect_xhr(){
    if(\array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && 
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        \strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        return true;
    }
    return false;
}