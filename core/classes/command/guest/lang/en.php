<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\command\guest\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	25.09.2016
 */

namespace core\classes\command\guest;

class Error extends \Error {
    
    protected static $_message = array(
        'read_user'                 => 'Error occurred while reading user data',
        'article_read'              => 'Error occurred while reading article list',
    );
    
    private function __construct(){}
}

class Text extends \Text {
    
    protected static $_message = array(
        // Article:
        'article'                   => 'Article',
        'last_modified'             => 'last modified',
        'visits'                    => 'visits',

        // Article list:
        'article_list_title'        => 'Article list',
        'articles_list'             => 'Articles',
        'result_page'               => 'Page'
    );
    
    private function __construct(){}
}