<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\panel\publicist\xhr;

class NextImagePageExists extends NextFilePageExists {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _count($page, $count){
                $all = 0;
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(!is_null($User)){
                        $all = (int)\core\classes\data\FileInfo::countImagesByUserId($User->getID());
                    }
                } catch (\core\classes\data\DataException $ex) {}
                return ($all - (($page - 1) * $count));
            }// end _count
            
        // } private {
            
            
            
        // }
    // }
}