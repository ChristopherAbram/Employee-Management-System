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

namespace core\classes\command\plain\xhr;

class Error extends \Error {
    
    protected static $_message = array(
        // Comments:
        'user_unknown'          => 'Can not recognize user',
        'comment_validation'    => 'Wrong comment content',
        'comment_rejected'      => 'Unable to add comment, try again later',
        
        'limits'                => 'Unable to load more files, you have already approach limitations',

        // Article grade:
        'parameters'            => 'Unknown parameters',
        'grade'                 => 'Unable to add new grade',
    );
    
    private function __construct(){}
}

class Correct extends \Correct {
    
    protected static $_message = array(
        'comment_added'         => 'Successfully added new comment'
    );
    
    private function __construct(){}
}