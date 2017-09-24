<?php

/**
* Get files that specified suffix
* @param $path
* @param array $files
* @return array
*/

function getfiles( $path , &$files = array() ) {
    if ( !is_dir( $path ) ) return null;
    $handle = opendir( $path );
    while ( false !== ( $file = readdir( $handle ) ) ) {
        if ( $file != '.' && $file != '..' ) {
            $path2 = $path . '/' . $file;
            if ( is_dir( $path2 ) ) {
                getfiles($path2 ,$files);
            } else {
                if ( preg_match( "/\.(php|php5)$/i" , $file ) ) {
                    $files[] = $path2;
                }
            }
        }
    }
    return $files;
}

$dirs = array('../core', '../lib', '../private');
foreach($dirs as $dirname){
    $files = getfiles($dirname);
    $br = (php_sapi_name() == "cli") ? "\n" : "<br />";
    foreach($files as $file){
      opcache_compile_file($file);
      echo $file.$br; 
    }
}