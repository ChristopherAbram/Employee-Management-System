<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	12.09.2016
 */

namespace core\functions;

function protocol_name(){
    $protocol = protocol();
    /*$slices = explode( '/', $protocol );
    $protocol_name = strtolower( $slices[ 0 ] );*/
    
    $protocol_name = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
    
    return $protocol_name;
}