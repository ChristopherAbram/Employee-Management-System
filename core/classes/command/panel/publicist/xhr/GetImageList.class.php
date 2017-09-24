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

class GetImageList extends GetFileList {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _load_file_list($page, $count){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    $factory = new \core\classes\domain\factory\File();
                    if(!is_null($User)){
                        $set = $factory->getImagesByUserId($User->getID(), $page, $count);
                        if(!is_null($set)){
                            $set->load(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'name', 'extension'
                            )));
                            foreach($set as $file){
                                $this->_list[] = &$file->getPresentationData();
                            }
                        }
                    }
                } catch (\core\classes\domain\DomainException $ex) {}
            }// end _load_comment_list
            
        // } private {
            
            
            
        // }
    // }
}