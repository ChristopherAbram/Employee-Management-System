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

interface UnitOfWork {
    public function addClean(\core\classes\data\Data $object);
    public function addDirty(\core\classes\data\Data $object);
    public function addNew(\core\classes\data\Data $object);
    public function addDelete(\core\classes\data\Data $object);
    public function perform();
}