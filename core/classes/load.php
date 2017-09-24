<?php
/*
 * Copyright (c) 2015 Christopher Abram.
 *
 * Load classes
 *
 * @package    core\classes
 * @author     Christopher Abram
 * @version    1.0
 * @date	04.09.2015
 */
 
require_once realpath( dirname(__FILE__).'/definitions.php' );

// Loading language packages for displaying communiques:
require_once realpath( dirname(__FILE__).'/languages/load.php' );
require_once realpath( dirname(__FILE__).'/message/load.php' );

// Loading package for error handling:
require_once realpath( dirname(__FILE__).'/errorhandling/load.php' );

require_once realpath( dirname(__FILE__).'/pdo/load.php' );

// Loading Registry package:
require_once realpath( dirname(__FILE__).'/registry/load.php' );

require_once realpath( dirname(__FILE__).'/operation/load.php' );

// Loading Visitor package:
require_once realpath( dirname(__FILE__).'/visitor/load.php' );

require_once realpath( dirname(__FILE__).'/request/load.php' );
require_once realpath( dirname(__FILE__).'/cookie/load.php' );
require_once realpath( dirname(__FILE__).'/session/load.php' );
require_once realpath( dirname(__FILE__).'/response/load.php' );
require_once realpath( dirname(__FILE__).'/connection/load.php' );

// Loading SQL package:
require_once realpath( dirname(__FILE__).'/sql/load.php' );
require_once realpath( dirname(__FILE__).'/mapper/load.php' );

require_once realpath( dirname(__FILE__).'/data/load.php' );
require_once realpath( dirname(__FILE__).'/domain/load.php' );

require_once realpath( dirname(__FILE__).'/persistence/load.php' );

require_once realpath( dirname(__FILE__).'/view/load.php' );
require_once realpath( dirname(__FILE__).'/form/load.php' );

// Uploader package:
require_once realpath( dirname(__FILE__).'/uploader/load.php' );

require_once realpath( dirname(__FILE__).'/control/load.php' );
require_once realpath( dirname(__FILE__).'/command/load.php' );
require_once realpath( dirname(__FILE__).'/controller/load.php' );