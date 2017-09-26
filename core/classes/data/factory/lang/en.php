<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\data\factory\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\data\factory;

class Error extends \Error {
    
    protected static $_message = array(
        'country_by_address_id'     => 'Error while getting country by address id',
        'country_by_user_id'        => 'Error while getting country by user id',
        'country_all'               => 'Error while getting all countries',
        
        'userrole_by_user_id'       => 'Error while getting user role by user id',
        
        'address_by_user_id'        => 'Error while getting address by user id',
        
        'user_by_page_id'           => 'Error while getting user by page id',
        'user_by_article_id'        => 'Error while getting user by article id',
        'user_by_comment_id'        => 'Error while getting user by comment id',
        'user_by_file_info_id'      => 'Error while getting user by file_info id',
        'user_by_identifiers'       => 'Error while getting user by its identifiers data',
        'user_by_token'             => 'Error while getting user by token',
        'users_all'                 => 'Error while getting all users',
        'user_removed'              => 'Error while getting removed users',
    
        'user_page_by_user_id'      => 'Error while getting user_page by user id',
        'user_page_by_page_id'      => 'Error while getting user_page by page id',
    
        'page_by_page_id'           => 'Error while getting page by page id',
        'page_by_user_id'           => 'Error while getting page by user id',
        'page_by_parentpage_id'     => 'Error while getting page by parent page id',
        'page_by_article_id'        => 'Error while getting page by article id',
        'page_by_namepath'          => 'Error while getting page by namepath',
        'page_having_any_articles'  => 'Error while getting page having any articles',
        'page_removed'              => 'Error while getting removed pages',
        
        'article_by_comment_id'     => 'Error while getting article by comment id',
        'article_by_page_id'        => 'Error while getting article by page id',
        'article_by_page_and_user_id'=> 'Error while getting article by page and user id',
        'article_by_user_id'        => 'Error while getting article by user id',
        'article_by_namepath'       => 'Error while getting article by namepath',
        'article_all'               => 'Error while getting articles',
        'article_removed_by_user_id'=> 'Error while getting removed articles by user id',
        'article_removed'           => 'Error while getting removed articles',
        'article_having_comments'   => 'Error while getting article having any comments',
        
        'articlegrade_by_user_article_id' => 'Error while getting article grade by article and user id',
        
        'comment_by_user_id'        => 'Error while getting comment by user id',
        'comments'                  => 'Error while getting comments',
        'comment_by_article_id'     => 'Error while getting comment by article id',
        
        'file_info_by_user_id'      => 'Error while getting avatar by user id',
        'file_info_by_file_id'      => 'Error while getting file info by file id',
        'file_info_by_file_miniature_id' => 'Error while getting file info by file miniature id',
        'file_info_by_user_id'      => 'Error while getting file info by user id',
        'file_info_by_article_id'   => 'Error while getting file info by article id',
        'file_removed_by_user_id'   => 'Error while getting removed file info by user id',
        'file_removed'              => 'Error while getting removed file info',
        
        'file_miniature_by_file_info_id' => 'Error while getting file miniature by file info id',
        
        'file_by_file_info_id'      => 'Error while getting file by file info id',
        'email_exists'      => 'Error while getting user by email',
    
        'session_by_sid'        => 'Error while getting session by sid',
        'session_value_by_key'        => 'Error while getting session value by key',
        'session_value_by_session_id' => 'Error while getting session value by session id',
        
        'department_by_namepath'       => 'Error while getting department by namepath',
        
        'all_responsibilities'        => 'Error while getting responsibilities',
        'all_working_times'        => 'Error while getting working times',
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
	'country_by_address_id'     => 'Error while getting country by address id',
        'country_by_user_id'        => 'Error while getting country by user id',
        'country_all'               => 'Error while getting all countries',
        
        'userrole_by_user_id'       => 'Error while getting user role by user id',
        
        'address_by_user_id'        => 'Error while getting address by user id',
        
        'user_by_page_id'           => 'Error while getting user by page id',
        'user_by_article_id'        => 'Error while getting user by article id',
        'user_by_comment_id'        => 'Error while getting user by comment id',
        'user_by_file_info_id'      => 'Error while getting user by file_info id',
        'user_by_identifiers'       => 'Error while getting user by its identifiers data',
        'user_by_token'             => 'Error while getting user by token',
        'users_all'                 => 'Error while getting all users',
        'user_removed'              => 'Error while getting removed users',
    
        'user_page_by_user_id'      => 'Error while getting user_page by user id',
        'user_page_by_page_id'      => 'Error while getting user_page by page id',
    
        'page_by_page_id'           => 'Error while getting page by page id',
        'page_by_user_id'           => 'Error while getting page by user id',
        'page_by_parentpage_id'     => 'Error while getting page by parent page id',
        'page_by_article_id'        => 'Error while getting page by article id',
        'page_by_namepath'          => 'Error while getting page by namepath',
        'page_having_any_articles'  => 'Error while getting page having any articles',
        'page_removed'              => 'Error while getting removed pages',
        
        'article_by_comment_id'     => 'Error while getting article by comment id',
        'article_by_page_id'        => 'Error while getting article by page id',
        'article_by_page_and_user_id'=> 'Error while getting article by page and user id',
        'article_by_user_id'        => 'Error while getting article by user id',
        'article_by_namepath'       => 'Error while getting article by namepath',
        'article_all'               => 'Error while getting articles',
        'article_removed_by_user_id'=> 'Error while getting removed articles by user id',
        'article_removed'           => 'Error while getting removed articles',
    
        'articlegrade_by_user_article_id' => 'Error while getting article grade by article and user id',
        
        'comment_by_user_id'        => 'Error while getting comment by user id',
        'comment_by_article_id'     => 'Error while getting comment by article id',
        
        'file_info_by_user_id'      => 'Error while getting avatar by user id',
        'file_info_by_file_id'      => 'Error while getting file info by file id',
        'file_info_by_file_miniature_id' => 'Error while getting file info by file miniature id',
        'file_info_by_user_id'      => 'Error while getting file info by user id',
        'file_info_by_article_id'   => 'Error while getting file info by article id',
        'file_removed_by_user_id'   => 'Error while getting removed file info by user id',
        'file_removed'              => 'Error while getting removed file info',
        
        'file_miniature_by_file_info_id' => 'Error while getting file miniature by file info id',
        
        'file_by_file_info_id'      => 'Error while getting file by file info id',
        'email_exists'      => 'Error while getting user by email',
    
        'session_by_sid'        => 'Error while getting session by sid',
    'session_value_by_key'        => 'Error while getting session value by key',
    'session_value_by_session_id' => 'Error while getting session value by session id',
    
));*/