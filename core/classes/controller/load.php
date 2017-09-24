<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load controller package
 *
 * @package    core\classes\controller
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/ControllerException.class.php' );
require_once realpath( dirname(__FILE__).'/InternalException.class.php' );
require_once realpath( dirname(__FILE__).'/Map.class.php' );

require_once realpath( dirname(__FILE__).'/helper/load.php' );
require_once realpath( dirname(__FILE__).'/front/load.php' );
require_once realpath( dirname(__FILE__).'/application/load.php' );