<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\uploader\handler\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.09.2016
 */

namespace core\classes\uploader\handler;

class Error extends \Error {
    
    protected static $_message = array(
        'delete'                => 'Error occurred while deleting file',
        'insert_file_info'      => 'Error occurred while inserting file metadata',
        'insert_file'           => 'Error occurred while inserting file',
        'insert_miniature'      => 'Error occurred while inserting file miniature',

        'read_file'             => 'Error occurred while reading file',
        'read_file_miniature'   => 'Error occurred while reading file miniature',

        'get_dimensions'        => 'Problem with getting image dimensions'
    );
    
    private function __construct(){}
}