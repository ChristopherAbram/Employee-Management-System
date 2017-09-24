<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load mapper package
 *
 * @package    core\classes\mapper
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

require_once realpath( dirname(__FILE__).'/lang/load.php' );

require_once realpath( dirname(__FILE__).'/MapperException.class.php' );
require_once realpath( dirname(__FILE__).'/ResultSet.class.php' );
require_once realpath( dirname(__FILE__).'/Mapper.class.php' );
require_once realpath( dirname(__FILE__).'/DataMapper.class.php' );

require_once realpath( dirname(__FILE__).'/factory/load.php' );