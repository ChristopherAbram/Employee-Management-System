<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\mapper\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.08.2016
 */

namespace core\classes\mapper;

class Error extends \Error {
    
    protected static $_message = array(
        'db_fetch_error'        => 'An error occurred while fetching data from database',
        'select_failed'         => 'An error occurred while executing select query',
        'update_failed'         => 'An error occurred while executing update query',
        'insert_failed'         => 'An error occurred while executing insert query',
        'delete_failed'         => 'An error occurred while executing delete query'
    );
    
    private function __construct(){}
}