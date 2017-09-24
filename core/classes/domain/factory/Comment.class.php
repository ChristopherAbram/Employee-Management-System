<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.08.2016
 */

namespace core\classes\domain\factory;

class Comment extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\Comment($id);
            }// end getById
            
            public function getByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Comment();
                    $dataSet = $factory->getByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Comment(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('comment_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getNotHiddenAndNotRemovedByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Comment();
                    $dataSet = $factory->getNotHiddenAndNotRemovedByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Comment(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('comment_by_article_id'), 0, $ex);
                }
                return null;
            }// end getNotHiddenAndNotRemovedByArticleId
            
            public function getByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Comment();
                    $dataSet = $factory->getByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Comment(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('comment_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}