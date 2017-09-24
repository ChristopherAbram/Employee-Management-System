<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	26.09.2016
 */

namespace core\functions;

function crop_image($path, $width, $height, $x, $y, $destformat = null){
    if(($s = @\getimagesize($path)) == false){
        return false;
    }
    $result = false;
    
    if($s[ 'mime' ] == 'image/jpeg'){
        $img = \imagecreatefromjpeg($path);
    } elseif( $s[ 'mime' ] == 'image/png' ){
        $img = \imagecreatefrompng( $path );
    } elseif( $s[ 'mime' ] == 'image/gif' ){
        $img = \imagecreatefromgif( $path );
    } elseif( $s[ 'mime' ] == 'image/xbm' ) {
        $img = \imagecreatefromxbm( $path );
    }

    if ($img &&  false != ($tmp = \imagecreatetruecolor($width, $height))){
        if(!\imagecopy($tmp, $img, 0, 0, $x, $y, $width, $height)){
            return false;
        }
        if($destformat == 'jpg'  || ($destformat == null && $s[ 'mime' ] == 'image/jpeg')){
            $result = \imagejpeg($tmp, $path, 100);
        } 
        else if($destformat == 'gif' || ($destformat == null && $s[ 'mime' ] == 'image/gif')){
            $result = \imagegif($tmp, $path, 7);
        } 
        else {
            $result = \imagepng($tmp, $path, 7);
        }
        \imagedestroy( $img );
        \imagedestroy( $tmp );

        return $result ? $path : false;
    }
    return false;
}