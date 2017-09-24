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

function header($string, $replace = true, $http_response_code = ''){
    $matches = array();
    
    if(preg_match('/^HTTP(S)?\/[1-2]\.[0-1](\s)+([4-5][0-9]+)/i', $string, $matches)){
        // Include error page:
        $_GET['error'] = isset($matches[3]) ? (int)$matches[3] : 0;
        if($_GET['error'] >= 400){
            \header(\core\classes\response\Response::status($_GET['error']), true, $_GET['error']);
        }
        include realpath( dirname(__FILE__).'/../../error/error.php' );
        exit(0);
    }

    if($http_response_code === ''){
        \header($string, $replace);
    }
    else {
        \header($string, $replace, $http_response_code);
    }
    return;
}// end header