<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data\collection\set
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\data\collection\set;

class File extends Set {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
        
        // } protected {
            
            protected function _getDataObject($id) {
                return \core\classes\data\Repository::get('File', $id);
            }// end _getDataObject
            
        // } private {
            
        // }
    // }
}