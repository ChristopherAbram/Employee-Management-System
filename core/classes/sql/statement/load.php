<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load statement package
 *
 * @package    core\classes\sql\statement
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

require_once realpath( dirname(__FILE__).'/Statement.class.php' );
require_once realpath( dirname(__FILE__).'/AttributeStatement.class.php' );

require_once realpath( dirname(__FILE__).'/delete/load.php' );
require_once realpath( dirname(__FILE__).'/select/load.php' );
require_once realpath( dirname(__FILE__).'/update/load.php' );
require_once realpath( dirname(__FILE__).'/insert/load.php' );