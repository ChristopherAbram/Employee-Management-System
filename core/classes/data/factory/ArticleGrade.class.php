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

class ArticleGrade extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('ArticleGrade', $id);
            }// end getById
            
            public function getByUserId($id, $pointer, $count){
                /*$strategy = \core\classes\sql\StrategyFactory::getArticleByUserId();
                try {
                    $offset = ($pointer - 1) * $count;
                    return $this->_getSetById($strategy, $id, 'id', $offset, $count);
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;*/
            }// end getByUserId
            
            public function getByArticleId($id){
                /*$strategy = \core\classes\sql\StrategyFactory::getArticleByCommentId();
                try {
                    return $this->_findId($strategy, $id, 'article_id', 'Article');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_comment_id'), 0, $ex);
                }
                return null;*/
            }// end getByPageId
            
            public function getByUserAndArticleId($article_id, $user_id){
                $strategy = \core\classes\sql\StrategyFactory::getArticleGradeByUserAndArticleId();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('article_id' => $article_id, 'user_id' => $user_id)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('ArticleGrade', $found_id);
                        }
                    }
                    return null;
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('articlegrade_by_user_article_id'), 0, $ex);
                }
                return null;
            }// end getByUserAndArticleId
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Article($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}