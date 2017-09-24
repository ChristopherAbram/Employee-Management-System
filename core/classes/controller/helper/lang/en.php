<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\controller\helperlang
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller\helper;

class Error extends \Error {
    
    protected static $_message = array(
        'config_init'                       => 'Error occured while initializing control map',
        'connection_init'                   => 'Error occurred while trying to connect with database server',
        'user_init'                         => 'Error occurred while initializing user instance',
        'app_registry'                      => 'Problem with initializing application registry',
        'panel_registry'                    => 'Problem with initializing panel registry',
        'menu_init'                         => 'Error occurred while initializing panel menu',

        'menu_xml_file_not_exists'          => 'Error occurred while trying to open $file',
        'read_xml_file'                     => 'Error occurred while reading $file'
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    'config_init'                       => 'Error occured while initializing control map',
    'connection_init'                   => 'Error occurred while trying to connect with database server',
    'user_init'                         => 'Error occurred while initializing user instance',
    'app_registry'                      => 'Problem with initializing application registry',
    'panel_registry'                    => 'Problem with initializing panel registry',
    'menu_init'                         => 'Error occurred while initializing panel menu',
    
    'menu_xml_file_not_exists'          => 'Error occurred while trying to open $file',
    'read_xml_file'                     => 'Error occurred while reading $file'
));*/