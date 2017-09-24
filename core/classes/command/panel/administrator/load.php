<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load administrator package
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/Command.class.php' );

require_once realpath( dirname(__FILE__).'/Departments.class.php' );




require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/PageEditor.class.php' );
require_once realpath( dirname(__FILE__).'/PageParent.class.php' );
require_once realpath( dirname(__FILE__).'/PageBody.class.php' );
require_once realpath( dirname(__FILE__).'/PageOptions.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleCategories.class.php' );
require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleEditor.class.php' );
require_once realpath( dirname(__FILE__).'/ArticleCategory.class.php' );
require_once realpath( dirname(__FILE__).'/FileList.class.php' );
require_once realpath( dirname(__FILE__).'/Members.class.php' );
require_once realpath( dirname(__FILE__).'/Member.class.php' );
require_once realpath( dirname(__FILE__).'/Registration.class.php' );
require_once realpath( dirname(__FILE__).'/Address.class.php' );
require_once realpath( dirname(__FILE__).'/Extra.class.php' );
require_once realpath( dirname(__FILE__).'/Recycle.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );