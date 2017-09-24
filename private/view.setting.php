<?php
/**
 * Copyright (c) 2016 Christopher Abram.
 *
 * View Smarty Settings
 *
 * @package    view.setting.php
 * @author     Christopher Abram
 * @version    1.0
 * @date       02.09.2016
 */

require_once realpath( dirname(__FILE__).'/../core/classes/view/load.php' );

use core\classes\view\ViewSetting;

ViewSetting::$template_dir          = realpath( dirname(__FILE__).'/../app/views/' );
ViewSetting::$compile_dir           = realpath( dirname(__FILE__).'/../tmp/' );
ViewSetting::$cache_dir             = realpath( dirname(__FILE__).'/../cache/' );
ViewSetting::$configs_dir           = realpath( dirname(__FILE__).'/../lib/smarty/configs/' );
ViewSetting::$layouts_dir           = realpath( dirname(__FILE__).'/../app/layouts/' );