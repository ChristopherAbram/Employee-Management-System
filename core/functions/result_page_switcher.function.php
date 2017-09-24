<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	25.09.2016
 */

namespace core\functions;

function result_page_switcher($current, $count, $link, $max = 10){
    $html = '';
    // Prev:
    if($current > 1){
        $html .= '<a href="'.$link.'/'.($current - 1).'">&lt;</a>';
    }
    else {
        $html .= '<span>&lt;</span>';
    }
    if($count <= $max){
        for($i = 1; $i <= $count; ++$i){
            $html .= '<a href="'.$link.'/'.$i.'"'.($i == $current ? ' class="current"' : '').'>'.$i.'</a>';
        }
    }
    else {
        if($current < $max){
            for($i = 1; $i <= ($max - 1); ++$i){
                $html .= '<a href="'.$link.'/'.$i.'"'.($i == $current ? ' class="current"' : '').'>'.$i.'</a>';
            }
            $html .= '<span>...</span>';
            $html .= '<a href="'.$link.'/'.$count.'">'.$count.'</a>';
        }
        else if($current > ($count - $max)){
            $html .= '<a href="'.$link.'/1">1</a>';
            $html .= '<span>...</span>';
            for($i = ($count - $max + 1); $i <= $count; ++$i){
                $html .= '<a href="'.$link.'/'.$i.'"'.($i == $current ? ' class="current"' : '').'>'.$i.'</a>';
            }
        }
        else {
            $html .= '<a href="'.$link.'/1">1</a>';
            $html .= '<span>...</span>';
            for($i = (int)($current - \ceil(($max - 2)/2)); $i <= (int)($current + \ceil(($max - 2)/2)); ++$i){
                $html .= '<a href="'.$link.'/'.$i.'"'.($i == $current ? ' class="current"' : '').'>'.$i.'</a>';
            }
            $html .= '<span>...</span>';
            $html .= '<a href="'.$link.'/'.$count.'">'.$count.'</a>';
        }
    }
    // Next:
    if(($current < $count) && ($count > 1)){
        $html .= '<a href="'.$link.'/'.($current + 1).'">&gt;</a>';
    }
    else {
        $html .= '<span>&gt;</span>';
    }
    return $html;
}