<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\command\panel\administrator\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\publicist;

class Text extends \Text {
    
    protected static $_message = array(
        // Article editor:
        'editor'                => 'Article editor',
        'art_title'             => 'Title',
        'art_title_desc'        => '',
        'art_namepath'          => 'Namepath',
        'art_namepath_desc'     => '',
        'art_desc'              => 'Short description',
        'art_desc_desc'         => '',
        'art_link'              => 'Link',
        'art_link_desc'         => '',


        // Article category:
        'articleparent'         => 'Category',
        'article_desc'          => 'Choose categories. You must select at least one option!',

        // Page body:
        'artbody'               => 'Content',
        'body_desc'             => '',
        'art_body'              => 'Article content',
        'art_body_desc'         => '',

        // Article picture:
        'article_picture_title' => 'Choose picture',
        'picture_desc'          => '',

        // Page options:
        'artoptions'            => 'Options',
        'art_options_desc'      => '',
        'art_keywords'          => 'Keywords',
        'art_keywords_desc'     => '',
        'art_ord'               => 'List order',
        'art_ord_desc'          => '',
        'art_hide'              => 'Hide',
        'art_hide_desc'         => '',
        'art_mark'              => 'Mark',
        'art_mark_desc'         => '',
    );
    
    private function __construct(){}
}

class Correct extends \Correct {
    
    protected static $_message = array(
        'update'                => 'Changes accepted',
        // Page editor:
        'art_create'            => 'Successfully created new article',
    );
    
    private function __construct(){}
}

class Error extends \Error {
    
    protected static $_message = array(
        'form_incomplete'       => 'Form requires to be properly fulfilled',
        'update'                => 'Changes can not be accepted, try again later',
        'invalid'               => 'Invalid, content too long, too short or used a forbidden character',

        // Page editor:
        'article_not_exists'    => 'Unable to open article. Article probably does not exist or you can not modify it.',
        'art_read'              => 'Unable to read article data',
        'art_create'            => 'An error occurred while creating new article',
        'art_update'            => 'An error occurred while updating article data',
        'invalid_link'          => 'This is probably not valid link',
        'namepath_exists'       => 'This namepath already exist',

        // Page options:
        'invalid_ord'           => 'This is not a number',
    );
    
    private function __construct(){}
}