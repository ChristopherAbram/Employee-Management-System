<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load guest package
 *
 * @package    core\classes\command\guest
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/Command.class.php' );
require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleList.class.php' );
require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/Connector.class.php' );
require_once realpath( dirname(__FILE__).'/Upload.class.php' );
require_once realpath( dirname(__FILE__).'/Panel.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );