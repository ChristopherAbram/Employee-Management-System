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

interface CRUD {
    public function create();
    public function read();
    public function update();
    public function delete();
}