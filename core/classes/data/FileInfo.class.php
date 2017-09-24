<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date       24.08.2016
 */

namespace core\classes\data;

class FileInfo extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'name', 'description', 'size', 'mtime', 'cdate', 'mime', 'read',
            'write', 'locked', 'hide', 'bin', 'width', 'height', 'extension', 'user_id'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'name', 'description', 'size', 'mtime', 'cdate', 'mime', 'read',
            'write', 'locked', 'hide', 'bin', 'width', 'height', 'extension', 'user_id'
        );
        
        // Table name:
        protected $_tableName               = 'file_info';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting FileInfo statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getFileInfo($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getFileCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function countNotRemoved(){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedFileCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getFileCountByUserId();
                return self::_count($strategy, array('id' => $id));
            }// end countByPage
            
            public static function countImagesByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getImageCountByUserId();
                return self::_count($strategy, array('id' => $id));
            }// end countImagesByUserId
            
            public static function countNotRemovedByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getNotRemovedFileCountByUserId();
                return self::_count($strategy, array('id' => $id));
            }// end countByPage
            
            public static function remove(){
                $strategy = \core\classes\sql\StrategyFactory::getRemoveMovedFiles();
                return self::_remove($strategy, array());
            }// end remove
            
            public static function restore(){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllFiles();
                return self::_restore($strategy, array());
            }// end restore
            
            public static function removeByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRemoveMovedFilesByUserId();
                return self::_remove($strategy, array('id' => $id));
            }// end remove
            
            public static function restoreByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getRestoreAllFilesByUserId();
                return self::_restore($strategy, array('id' => $id));
            }// end restore
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}