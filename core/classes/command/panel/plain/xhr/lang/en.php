<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\command\plain\xhr\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\classes\command\panel\plain\xhr;

class Error extends \Error {
    
    protected static $_message = array(
        // Comments:
        'id'          => 'Wrong file ID',
        'user'        => 'Unable to authorize user',
        'avatar'      => 'Can not associate avatar file to user',
        'delete_avatar' => 'A problem occurred while deleting avatar image',
    );
    
    private function __construct(){}
}

class Correct extends \Correct {
    
    protected static $_message = array(
        'added'         => 'Successfully added avatar',
        'delete_avatar' => 'Correctly deleted avatar image'
    );
    
    private function __construct(){}
}