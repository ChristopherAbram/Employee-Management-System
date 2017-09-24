<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\controller\front\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller\front;

class Error extends \Error {
    
    protected static $_message = array(
        'controller_fatal_error'        => 'Application controller not valid instance',
        'panel_controller_fatal_error'  => 'Panel controller not valid instance',
        'menu'                          => 'Error while building menu',
        'noscript'                      => 'JavaScript is disabled. If you want to fully and comfortable use this site, it is recommended to change browser or enable JavaSript service.'
    );
    
    private function __construct(){}
}

class Text extends \Text {
    
    protected static $_message = array(
        'fatal_error_title'             => 'Fatal Error',
        'fatal_error_desc'              => 'Application fatal errors occur when initializing registry, parsing control files, starting session etc.',

        'internal_error_title'          => 'Internal Error',
        'internal_error_desc'           => 'Internal errors occur when application is running properly, but service request went wrong. e.g. exception has been thrown.',

        'cookie'                        => 'This website uses cookies to ensure you get the best experience on our website.',

        'desc'                          => 'Description',
        'msg'                           => 'Error message',
        'err'                           => 'Error cause',
        'file'                          => 'File',
        'line'                          => 'Line',
        'code'                          => 'Code'
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    'controller_fatal_error'        => 'Application controller not valid instance',
    'panel_controller_fatal_error'  => 'Panel controller not valid instance',
    'menu'                          => 'Error while building menu',
    'noscript'                      => 'JavaScript is disabled. If you want to fully and comfortable use this site, it is recommended to change browser or enable JavaSript service.'
    
));

Lang::text(array(
    'fatal_error_title'             => 'Fatal Error',
    'fatal_error_desc'              => 'Application fatal errors occur when initializing registry, parsing control files, starting session etc.',
    
    'internal_error_title'          => 'Internal Error',
    'internal_error_desc'           => 'Internal errors occur when application is running properly, but service request went wrong. e.g. exception has been thrown.',
    
    'cookie'                        => 'To make this site work properly, we sometimes place small data files called cookies on your device. Most big websites do this too.',
    
    'desc'                          => 'Description',
    'msg'                           => 'Error message',
    'err'                           => 'Error cause',
    'file'                          => 'File',
    'line'                          => 'Line',
    'code'                          => 'Code'
));*/