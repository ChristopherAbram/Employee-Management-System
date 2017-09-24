<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Load field package
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

require_once realpath( dirname(__FILE__).'/definitions.php' );

require_once realpath( dirname(__FILE__).'/Field.class.php' );
require_once realpath( dirname(__FILE__).'/Textarea.class.php' );

require_once realpath( dirname(__FILE__).'/Input.class.php' );
require_once realpath( dirname(__FILE__).'/Text.class.php' );
require_once realpath( dirname(__FILE__).'/Password.class.php' );
require_once realpath( dirname(__FILE__).'/Checkbox.class.php' );
require_once realpath( dirname(__FILE__).'/Radio.class.php' );
require_once realpath( dirname(__FILE__).'/RadioGroup.class.php' );
require_once realpath( dirname(__FILE__).'/InputButton.class.php' );
require_once realpath( dirname(__FILE__).'/Submit.class.php' );
require_once realpath( dirname(__FILE__).'/Reset.class.php' );
require_once realpath( dirname(__FILE__).'/File.class.php' );
require_once realpath( dirname(__FILE__).'/Email.class.php' );
require_once realpath( dirname(__FILE__).'/Hidden.class.php' );
require_once realpath( dirname(__FILE__).'/Date.class.php' );
require_once realpath( dirname(__FILE__).'/Number.class.php' );
require_once realpath( dirname(__FILE__).'/Captcha.class.php' );

require_once realpath( dirname(__FILE__).'/Button.class.php' );
require_once realpath( dirname(__FILE__).'/SubmitButton.class.php' );
require_once realpath( dirname(__FILE__).'/ResetButton.class.php' );

require_once realpath( dirname(__FILE__).'/Select.class.php' );
require_once realpath( dirname(__FILE__).'/SelectOption.class.php' );
require_once realpath( dirname(__FILE__).'/Option.class.php' );
require_once realpath( dirname(__FILE__).'/OptGroup.class.php' );

require_once realpath( dirname(__FILE__).'/factory/load.php' );
require_once realpath( dirname(__FILE__).'/set/load.php' );
