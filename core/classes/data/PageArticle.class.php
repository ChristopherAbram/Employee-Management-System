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

class PageArticle extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'page_id', 'article_id'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'page_id', 'article_id'
        );
        
        // Table name:
        protected $_tableName               = 'page_article';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting PageArticle statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getPageArticle($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function deleteByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getPageArticleByArticleId();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('id' => $id)));
                    $mapper->setData($data);
                    if($mapper->delete()){
                        return true;
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('delete'), 0, $ex);
                }
                return false;
            }// end deleteByArticleId
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}