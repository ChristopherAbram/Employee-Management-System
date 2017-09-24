<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\domain\factory;

class Article extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\Article($id);
            }// end getById
            
            public function getByPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getByPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getByPageId
            
            public function getAvailableByPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getAvailableByPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByPageId
            
            public function getUnavailableByPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getUnavailableByPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByPageId
            
            public function getVisibleByPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getVisibleByPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getVisibleByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getVisibleByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByPageId
            
            public function getVisible($pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getVisible($pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('visible_article'), 0, $ex);
                }
                return null;
            }// end getVisible
            
            public function getVisibleWithSliderImage($pointer, $count, $width, $height){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getVisibleWithSliderImage($pointer, $count, $width, $height);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('visible_article'), 0, $ex);
                }
                return null;
            }// end getVisibleWithSliderImage
            
            public function getByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $dataSet = $factory->getByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Article(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByCommentId($id){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $data = $factory->getByCommentId($id);
                    if(!is_null($data)){
                        return new \core\classes\domain\Article(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_comment_id'), 0, $ex);
                }
                return null;
            }// end getByCommentId
            
            public function getByNamepath($namepath){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $data = $factory->getByNamepath($namepath);
                    if(!is_null($data)){
                        return new \core\classes\domain\Article(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
            
            public function getByNamepathAndByUserId($namepath, $id){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $data = $factory->getByNamepathAndByUserId($namepath, $id);
                    if(!is_null($data)){
                        return new \core\classes\domain\Article(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('article_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepathAndByUserId
            
            public function getRemovedByUserId($id){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getRemovedByUserId($id);
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\Article(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_article_by_user_id'), 0, $ex);
                }
                return null;
            }// end getRemovedByUserId
            
            public function getRemoved(){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getRemoved();
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\Article(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_article'), 0, $ex);
                }
                return null;
            }// end getRemoved
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}