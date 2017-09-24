<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\registry
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

abstract class Registry {
    abstract protected function get($key);
    abstract protected function set($key, $value);
}