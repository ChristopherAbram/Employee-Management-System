<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\mapper
 * @author     Christopher Abram
 * @version    1.0
 * @date	22.08.2016
 */

namespace core\classes\mapper;

class DataMapper extends Mapper {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _doSelect(){
                if(is_null($this->_results))
                    return false;
                try {
                    $results = new ResultSet();
                    
                    // Getting select sql statement:
                    $select = $this->_strategy->getSelectStatement();
                    $sql = $select->getQuery();
                    $requiredParameters = $select->getRequiredParameters();
                    
                    // Preparation:
                    $pdo = $this->_connection->getPDO();
                    $stmt = $pdo->prepare($sql);
                    
                    if($stmt){
                        foreach($this->_results as $index => $row){
                            // Getting parameters for query execution:
                            $parameters = $this->__acuireParameters($requiredParameters, $row);
                            
                            // Executing:
                            $this->__bindValues($stmt, $parameters);
                            $exe = $stmt->execute(/*$parameters*/);
                            if($exe){
                                $tmp = new ResultSet(array(), $stmt, $this->_indexName);
                                $results->addAll($tmp);
                                unset($tmp);
                            }
                            else {
                                unset($results);
                                return false;
                            }
                        }
                        unset($this->_results);
                        $this->_results = $results;
                        unset($results);
                        return true;
                    }
                } catch(\PDOException $pdoe){
                    throw new MapperException(Error::get('select_failed'), 0, $pdoe);
                }
                return false;
            }// end _doSelect
            
            protected function _doUpdate(){
                if(is_null($this->_results))
                    return false;
                try {
                    // Getting update sql statement:
                    $update = $this->_strategy->getUpdateStatement();
                    $sql = $update->getQuery();
                    $requiredParameters = $update->getRequiredParameters();
                    
                    $pdo = $this->_connection->getPDO();
                    
                    // Execute using transaction:
                    if($pdo->beginTransaction()){
                        // Preparation:
                        $stmt = $pdo->prepare($sql);

                        if($stmt){
                            foreach($this->_results as $index => $row){
                                // Getting parameters for query execution:
                                $parameters = $this->__acuireParameters($requiredParameters, $row);
                                // Executing:
                                $this->__bindValues($stmt, $parameters);
                                $exe = $stmt->execute(/*$parameters*/);
                                if(!$exe){
                                    $info = $stmt->errorInfo();
                                    $pdo->rollBack();
                                    if(isset($info[0], $info[2]) && $info[0] != null){
                                        throw new \PDOException($info[2]);
                                    }
                                    return false;
                                }
                            }
                            return $pdo->commit();
                        }
                        else {
                            $pdo->rollBack();
                        }
                    }
                } catch(\PDOException $pdoe){
                    throw new MapperException(Error::get('update_failed'), 0, $pdoe);
                }
                return false;
            }// end _doUpdate
            
            protected function _doInsert(){
                if(is_null($this->_results))
                    return false;
                try {
                    // Getting insert sql statement:
                    $insert = $this->_strategy->getInsertStatement();
                    $sql = $insert->getQuery();
                    $requiredParameters = $insert->getRequiredParameters();
                    
                    $pdo = $this->_connection->getPDO();
                    
                    // Execute using transaction:
                    if($pdo->beginTransaction()){
                        // Preparation:
                        $stmt = $pdo->prepare($sql);

                        if($stmt){
                            foreach($this->_results as $index => $row){
                                // Getting parameters for query execution:
                                $parameters = $this->__acuireParameters($requiredParameters, $row);
                                // Executing:
                                $this->__bindValues($stmt, $parameters);
                                $exe = $stmt->execute(/*$parameters*/);
                                if(!$exe){
                                    $pdo->rollBack();
                                    return false;
                                }
                            }
                            $this->_lastInsertId = $pdo->lastInsertId();
                            return $pdo->commit();
                        }
                        else {
                            $pdo->rollBack();
                        }
                    }
                } catch(\PDOException $pdoe){
                    throw new MapperException(Error::get('insert_failed'), 0, $pdoe);
                }
                return false;
            }// end _doInsert
            
            protected function _doDelete(){
                if(is_null($this->_results))
                    return false;
                try {
                    // Getting delete sql statement:
                    $delete = $this->_strategy->getDeleteStatement();
                    $sql = $delete->getQuery();
                    $requiredParameters = $delete->getRequiredParameters();
                    
                    $pdo = $this->_connection->getPDO();
                    
                    // Execute using transaction:
                    if($pdo->beginTransaction()){
                        // Preparation:
                        $stmt = $pdo->prepare($sql);

                        if($stmt){
                            foreach($this->_results as $index => $row){
                                // Getting parameters for query execution:
                                $parameters = $this->__acuireParameters($requiredParameters, $row);
                                // Executing:
                                $this->__bindValues($stmt, $parameters);
                                $exe = $stmt->execute(/*$parameters*/);
                                if(!$exe){
                                    $pdo->rollBack();
                                    return false;
                                }
                            }
                            if($pdo->commit()){
                                unset($this->_results);
                                return true;
                            }
                        }
                        else {
                            $pdo->rollBack();
                        }
                    }
                } catch(\PDOException $pdoe){
                    throw new MapperException(Error::get('delete_failed'), 0, $pdoe);
                }
                return false;
            }// end _doDelete
            
        // } private {
            
            private function __bindValues(\PDOStatement $stmt, array $parameters){
                foreach($parameters as $parameterName => $parameterValue){
                    $type = \PDO::PARAM_STR;
                    if(\is_int($parameterValue)){
                        $type = \PDO::PARAM_INT;
                    }
                    else if(\is_bool($parameterValue)){
                        $type = \PDO::PARAM_BOOL;
                    }
                    else if(\is_resource($parameterValue) && \get_resource_type($parameterValue) == 'stream'){
                        $type = \PDO::PARAM_LOB;
                    }
                    $stmt->bindValue($parameterName, $parameterValue, $type);
                }
                return;
            }// end __bindValues
            
            private function __acuireParameters(array &$requiredParameters, array &$row){
                $parameters = array();
                foreach($requiredParameters as $parameterName => $attributeName){
                    $parameters[':'.$parameterName] = isset($row[$attributeName]) ? $row[$attributeName] : null;
                }
                return $parameters;
            }// end __acuireParameters
            
        // }
    // }
}