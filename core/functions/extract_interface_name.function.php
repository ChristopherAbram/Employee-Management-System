<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\functions;

function extract_interface_name($classname, &$class){
    $classname = str_replace('\\', \DIRECTORY_SEPARATOR, $classname);
    $arr = \explode(\DIRECTORY_SEPARATOR, $classname);
    end($arr);
    $class = \array_pop($arr);
    $namespace = implode(\DIRECTORY_SEPARATOR, $arr);
    return $namespace;
}