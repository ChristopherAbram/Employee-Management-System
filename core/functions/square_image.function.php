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

function square_image($path, $width, $destformat = null){
    if(($s = @\getimagesize($path)) == false){
        return false;
    }
    $result = false;
    list($orig_w, $orig_h) = array($s[ 0 ], $s[ 1 ]);

    /* Calculating image scale width and height */
    $scale = $orig_w / $orig_h;

    if($scale > 1){
        $size_w = $width * $scale;
        $size_h = $width;
        $_x = - \ceil(($size_w - $width) / 2);
        $_y = 0;
    } 
    else {
        $size_w = $width;
        $size_h = $width * (1 / $scale);
        $_x = 0;
        $_y = - \ceil(($size_h - $width) / 2);
    }
		
    $size_w = \ceil($size_w);
    $size_h = \ceil($size_h);
    
    if( $s[ 'mime' ] == 'image/jpeg' ){
        $img = \imagecreatefromjpeg( $path );
    } elseif( $s[ 'mime' ] == 'image/png' ) {
        $img = \imagecreatefrompng( $path );
    } elseif( $s[ 'mime' ] == 'image/gif' ) {
        $img = \imagecreatefromgif( $path );
    } elseif( $s[ 'mime' ] == 'image/xbm' ) {
        $img = \imagecreatefromxbm( $path );
    }
    
    if($img &&  (false != ($tmp = \imagecreatetruecolor($width, $width)))){
        
        if(!\imagecopyresampled($tmp, $img, $_x, $_y, 0, 0, $size_w, $size_h, $s[ 0 ], $s[ 1 ])){
            return false;
        }
        if($destformat == 'jpg' || ($destformat == null && $s[ 'mime' ] == 'image/jpeg')){
            $result = \imagejpeg($tmp, $path, 95);
        } 
        else if($destformat == 'gif' || ($destformat == null && $s[ 'mime' ] == 'image/gif')){
            $result = \imagegif($tmp, $path, 7);
        } 
        else {
            $result = \imagepng($tmp, $path, 7);
        }
        
        \imagedestroy($img);
        \imagedestroy($tmp);

        return $result ? $path : false;
    }
    return false;
}