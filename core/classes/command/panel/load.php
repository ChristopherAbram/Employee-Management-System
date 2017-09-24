<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load panel package
 *
 * @package    core\classes\command\panel
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

require_once realpath( dirname(__FILE__).'/Command.class.php' );

// Generals:
require_once realpath( dirname(__FILE__).'/DefaultCommand.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );

require_once realpath( dirname(__FILE__).'/guest/load.php' );
require_once realpath( dirname(__FILE__).'/plain/load.php' );
require_once realpath( dirname(__FILE__).'/publicist/load.php' );
require_once realpath( dirname(__FILE__).'/administrator/load.php' );