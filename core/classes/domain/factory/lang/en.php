<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * English messages storage.
 *
 * @package    core\classes\domain\factory\lang
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\domain\factory;

class Error extends \Error {
    
    protected static $_message = array(
        'user_by_id'            => 'Error while getting User instance by id',
	'user_by_file_id'       => 'Error while getting User instance by file id',
        'user_by_article_id'    => 'Error while getting User instance by article id',
        'user_by_page_id'       => 'Error while getting User instance by page id',
        'user_by_comment_id'    => 'Error while getting User instance by comment id',
        'user_by_identifiers'   => 'Error while getting User instance by identifiers',
        'user_by_token'         => 'Error while getting User instance by token',
        'all_users'             => 'Error while getting all User instances',
        'removed_user'          => 'Error while getting User instances',
    
        'page_by_user_id'       => 'Error while getting Page instance by user id',
        'page_by_child_id'      => 'Error while getting Page instance by child page id',
        'page_by_parent_id'     => 'Error while getting Page instance by parent page id',
        'page_by_article_id'    => 'Error while getting Page instance by article id',
        'page_by_namepath'      => 'Error while getting Page instance by namepath',
        'removed_pages'         => 'Error while getting Page instances',
    
        'article_by_page_id'    => 'Error while getting Article instance by page id',
        'article_by_user_id'    => 'Error while getting Article instance by user id',
        'article_by_comment_id' => 'Error while getting Article instance by comment id',
        'article_by_namepath'   => 'Error while getting Article instance by namepath',
        'removed_article_by_user_id' => 'Error while getting removed Article instances by user id',
        'removed_article'       => 'Error while getting removed Article instances',
        'visible_article'       => 'Error while getting visible Article instances',
        
        'comment_by_article_id' => 'Error while getting Comment instance by article id',
        'comment_by_user_id'    => 'Error while getting Comment instance by user id',
    
        'file_by_user_id'       => 'Error while getting File instance by user id',
        'file_by_article_id'    => 'Error while getting File instance by article id',
        'removed_file_by_user_id' => 'Error while getting removed File instances by user id',
    
        'logged_user'           => 'Error while getting logged user',
        
        'department_by_namepath'=> 'Error while getting Department instance by namepath',
    );
    
    private function __construct(){}
}

/*use core\classes\languages\Lang;
Lang::setLanguage( EN );
Lang::usePackage( __NAMESPACE__ );

Lang::error( array(
        'user_by_id'            => 'Error while getting User instance by id',
	'user_by_file_id'       => 'Error while getting User instance by file id',
        'user_by_article_id'    => 'Error while getting User instance by article id',
        'user_by_page_id'       => 'Error while getting User instance by page id',
        'user_by_comment_id'    => 'Error while getting User instance by comment id',
        'user_by_identifiers'   => 'Error while getting User instance by identifiers',
        'user_by_token'         => 'Error while getting User instance by token',
        'all_users'             => 'Error while getting all User instances',
        'removed_user'          => 'Error while getting User instances',
    
        'page_by_user_id'       => 'Error while getting Page instance by user id',
        'page_by_child_id'      => 'Error while getting Page instance by child page id',
        'page_by_parent_id'     => 'Error while getting Page instance by parent page id',
        'page_by_article_id'    => 'Error while getting Page instance by article id',
        'page_by_namepath'      => 'Error while getting Page instance by namepath',
        'removed_pages'         => 'Error while getting Page instances',
    
        'article_by_page_id'    => 'Error while getting Article instance by page id',
        'article_by_user_id'    => 'Error while getting Article instance by user id',
        'article_by_comment_id' => 'Error while getting Article instance by comment id',
        'article_by_namepath'   => 'Error while getting Article instance by namepath',
        'removed_article_by_user_id' => 'Error while getting removed Article instances by user id',
        'removed_article'       => 'Error while getting removed Article instances',
        
        'comment_by_article_id' => 'Error while getting Comment instance by article id',
        'comment_by_user_id'    => 'Error while getting Comment instance by user id',
    
        'file_by_user_id'       => 'Error while getting File instance by user id',
        'file_by_article_id'    => 'Error while getting File instance by article id',
        'removed_file_by_user_id' => 'Error while getting removed File instances by user id',
    
        'logged_user'           => 'Error while getting logged user'
    
));*/