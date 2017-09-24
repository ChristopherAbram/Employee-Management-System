<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\mapper
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.08.2016
 */

namespace core\classes\mapper;

class ResultSet extends \ArrayObject {
    // vars {
        
        protected $_indexColumn;
        
        const PARAM_INT = 1;
        const PARAM_STR = 2;
        const PARAM_REAL = 3;
        
        protected $_flag;
        protected $_group = false;
        
    // } methods {
    
        // public {
            
            public function __construct(
                            array $array = array(), 
                            \PDOStatement $pdoStmt = null, 
                            $index = null, 
                            $flag = self::PARAM_STR,
                            $group = false){
                parent::__construct($array);
                $this->_indexColumn = $index;
                $this->_flag = $flag;
                $this->_group = $group;
                $this->_init_with_pdostatement($pdoStmt);
            }// end __construct
            
            public function add($index, $value, $group = false){
                if($group === true){
                    $this[$index][] = $value;
                }
                else {
                    $this[$index] = $value;
                }
                return;
            }// end add
            
            public function addAll(ResultSet $set, $group = false){
                foreach($set as $index => $value){
                    $this->add($index, $value, $group);
                }
                return;
            }// end addAll
            
            public function get($index){
                if(isset($this[$index])){
                    return $this[$index];
                }
                return null;
            }// end get
            
            public function isEmpty(){
                return $this->count() == 0;
            }// end isEmpty
            
            public function group($group = null){
                if(is_null($group)){
                    return $this->_group;
                }
                $this->_group = $group;
            }// end group
            
            public function clear(){
                foreach($this as $index => $value){
                    unset($this[$index]);
                }
                return;
            }// end clear
    
        // } protected {
        
            protected function _init_with_pdostatement(\PDOStatement $pdoStmt = null){
                if(is_null($pdoStmt)){
                    return;
                }
                $index = $this->_indexColumn === '' ? NULL : $this->_indexColumn;
                $i = 0;
                while( $row = $pdoStmt->fetch(\PDO::FETCH_ASSOC)){
                    if(is_array($row) && !is_null($index) && isset($row[$index])){
                        if($this->_flag == self::PARAM_INT){
                            $this->add((int)$row[$index], $row, $this->_group);
                        }
                        else if($this->_flag == self::PARAM_STR){
                            $this->add((string)$row[$index], $row, $this->_group);
                        }
                        else if($this->_flag == self::PARAM_REAL){
                            $this->add((float)$row[$index], $row, $this->_group);
                        }
                    }
                    else if(is_array($row)){
                        $this->add($i, $row);
                    } 
                    else {
                        throw new MapperException(Error::get('db_fetch_error'));
                    }
                    ++$i;
                }
                $pdoStmt->closeCursor();
                return;
            }// end _init_with_pdostatement
    
        // } private {
            
        // }
    // }
}