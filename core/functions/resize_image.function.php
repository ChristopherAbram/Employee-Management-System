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

function resize_image($path, $width, $height, $keepProportions = false, $resizeByBiggerSide = true, $destformat = null){
    if(($s = @\getimagesize($path)) == false){
        return false;
    }
    $result = false;
    list( $size_w, $size_h ) = array( $width, $height );
    if($keepProportions == true){
        list( $orig_w, $orig_h, $new_w, $new_h ) = array( $s[ 0 ], $s[ 1 ], $width, $height );

        /* Calculating image scale width and height */
        $xscale = $orig_w / $new_w;
        $yscale = $orig_h / $new_h;

        /* Resizing by biggest side */
        if ($resizeByBiggerSide) {
            if( $orig_w > $orig_h ){
                $size_h = $orig_h * $width / $orig_w;
                $size_w = $width;
            }
            else {
                $size_w = $orig_w * $height / $orig_h;
                $size_h = $height;
            }
        } 
        else {
            if( $orig_w > $orig_h ){
                $size_w = $orig_w * $height / $orig_h;
                $size_h = $height;
            } 
            else {
                $size_h = $orig_h * $width / $orig_w;
                $size_w = $width;
            }
        }
    }
    if( $s[ 'mime' ] == 'image/jpeg' ){
        $img = \imagecreatefromjpeg( $path );
    } else if( $s[ 'mime' ] == 'image/png' ) {
        $img = \imagecreatefrompng( $path );
    } else if( $s[ 'mime' ] == 'image/gif' ) {
        $img = \imagecreatefromgif( $path );
    } else if( $s[ 'mime' ] == 'image/xbm' ) {
        $img = \imagecreatefromxbm( $path );
    }

    if($img &&  false != ($tmp = imagecreatetruecolor($size_w, $size_h))){
        if(!\imagecopyresampled($tmp, $img, 0, 0, 0, 0, $size_w, $size_h, $s[ 0 ], $s[ 1 ])){
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
        \imagedestroy($img);
        \imagedestroy($tmp);

        return $result ? $path : false;
    }
    return false;
}