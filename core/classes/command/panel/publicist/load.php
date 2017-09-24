<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load publicist package
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/Command.class.php' );
require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleEditor.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleCategory.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleBody.class.php' );
require_once realpath( dirname(__FILE__).'/ArticlePicture.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleOptions.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleCategories.class.php' );
require_once realpath( dirname(__FILE__).'/File.class.php' );
require_once realpath( dirname(__FILE__).'/Upload.class.php' );
require_once realpath( dirname(__FILE__).'/Recycle.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );