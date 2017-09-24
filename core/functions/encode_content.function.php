<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\functions;

function encode_content($value){
    return \base64_encode($value);
}