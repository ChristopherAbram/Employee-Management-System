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

function generate_session_id( ){
    $time = \microtime();
    $client_ip = \core\functions\ip(true);
    $lcg_value = \lcg_value();
    $id = \md5($time.$client_ip.$lcg_value);
    return $id;
}