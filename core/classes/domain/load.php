<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load domain package
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

require_once realpath( dirname(__FILE__).'/definitions.php' );
require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/DomainException.class.php' );
require_once realpath( dirname(__FILE__).'/Domain.class.php' );

require_once realpath( dirname(__FILE__).'/Article.class.php' );
require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/File.class.php' );

require_once realpath( dirname(__FILE__).'/User.class.php' );
require_once realpath( dirname(__FILE__).'/Guest.class.php' );
require_once realpath( dirname(__FILE__).'/AuthorizedUser.class.php' );
require_once realpath( dirname(__FILE__).'/Plain.class.php' );
require_once realpath( dirname(__FILE__).'/Publicist.class.php' );
require_once realpath( dirname(__FILE__).'/Administrator.class.php' );

require_once realpath( dirname(__FILE__).'/Comment.class.php' );

require_once realpath( dirname(__FILE__).'/collection/load.php' );
require_once realpath( dirname(__FILE__).'/factory/load.php' );
