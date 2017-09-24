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

class ArticleGrade extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'article_id', 'value', 'cdate'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'article_id', 'value', 'cdate'
        );
        
        // Table name:
        protected $_tableName               = 'article_grade';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting ArticleGrade statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getArticleGrade($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeCount();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeCountByArticleId();
                return self::_count($strategy, array('id' => $id));
            }// end countByArticleId
            
            public static function countByUserAndArticleId($article_id, $user_id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeCountByUserAndArticleId();
                return self::_count($strategy, array('article_id' => $article_id, 'user_id' => $user_id));
            }// end countByUserId
            
            public static function getAverage(){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeAverage();
                return self::_avg($strategy, array());
            }// end getAverage
            
            public static function getAverageByArticleId($id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeAverageByArticleId();
                return self::_avg($strategy, array('id' => $id));
            }// end getAverageByArticleId
            
        // } protected {
            
            protected static function _avg(\core\classes\sql\Strategy $strategy, $params){
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array($params));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('average', $data)){
                            $avg = (float)$data['average'];
                            return $avg;
                        }
                    }
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new DataException(Error::get('average'), 0, $ex);
                }
                return null;
            }// end _count
            
        // } private {
            
            
            
        // }
    // }
}