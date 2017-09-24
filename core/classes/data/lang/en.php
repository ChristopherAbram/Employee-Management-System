<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\data\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\data;

class Error extends \Error {
    
    protected static $_message = array(
        'read'      => 'Unable to perform read operation',
        'create'    => 'Unable to perform create operation',
        'update'    => 'Unable to perform update operation',
        'delete'    => 'Unable to perform delete operation',

        'lock_for_update'       => 'Error occurred while locking for update',
        'lock_in_share_mode'    => 'Error occurred while locking in share mode',

        'bin'       => 'Unable to move item to bin',
        'unbin'     => 'Unable to restore item from bin',
        'hide'      => 'Unable to hide item',
        'show'      => 'Unable to show item',
        'count'     => 'Error occurred while getting count',
        'average'   => 'Error occurred while getting average value',
        'restore'   => 'Error occurred while restoring',
    );
    
    private function __construct(){}
}

class Warning extends \Warning {
    
    protected static $_message = array(
        'clone_forbidden'           => 'It is forbidden to clone data object',
        'serialization_forbidden'   => 'It is forbidden to serialize data object',
        'unserialization_forbidden' => 'It is forbidden to unserialize data object',
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    'read'      => 'Unable to perform read operation',
    'create'    => 'Unable to perform create operation',
    'update'    => 'Unable to perform update operation',
    'delete'    => 'Unable to perform delete operation',
    
    'lock_for_update'       => 'Error occurred while locking for update',
    'lock_in_share_mode'    => 'Error occurred while locking in share mode',
    
    'bin'       => 'Unable to move item to bin',
    'unbin'     => 'Unable to restore item from bin',
    'hide'      => 'Unable to hide item',
    'show'      => 'Unable to show item',
    'count'     => 'Error occurred while getting count',
    'average'   => 'Error occurred while getting average value',
    'restore'   => 'Error occurred while restoring',
));

Lang::warning( array(
    'clone_forbidden'           => 'It is forbidden to clone data object',
    'serialization_forbidden'   => 'It is forbidden to serialize data object',
    'unserialization_forbidden' => 'It is forbidden to unserialize data object',
));*/