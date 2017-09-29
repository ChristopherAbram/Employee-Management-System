<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\filter
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2017
 */

namespace core\classes\filter;

abstract class Filter {
    // vars {
    
        private			$_mode = null;
        private			$_id = null;
        private			$_names = null;
        private			$_SQLExp = null;
        private			$_secondSQLExp = null;
        private			$_amount = 50;
        protected		$_optionsList = array( );
        private			$_active = array( );
        private			$_distinct = false;
        protected		$_SQLs = array( 'SELECT $columns$ FROM $tables$ WHERE $conditions$ ORDER BY $column$ $how$ LIMIT $position$, $amount$;',
                                                                        'SELECT DISTINCT $column$ AS value FROM $tables$ WHERE $conditions$ ORDER BY $column$ ASC LIMIT $amount$;' );
        protected 		$_group = true;
        
        // constans {
        
        const A_Z = 0;
        const Z_A = 1;
        const ON = 1;
        const OFF = 0;
        const CONJUCTION = '_';
        const _CLASS = 'class';
        const _NAME = 'name';
        const _VALUE = 'value';
        const _COND = 'cond';
        const _SORT = 'sort';
        const _INPUT = 'input';
        const _LOGIC = 'logic';
        const _OPTIONS = 'options';
        const _SUBMIT = 'submit';
        const _INPUTS = 'inputs';
        const _REMOVE_SORT = 'removeSort';
        const _REMOVE_COND = 'removeCond';
        const PREFIX = 'filter_';
        
        // }
        
    // } methods {
        public function __construct( $mode, $id ){
                $this->_mode = $mode;
                $this->_id = $id;
        }// end __construct
        final public function setExecMode( $mode ){
                $this->_mode = $mode;
                return $this;
        }// end setExecMode
        final public function getExecMode( ){
                return $this->_mode;
        }// end getExecMode
        final public function setID( $id ){
                $this->_id = $id;
                return $this;
        }// ens setID
        final public function getID( ){
                return $this->_id;
        }// end getID
        final public function setSQLExp( $SQLExp ){
                $this->_SQLExp = $SQLExp;
                return $this;
        }// end setSQLExp
        final public function getSQLExp( ){
                return $this->_SQLExp;
        }// end getSQLExp
        final public function setSecondSQLExp( $SQLExp ){
                $this->_secondSQLExp = $SQLExp;
                return $this;
        }// end setSQLExp
        final public function getSecondSQLExp( ){
                return $this->_secondSQLExp;
        }// end getSQLExp
        final public function getSQLs( ){
                return $this->_SQLs;
        }// end getSQLs
        final public function getIndexes( ){
                return static::$_inX;
        }// end getIndexes
        final public function setActiveFilters( $id, $filter ){
                $this->_active[ $id ] = $filter;
                return $this;
        }// end setActiveFilters
        final public function activeFilters( ){
                return $this->_active;
        }// end activeFilters
        final public function setGroupExp( $logical ){
                $this->_group = $logical;
                return $this;
        }// end setGroupExp
        final public function groupExp( ){
                return $this->_group;
        }// end groupExp
        final public function setOptionsList( array $options ){
                $this->_optionsList = $options;
                return $this;
        }// end setOptionsList

        final public function setOptionsListAmount( $amount ){
                $this->_amount = $amount;
                return $this;
        }// end setOptionsListAmount

        final public function optionsListAmount( ){
                return $this->_amount ;
        }// end setOptionsListAmount

        final public function setDistinct( $bool ){
                $this->_distinct = $bool;
                return $this;
        }// end setDistinct

        final public function distinct( ){
                return $this->_distinct;
        }// end distinct

        public function getOptionsList( $process = true ){
            $q = array( );
            foreach( $this->_optionsList as $g ){
                $ind = preg_replace( '/[\.,-\s]/i', '', $g[ 'value' ] );
                $q[ $ind ] = $g;
            }
            $this->_optionsList = $q;
            unset( $q );
            if( $process ){
                if( !isset( $_SESSION[ self::_OPTIONS ] ) || !isset( $_SESSION[ self::_OPTIONS ][ $this->_id ] ) ){
                    foreach( $this->_optionsList as $id => $option ){
                        $this->_optionsList[ $id ][ 'checked' ] = 'checked="checked"';
                    }
                } else {
                    foreach( $this->_optionsList as $id => $option ){
                        if( isset( $_SESSION[ self::_OPTIONS ][ $this->_id ][ $id ] ) ){
                            $this->_optionsList[ $id ][ 'checked' ] = 'checked="checked"';
                        } else $this->_optionsList[ $id ][ 'checked' ] = '';
                    }
                }
            }

            return $this->_optionsList;
        }// end setOptionsList
        
        abstract public function prepareSQL( );
        
    // }
} 