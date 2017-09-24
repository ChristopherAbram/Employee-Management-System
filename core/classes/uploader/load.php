<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load uploader package
 *
 * @package    core\classes\uploader
 * @author     Christopher Abram
 * @version    1.0
 * @date	26.09.2016
 */

require_once realpath( dirname(__FILE__).'/definitions.php' );

require_once realpath( dirname(__FILE__).'/UploaderException.class.php' );

require_once realpath( dirname(__FILE__).'/handler/load.php' );
require_once realpath( dirname(__FILE__).'/Uploader.class.php' );