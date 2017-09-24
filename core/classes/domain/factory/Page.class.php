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

class Page extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return new \core\classes\domain\Page($id);
            }// end getById
            
            public function getByUserId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getByUserId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_user_id'), 0, $ex);
                }
                return null;
            }// end getByUserId
            
            public function getByChildPageId($id){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $data = $factory->getByChildPageId($id);
                    if(!is_null($data)){
                        return new \core\classes\domain\Page(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_child_id'), 0, $ex);
                }
                return null;
            }// end getByChildPageId
            
            public function getByParentPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getByParentPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_parent_id'), 0, $ex);
                }
                return null;
            }// end getByParentPageId
            
            public function getAvailableByParentPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getAvailableByParentPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_parent_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByParentPageId
            
            public function getUnavailableByParentPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getUnavailableByParentPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_parent_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByParentPageId
            
            public function getVisibleByParentPageId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getVisibleByParentPageId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_parent_id'), 0, $ex);
                }
                return null;
            }// end getVisibleByParentPageId
            
            public function getByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getByArticleId
            
            public function getAvailableByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getAvailableByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getAvailableByArticleId
            
            public function getUnavailableByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getUnavailableByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByArticleId
            
            public function getVisibleByArticleId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getVisibleByArticleId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_article_id'), 0, $ex);
                }
                return null;
            }// end getUnavailableByArticleId
            
            public function getAllAvailableByPublicistId($id, $pointer, $count){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $dataSet = $factory->getAllAvailableByPublicistId($id, $pointer, $count);
                    if(!is_null($dataSet)){
                        return new \core\classes\domain\collection\set\Page(array(), $dataSet);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_user_id'), 0, $ex);
                }
                return null;
            }// end getAllAvailableByPublicistId
            
            public function getByNamepath($namepath){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $data = $factory->getByNamepath($namepath);
                    if(!is_null($data)){
                        return new \core\classes\domain\Page(null, $data);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('page_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
            
            public function getRoot(){
                return $this->getById(1);
            }// end getRoot
            
            public function getRemoved(){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $set = $factory->getRemoved();
                    if(!is_null($set)){
                        return new \core\classes\domain\collection\set\Page(array(), $set);
                    }
                } catch (\core\classes\data\DataException $ex) {
                    throw new \core\classes\domain\DomainException(Error::get('removed_pages'), 0, $ex);
                }
                return null;
            }// end getRemoved
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}