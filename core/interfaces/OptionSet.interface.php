<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\interfaces
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\interfaces;

interface OptionSet extends \Iterator {
    public function add(\core\classes\form\field\SelectOption $object);
    public function addAll(array $object);
}