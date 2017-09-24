<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql;

class Strategy {
    // vars {
        
        // SQL Statements:
        protected $_selectStmt = null;
        protected $_updateStmt = null;
        protected $_insertStmt = null;
        protected $_deleteStmt = null;
        
    // } methods {
    
        // public {
            
            public function __construct(
                    \core\classes\sql\statement\select\Statement $selectStmt,
                    \core\classes\sql\statement\update\Statement $updateStmt,
                    \core\classes\sql\statement\insert\Statement $insertStmt,
                    \core\classes\sql\statement\delete\Statement $deleteStmt
                    ){
                $this->_selectStmt = $selectStmt;
                $this->_updateStmt = $updateStmt;
                $this->_insertStmt = $insertStmt;
                $this->_deleteStmt = $deleteStmt;
            }// end __construct
            
            public function setSelectStatement(\core\classes\sql\statement\select\Statement $selectStmt){
                $this->_selectStmt = $selectStmt;
                return;
            }// end setSelectStatement
            
            public function setUpdateStatement(\core\classes\sql\statement\update\Statement $updateStmt){
                $this->_updateStmt = $updateStmt;
                return;
            }// end setUpdateStatement
            
            public function setInsertStatement(\core\classes\sql\statement\insert\Statement $insertStmt){
                $this->_insertStmt = $insertStmt;
                return;
            }// end setInsertStatement
            
            public function setDeleteStatement(\core\classes\sql\statement\delete\Statement $deleteStmt){
                $this->_deleteStmt = $deleteStmt;
                return;
            }// end setDeleteStatement
            
            public function getSelectStatement(){
                return $this->_selectStmt;
            }// end getSelectStatement
            
            public function getUpdateStatement(){
                return $this->_updateStmt;
            }// end getUpdateStatement
            
            public function getInsertStatement(){
                return $this->_insertStmt;
            }// end getInsertStatement
            
            public function getDeleteStatement(){
                return $this->_deleteStmt;
            }// end getDeleteStatement
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}