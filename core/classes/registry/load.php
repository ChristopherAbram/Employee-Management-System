<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load registry package
 *
 * @package    core\classes\registry
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

require_once realpath( dirname(__FILE__).'/Registry.class.php' );
require_once realpath( dirname(__FILE__).'/RequestRegistry.class.php' );
require_once realpath( dirname(__FILE__).'/ConnectionRegistry.class.php' );
require_once realpath( dirname(__FILE__).'/ApplicationRegistry.class.php' );
require_once realpath( dirname(__FILE__).'/PanelRegistry.class.php' );