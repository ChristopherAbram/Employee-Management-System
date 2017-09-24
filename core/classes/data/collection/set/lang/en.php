<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\data\collection\set\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.08.2016
 */

namespace core\classes\data\collection\set;

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
	'db_fetch_error'        => 'An error occurred while fetching data from database',
        'select_failed'         => 'An error occurred while executing select query',
        'update_failed'         => 'An error occurred while executing update query',
        'insert_failed'         => 'An error occurred while executing insert query',
        'delete_failed'         => 'An error occurred while executing delete query'
));*/

class Error extends \Error {
    
    protected static $_message = array(
        'lock_for_update'   => 'En error occurred while locking set of rows for update',
        'lock_in_share_mode'=> 'En error occurred while locking set of rows in share mode',
    );
    
    private function __construct(){}
}