<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\mapper
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\mapper;

abstract class Mapper {
    // vars {
        
        // Composed sql strategy:
        protected $_strategy        = null;
        
        // Connection with data source:
        protected $_connection      = null;
        
        // Result set:
        protected $_results         = null;
        
        // Index column name for select:
        protected $_indexName       = null;
        
        // Additionally last insert id:
        protected $_lastInsertId    = 0;
    
    // } methods {
    
        // public {
            
            public function __construct(
                    \core\classes\connection\Connection $connection, 
                    \core\classes\sql\Strategy $strategy){
                $this->_connection = $connection;
                $this->_strategy = $strategy;
            }// end __construct
            
            public function select(){
                return $this->_doSelect();
            }// end select
            
            public function update(){
                return $this->_doUpdate();
            }// end update
            
            public function insert(){
                return $this->_doInsert();
            }// end insert
            
            public function delete(){
                return $this->_doDelete();
            }// end delete
            
            public function lastInsertId(){
                return (int)$this->_lastInsertId;
            }// end lastInsertId
            
            public function setIndexName($indexName){
                $this->_indexName = $indexName;
                return;
            }// end setIndexColumn
            
            public function setStrategy(\core\classes\sql\Strategy $strategy){
                $this->_strategy = $strategy;
            }// end setStrategy
            
            public function getStrategy(){
                return $this->_strategy;
            }// end getStrategy
            
            public function getConnection(){
                return $this->_connection;
            }// end getConnection
            
            public function setData(ResultSet $data){
                if(!is_null($this->_results))
                    unset($this->_results);
                $this->_results = $data;
            }// end setData
            
            public function &getData(){
                return $this->_results;
            }// end getData
            
            public function &getResult() {
                return $this->_results;
            }// end getResults
            
            public function getFirstRow(){
                $data = $this->getResult();
                if(!is_null($data)){
                    $iter = $data->getIterator();
                    $iter->rewind();
                    if($iter->valid()){
                        return $iter->current();
                    }
                }
                return array();
            }// end getFirstRow
            
        // } protected {
            
            abstract protected function _doSelect();
            abstract protected function _doUpdate();
            abstract protected function _doInsert();
            abstract protected function _doDelete();
            
        // } private {
            
        // }
    // }
}