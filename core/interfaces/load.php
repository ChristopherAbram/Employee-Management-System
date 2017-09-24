<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load interfaces
 *
 * @package    core\interfaces
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */
 
require_once realpath( dirname(__FILE__).'/crud.interface.php' );
require_once realpath( dirname(__FILE__).'/IdentityMap.interface.php' );
require_once realpath( dirname(__FILE__).'/UnitOfWork.interface.php' );
require_once realpath( dirname(__FILE__).'/LazyLoad.interface.php' );
require_once realpath( dirname(__FILE__).'/OptionSet.interface.php' );