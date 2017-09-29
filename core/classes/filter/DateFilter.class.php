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

class DateFilter extends Filter {
    // vars {
    
        protected static    $_inX = array( self::_SORT	 	=> array( 'sortSN', 'sortNS' ),
                                           self::_COND 		=> array( 'equals', 'notequals', 'isafter', 'isafterorequal', 'isbefore', 
                                                                                                  'isbeforeorequal', 'beginsfrom', 'notbeginsfrom', 'endsat', 'notendsat',
                                                                                                  'contains', 'notcontains' ),
                                           self::_LOGIC 	=> array( 'and', 'or' ),
                                           self::_INPUTS 	=> array( 'input1', 'input2' ) );
    // } methods {

        private function transformInput( $input ){
            $input = trim( $input );
            $input = htmlspecialchars( $input );
            if( !get_magic_quotes_gpc( ) ) $input = addslashes( $input );
            $input = preg_replace( '/\?/i', '.', $input );
            $input = preg_replace( '/\*/i', '.*', $input );
            return $input;
        }// end transformInput

        protected function alphabeticSort( $name, $flag = self::A_Z ){
            if( isset( $_SESSION[ self::_SORT ] ) && $_SESSION[ self::_SORT ] == $name ){
                if( $flag == self::A_Z ) $how = 'ASC';
                elseif( $flag == self::Z_A ) $how = 'DESC';
                $exec = $this->getExecMode( );
                $this->setSQLExp( preg_replace( '/\$column/i', $exec->getColumn( ), $this->getSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$how/i', $how, $this->getSQLExp( ) ) );
            }
        }// end alphabeticSort

        protected function equal( $name, $flag = self::ON ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){	
                    if( $flag == self::ON ) $sign = 'REGEXP';
                    elseif( $flag == self::OFF ) $sign = 'NOT REGEXP';
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    $input = $this->transformInput( $input );
                    // } 
                    $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \'^'.$input.'$\' $conditions', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \'^'.$input.'$\' $conditions', $this->getSecondSQLExp( ) ) );
                }
                $i++;
            }
        }// end equal

        protected function isAfter( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' > \''.$input.'\' $conditions', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' > \''.$input.'\' $conditions', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isGreaterThan

        protected function isAfterOrEqual( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' >= \''.$input.'\' $conditions', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' >= \''.$input.'\' $conditions', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isGreaterThanOrEqual

        protected function isBefore( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' < \''.$input.'\' $conditions', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' < \''.$input.'\' $conditions', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isLessThan

        protected function isBeforeOrEqual( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' <= \''.$input.'\' $conditions', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' <= \''.$input.'\' $conditions', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isLessThanOrEqual

        protected function beginsFrom( $name, $flag = self::ON ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){	
                    if( $flag == self::ON ) $sign = 'REGEXP';
                    elseif( $flag == self::OFF ) $sign = 'NOT REGEXP';
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    $input = $this->transformInput( $input );
                    $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \'^'.$input.'\' $conditions', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \'^'.$input.'\' $conditions', $this->getSecondSQLExp( ) ) );
                }
                $i++;
            }
        }// end beginsFrom

        protected function endsAt( $name, $flag = self::ON ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){	
                    if( $flag == self::ON ) $sign = 'REGEXP';
                    elseif( $flag == self::OFF ) $sign = 'NOT REGEXP';
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    $input = $this->transformInput( $input );
                    $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \''.$input.'$\' $conditions', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \''.$input.'$\' $conditions', $this->getSecondSQLExp( ) ) );
                }
                $i++;
            }
        }// end endsAt

        protected function contains( $name, $flag = self::ON ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){	
                    if( $flag == self::ON ) $sign = 'REGEXP';
                    elseif( $flag == self::OFF ) $sign = 'NOT REGEXP';
                    $exec = $this->getExecMode( );
                    // input {
                        $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                        $input = $this->transformInput( $input );
                    $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \''.$input.'\' $conditions', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.$sign.' \''.$input.'\' $conditions', $this->getSecondSQLExp( ) ) );
                }
                $i++;
            }
        }// end contains

        protected function logicalConjuction( $operator ){
            if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_LOGIC ] ) &&
                $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_LOGIC ] == $operator ){
                if( ( isset( $_SESSION[ Filter::_COND ][ $this->getID( ) ][ Filter::_NAME.'1' ] ) ||
                    isset( $_SESSION[ Filter::_COND ][ $this->getID( ) ][ Filter::_NAME.'2' ] ) ) ){
                    if( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.'1' ] != '' && $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.'2' ] != '' ){
                        $this->setSQLExp( preg_replace( '/\$conditions/i', $operator.' $conditions', $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions/i', $operator.' $conditions', $this->getSecondSQLExp( ) ) );
                    }
                }
            }
        }// end logicalConjuction

        protected function optionsList( ){
            if( isset( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] ) && !empty( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] ) ){
                //$v = array( );
                //foreach( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] as $val ) $v[ ] = '\''.$val.'\'';
                //$values = implode( ', ', $v );
                global $DBVARS;
                $dbs = databaseOperations::getInstance( );
                $db = $dbs->chooseDatabase( $DBVARS[ DB_NAME ] );
                $exec = $this->getExecMode( );
                if( $exec instanceof dbMode ){
                    $table = $exec->getTable( );
                    $column = $exec->getColumn( );
                    $q = $db->prepare( 'SELECT DISTINCT YEAR('.$column.') FROM '.$table.';' );
                    $q->execute();
                    $r = databaseOperations::createTable( $q );
                }
                $string = array( );
                if( isset( $r ) && is_array( $r ) && sizeof( $r ) > 0 ){
                    foreach( $r as $k => $row ){
                        $b = Functions::separateId( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ], array( $row[ 0 ] ) );
                        if( isset( $b[ 0 ] ) && !empty( $b[ 0 ] ) ){
                            $s = implode( '|', $b[ 0 ] );
                            $string[ ] = 'REGEXP \'^'.$row[ 0 ].'-('.$s.').*\'';
                        }
                    }
                    $this->setSQLExp( preg_replace( '/\$conditions/i', $exec->getColumn( ).' '.implode( ' or ', $string ).' $conditions', $this->getSQLExp( ) ) );
                }
            }
        }// end optionsList

        public function prepareSQL( ){
            // the alphabetic sorting {
            $this->alphabeticSort( $this->getID( ).self::CONJUCTION.self::$_inX[ self::_SORT ][ 0 ], self::A_Z );
            $this->alphabeticSort( $this->getID( ).self::CONJUCTION.self::$_inX[ self::_SORT ][ 1 ], self::Z_A );
            // } first part {
            // grouping syntax
            if( $this->groupExp( ) ){ 
                $this->setSecondSQLExp( preg_replace( '/\$conditions/i', '( $conditions', $this->getSecondSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$conditions/i', '( $conditions', $this->getSQLExp( ) ) );
            }
            $this->equal( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 0 ] );
            $this->equal( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 1 ], self::OFF );
            $this->isAfter( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 2 ] );
            $this->isAfterOrEqual( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 3 ] );
            $this->isBefore( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 4 ] );
            $this->isBeforeOrEqual( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 5 ] );
            $this->beginsFrom( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 6 ], self::ON );
            $this->beginsFrom( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 7 ], self::OFF );
            $this->endsAt( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 8 ], self::ON );
            $this->endsAt( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 9 ], self::OFF );
            $this->contains( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 10 ], self::ON );
            $this->contains( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 11 ], self::OFF );
            // } logical operator {
                $this->logicalConjuction( self::$_inX[ self::_LOGIC ][ 0 ] );
                $this->logicalConjuction( self::$_inX[ self::_LOGIC ][ 1 ] );
            // } second part {
            $this->equal( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 0 ] );
            $this->equal( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 1 ], self::OFF );
            $this->isAfter( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 2 ] );
            $this->isAfterOrEqual( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 3 ] );
            $this->isBefore( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 4 ] );
            $this->isBeforeOrEqual( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 5 ] );
            $this->beginsFrom( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 6 ], self::ON );
            $this->beginsFrom( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 7 ], self::OFF );
            $this->endsAt( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 8 ], self::ON );
            $this->endsAt( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 9 ], self::OFF );
            $this->contains( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 10 ], self::ON );
            $this->contains( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 11 ], self::OFF );

            // } list {
            $this->optionsList( );
            // grouping syntax
            if( $this->groupExp( ) ){
                $this->setSecondSQLExp( preg_replace( '/\$conditions/i', ') $conditions', $this->getSecondSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$conditions/i', ') $conditions', $this->getSQLExp( ) ) );
            }	
            // }
        }// end prepareSQL

        public function getOptionsList( $process = true ){
            global $MONTHS;
            $q = array( );
            foreach( $this->_optionsList as $g ){
                $ind = preg_replace( '/[\.,-\s]/i', '', $g[ 'value' ] );
                $q[ $ind ] = $g;
                $a = array( );
                foreach( $MONTHS as $m => $v ){
                    $a[ $m ][ 'value' ] = $v;
                }
                $q[ $ind ][ 'months' ] = $a;
            }

            $this->_optionsList = $q;
            if( $process ){
                if( !isset( $_SESSION[ self::_OPTIONS ] ) || !isset( $_SESSION[ self::_OPTIONS ][ $this->getID() ] ) ){
                    foreach( $this->_optionsList as $id => $option ){
                        foreach( $option[ 'months' ] as $m => $v ){
                            $this->_optionsList[ $id ][ 'months' ][ $m ][ 'checked' ] = 'checked="checked"';
                        }
                        $this->_optionsList[ $id ][ 'checked' ] = 'checked="checked"';
                    }
                } else {
                    foreach( $this->_optionsList as $id => $option ){
                        $a = array( );
                        $a = Functions::separateId( $_SESSION[ self::_OPTIONS ][ $this->getID() ], array( $id ) );

                        if( isset( $a[ 0 ] ) && !empty( $a[ 0 ] ) ){

                            foreach( $option[ 'months' ] as $m => $v ){
                                $this->_optionsList[ $id ][ 'months' ][ $m ][ 'checked' ] = '';
                                if( in_array( $m, $a[ 0 ] ) )
                                    $this->_optionsList[ $id ][ 'months' ][ $m ][ 'checked' ] = 'checked="checked"';
                            }
                        }
                    }
                }
            }
            return $this->_optionsList;
        }// end setOptionsList*/
        
    // }
}