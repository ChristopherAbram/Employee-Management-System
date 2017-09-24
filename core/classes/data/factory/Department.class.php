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

class Department extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getById($id){
                return $this->_getDataObject('Department', $id);
            }// end getById
            
            public function getByNamepath($namepath){
                $strategy = \core\classes\sql\StrategyFactory::getDepartmentByNamepath();
                try {
                    $mapper = \core\classes\mapper\factory\DataMapper::getUserStandard($strategy);
                    $data = new \core\classes\mapper\ResultSet(array(array('namepath' => $namepath)));
                    $mapper->setData($data);
                    if($mapper->select()){
                        $data = $mapper->getFirstRow();
                        if(array_key_exists('id', $data)){
                            $found_id = $data['id'];
                            return $this->_getDataObject('Department', $found_id);
                        }
                    }
                return null;
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('department_by_namepath'), 0, $ex);
                }
                return null;
            }// end getByNamepath
            
            public function getAll($pointer, $count){
                $strategy = \core\classes\sql\StrategyFactory::getAllDepartments();
                try {
                    $offset = ($pointer - 1) * $count;
                    $data = array(
                        'offset' => $offset,
                        'count'  => $count
                    );
                    return $this->_getSetByData($strategy, $data, 'id');
                } catch (\core\classes\mapper\MapperException $ex) {
                    throw new \core\classes\data\DataException(Error::get('article_by_page_id'), 0, $ex);
                }
                return null;
            }// end getAll
            
            public static function namepathExists($namepath){
                $factory = new self();
                $dep = $factory->getByNamepath($namepath);
                if(!is_null($dep)){
                    return $dep->getID();
                }
                return null;
            }// end namepathExists
        
        // } protected {
            
            protected function _getSet(array $ids = array()) {
                return new \core\classes\data\collection\set\Department($ids);
            }// end _getSet
            
        // } private {
            
        // }
    // }
}