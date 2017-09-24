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

class Department extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'namepath', 'name', 'description', 'city',
            'zip', 'street', 'house', 'flat'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'namepath', 'name', 'description', 'city',
            'zip', 'street', 'house', 'flat'
        );
        
        // Table name:
        protected $_tableName               = 'department';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting department statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getDepartment($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public function bin(){
                try {
                    $strategy = \core\classes\sql\StrategyFactory::getArticleBinOperations();
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $this->_id)));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('bin'), 0, $ex);
                }
                return false;
            }// end bin
            
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getCountDepartment();
                return self::_count($strategy, array());
            }// end count
            
            public static function remove(){
                $strategy = \core\classes\sql\StrategyFactory::getRemoveMovedArticles();
                return self::_remove($strategy, array());
            }// end remove
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}