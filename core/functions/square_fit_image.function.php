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

function square_fit_image($path, $width, $height, $align = 'center', $valign = 'middle', $bgcolor = '#0000ff', $destformat = null){
    if(($s = @\getimagesize($path)) == false){
        return false;
    }
    $result = false;
    
    /* Coordinates for image over square aligning */
    $y = \ceil(\abs($height - $s[ 1 ]) / 2); 
    $x = \ceil(\abs($width - $s[ 0 ]) / 2);
    
    if( $s[ 'mime' ] == 'image/jpeg' ) {
        $img = \imagecreatefromjpeg( $path );
    } elseif( $s[ 'mime' ] == 'image/png' ) {
        $img = \imagecreatefrompng( $path );
    } elseif( $s[ 'mime' ] == 'image/gif' ) {
        $img = \imagecreatefromgif( $path );
    } elseif( $s[ 'mime' ] == 'image/xbm' ) {
        $img = \imagecreatefromxbm( $path );
    }
    
    if($img && false != ($tmp = \imagecreatetruecolor($width, $height))){
        
        if($bgcolor == 'transparent'){
            list($r, $g, $b) = array( 0, 0, 255 );
        } 
        else {
            list($r, $g, $b) = \sscanf($bgcolor, "#%02x%02x%02x");
        }
        
        $bgcolor1 = \imagecolorallocate($tmp, $r, $g, $b);
        
        if($bgcolor == 'transparent'){
            $bgcolor1 = \imagecolortransparent($tmp, $bgcolor1);
        }
        
        \imagefill($tmp, 0, 0, $bgcolor1);
        
        if(!\imagecopy($tmp, $img, $x, $y, 0, 0, $s[ 0 ], $s[ 1 ])){
            return false;
        }
        
        if($destformat == 'jpg' || ($destformat == null && $s[ 'mime' ] == 'image/jpeg')){
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