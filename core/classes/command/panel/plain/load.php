<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load plain package
 *
 * @package    core\classes\command\panel\plain
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/Command.class.php' );
require_once realpath( dirname(__FILE__).'/Dashboard.class.php' );
require_once realpath( dirname(__FILE__).'/Account.class.php' );
require_once realpath( dirname(__FILE__).'/Address.class.php' );
require_once realpath( dirname(__FILE__).'/Description.class.php' );
require_once realpath( dirname(__FILE__).'/Image.class.php' );

require_once realpath( dirname(__FILE__).'/xhr/load.php' );