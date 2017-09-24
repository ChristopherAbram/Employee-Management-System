<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\domain\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\domain;

class Error extends \Error {
    
    protected static $_message = array(
        'load_domain_data'          => 'Error occurred while loading data for domain object',
        'note_visit'                => 'Error occurred while updating visit count'
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
    'load_domain_data'          => 'Error occurred while loading data for domain object',
    'note_visit'                => 'Error occurred while updating visit count'
));*/