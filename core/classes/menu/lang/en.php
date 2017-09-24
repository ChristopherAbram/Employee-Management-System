<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\menu
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\menu;

class Error extends \Error {
    
    protected static $_message = array(
        
        'menu_init'                         => 'Error occurred while initializing panel menu',

        'menu_xml_file_not_exists'          => 'Error occurred while trying to open $file',
        'read_xml_file'                     => 'Error occurred while reading $file'
    );
    
    private function __construct(){}
}
