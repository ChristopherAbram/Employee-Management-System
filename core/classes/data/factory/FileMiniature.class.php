<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\data\factory;

class FileMiniature extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('FileMiniature', $id);
            }// end getById
            
            public function getByFileInfoId($id){
                $strategy = \core\classes\sql\StrategyFactory::getFileMiniatureByFileInfoId();
                try {
                    return $this->_findId($strategy, $id, 'id', 'FileMiniature');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('file_miniature_by_file_info_id'), 0, $ex);
                }
                return null;
            }// end getByFileInfoId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\FileMiniature($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}