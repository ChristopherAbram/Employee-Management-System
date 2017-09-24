<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load command package
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/Command.class.php' );
require_once realpath( dirname(__FILE__).'/MultiStep.class.php' );
require_once realpath( dirname(__FILE__).'/Editor.class.php' );
require_once realpath( dirname(__FILE__).'/MultiStepEditor.class.php' );

// Generals:
require_once realpath( dirname(__FILE__).'/DefaultCommand.class.php' );
require_once realpath( dirname(__FILE__).'/Registration.class.php' );
require_once realpath( dirname(__FILE__).'/Address.class.php' );
require_once realpath( dirname(__FILE__).'/Extra.class.php' );
require_once realpath( dirname(__FILE__).'/Login.class.php' );
require_once realpath( dirname(__FILE__).'/Logout.class.php' );
require_once realpath( dirname(__FILE__).'/Page.class.php' );
require_once realpath( dirname(__FILE__).'/Captcha.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );

// Commands for panel application:
require_once realpath( dirname(__FILE__).'/panel/load.php' );

require_once realpath( dirname(__FILE__).'/guest/load.php' );
require_once realpath( dirname(__FILE__).'/plain/load.php' );
require_once realpath( dirname(__FILE__).'/publicist/load.php' );
require_once realpath( dirname(__FILE__).'/administrator/load.php' );