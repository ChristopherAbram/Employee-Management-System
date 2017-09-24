<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load sql package
 *
 * @package    core\classes\sql
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

require_once realpath( dirname(__FILE__).'/attribute/load.php' );
require_once realpath( dirname(__FILE__).'/statement/load.php' );

require_once realpath( dirname(__FILE__).'/Strategy.class.php' );
require_once realpath( dirname(__FILE__).'/StrategyFactory.class.php' );