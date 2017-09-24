<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load update package
 *
 * @package    core\classes\sql\statement\update
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

require_once realpath( dirname(__FILE__).'/Statement.class.php' );

require_once realpath( dirname(__FILE__).'/Blank.class.php' );
require_once realpath( dirname(__FILE__).'/Address.class.php' );
require_once realpath( dirname(__FILE__).'/Country.class.php' );
require_once realpath( dirname(__FILE__).'/UserRole.class.php' );
require_once realpath( dirname(__FILE__).'/User.class.php' );

require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/PageArticle.class.php' );
require_once realpath( dirname(__FILE__).'/PageVisit.class.php' );
require_once realpath( dirname(__FILE__).'/RestorePageFromBin.class.php' );
require_once realpath( dirname(__FILE__).'/ShowPage.class.php' );
require_once realpath( dirname(__FILE__).'/UserPage.class.php' );

require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreArticleFromBin.class.php' );
require_once realpath( dirname(__FILE__).'/ShowArticle.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleVisit.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleGrade.class.php' );

require_once realpath( dirname(__FILE__).'/Comment.class.php' );
require_once realpath( dirname(__FILE__).'/FileInfo.class.php' );
require_once realpath( dirname(__FILE__).'/FileMiniature.class.php' );
require_once realpath( dirname(__FILE__).'/File.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllArticles.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllArticlesByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllFiles.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllFilesByUserId.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllPages.class.php' );
require_once realpath( dirname(__FILE__).'/RestoreAllUsers.class.php' );

require_once realpath( dirname(__FILE__).'/Session.class.php' );
require_once realpath( dirname(__FILE__).'/SessionValue.class.php' );