<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date       07.11.2016
 */

namespace core\classes\data;

class UserPage extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'page_id'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'page_id'
        );
        
        // Table name:
        protected $_tableName               = 'user_page';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting UserPage statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getUserPage($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                //$strategy = \core\classes\sql\StrategyFactory::getArticleVisitCount();
                //return self::_count($strategy, array());
            }// end count
            
            public static function deleteByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getUserPageByUserId();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('user_id' => $id)));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('delete'), 0, $ex);
                }
                return null;
            }// end deleteByUserId
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}