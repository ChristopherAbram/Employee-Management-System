<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\connection\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

namespace core\classes\connection;

class Error extends \Error {
    
    protected static $_message = array(
        'bad_dsn'               => 'Bad Data Source Name',
        'connection_bad_data'   => 'Connection requires at least dsn, username and password',
        'connection_failed'     => 'Attemption to connect to the requested database failed'
    );
    
    private function __construct(){}
}