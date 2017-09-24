<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date       10.09.2016
 */

namespace core\functions;

function status($code, $redirect = true){
    return protocol().' '.\core\classes\response\Response::status($code);
}