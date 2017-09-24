<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\interfaces
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\interfaces;

interface IdentityMap {
    public function add(\core\classes\data\Data $object);
    public function exists(\core\classes\data\Data $object);
    public function key(\core\classes\data\Data $object);
}