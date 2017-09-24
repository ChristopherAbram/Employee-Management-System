<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\controller\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\control;

class Error extends \Error {
    
    protected static $_message = array(
        'control_xml_file_not_exists'       => 'Error occurred while trying to open $file',
        'read_xml_file'                     => 'Error occurred while reading $file'
    );
    
    private function __construct(){}
}