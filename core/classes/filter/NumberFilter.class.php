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

class NumberFilter extends Filter {
    // vars {
        
        protected static    $_inX = array( self::_SORT	 	=> array( 'sortLS', 'sortSL' ),
                                           self::_COND 		=> array( 'equals', 'notequals', 'isgreaterthan', 'isgreaterthanorequal', 'islessthan', 
                                                                                                  'islessthanorequal', 'beginsfrom', 'notbeginsfrom', 'endsat', 'notendsat',
                                                                                                  'contains', 'notcontains' ),
                                           self::_LOGIC 	=> array( 'and', 'or' ),
                                           self::_INPUTS 	=> array( 'input1', 'input2' ) );
        private				$_ratio = 1;
        private				$_precision = 2;
        const GT = 'gt';
        const LT = 'lt';
        const GTE = 'gte';
        const LTE = 'lte';
        
    // } methods {
        
        private function subsForGTLT_E( $input, $flag = self::GT ){
            $input = trim( $input );
            $input = htmlspecialchars( $input );
            if( strlen( $input ) > 0 ){
                    if( !preg_match( '/^[0-9\?\*]*[\.\,]?[0-9\?\*]*$/i', $input ) ){
                            Informer::throwInfo( 'Invalid string for the number filter. Must be numbers.', Informer::INFO );
                    }
            }
            $input = preg_replace( '/[\,\.]/i', '.', $input );
            if( !get_magic_quotes_gpc( ) ) $input = addslashes( $input );
            $input = preg_replace( '/\*/i', '', $input );
            if( $flag == self::GT ){
                    $input = preg_replace( '/\?/i', '9', $input );
            } elseif( $flag == self::GTE ){
                    $input = preg_replace( '/\?/i', '0', $input );
            } elseif( $flag == self::LT ){
                    $input = preg_replace( '/\?/i', '0', $input );
            } elseif( $flag == self::LTE ){
                    $input = preg_replace( '/\?/i', '9', $input );
            }
            return $input;
        }// end subsForGTLT_E

        private function transformInput( $input ){
            $input = trim( $input );
            $input = htmlspecialchars( $input );
            if( strlen( $input ) > 0 ){
                    if( !preg_match( '/^[0-9\?\*]*[\.\,]?[0-9\?\*]*$/i', $input ) ){
                            Informer::throwInfo( 'Invalid string for the number filter. Must be numbers.', Informer::INFO );
                    }
            }
            $input = preg_replace( '/[\,\.]/i', '\\.', $input );
            if( !get_magic_quotes_gpc( ) ) $input = addslashes( $input );
            $input = preg_replace( '/\?/i', '.', $input );
            $input = preg_replace( '/\*/i', '.*', $input );
            return $input;
        }// end transformInput

        protected function alphabeticSort( $name, $flag = self::A_Z ){
            if( isset( $_SESSION[ self::_SORT ] ) && $_SESSION[ self::_SORT ] == $name ){
                if( $flag == self::A_Z ) $how = 'DESC';
                elseif( $flag == self::Z_A ) $how = 'ASC';
                $exec = $this->getExecMode( );
                $this->setSQLExp( preg_replace( '/\$column\$/i', $exec->getColumn( ), $this->getSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$how\$/i', $how, $this->getSQLExp( ) ) );
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
                    $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                    $this->_precision.') '.$sign.' \'^'.$input.'$\' $conditions$', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                              $this->_precision.') '.$sign.' \'^'.$input.'$\' $conditions$', $this->getSecondSQLExp( ) ) );
                }
                $i++;
            }
        }// end equal

        protected function isGreaterThan( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $input = $this->subsForGTLT_E( $input, self::GT );
                        $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) > '.$input.' $conditions$', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) > '.$input.' $conditions$', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isGreaterThan

        protected function isGreaterThanOrEqual( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $input = $this->subsForGTLT_E( $input, self::GTE );
                        $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) >= '.$input.' $conditions$', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) >= '.$input.' $conditions$', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isGreaterThanOrEqual
        
        protected function isLessThan( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $input = $this->subsForGTLT_E( $input, self::LT );
                        $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) < '.$input.' $conditions$', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) < '.$input.' $conditions$', 
                                                                    $this->getSecondSQLExp( ) ) );
                    }
                    // }
                }
                $i++;
            }
        }// end isLessThan
        
        protected function isLessThanOrEqual( $name ){
            $i = 1;
            foreach(self::$_inX[ 'inputs' ] as $inputN ){
                if( isset( $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] ) && 
                    $_SESSION[ self::_COND ][ $this->getID( ) ][ self::_NAME.$i ] == $name ){
                    $exec = $this->getExecMode( );
                    // input {
                    $input = $_SESSION[ self::_COND ][ $this->getID( ) ][ $inputN ];
                    if( strlen( $input ) > 0 ){
                        $input = $this->subsForGTLT_E( $input, self::LTE );
                        $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) <= '.$input.' $conditions$', 
                                                          $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.$this->_precision.' ) <= '.$input.' $conditions$', 
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
                    $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                    $this->_precision.' )'.' '.$sign.' \'^'.$input.'\' $conditions$', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                              $this->_precision.' )'.' '.$sign.' \'^'.$input.'\' $conditions$', $this->getSQLExp( ) ) );
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
                    $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                    $this->_precision.' )'.' '.$sign.' \''.$input.'$\' $conditions$', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                              $this->_precision.' )'.' '.$sign.' \''.$input.'$\' $conditions$', $this->getSecondSQLExp( ) ) );
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
                    $this->setSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                    $this->_precision.' )'.' '.$sign.' \''.$input.'\' $conditions$', $this->getSQLExp( ) ) );
                    $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', 'ROUND( '.$exec->getColumn( ).'/'.$this->_ratio.', '.
                                                                                              $this->_precision.' )'.' '.$sign.' \''.$input.'\' $conditions$', $this->getSecondSQLExp( ) ) );
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
                        $this->setSQLExp( preg_replace( '/\$conditions\$/i', $operator.' $conditions$', $this->getSQLExp( ) ) );
                        $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', $operator.' $conditions$', $this->getSecondSQLExp( ) ) );
                    }
                }
            }
        }// end logicalConjuction
        
        protected function optionsList( ){
            if( isset( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] ) && !empty( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] ) ){
                $v = array( );
                foreach( $_SESSION[ self::_OPTIONS ][ $this->getID( ) ] as $val ) $v[ ] = '\''.$val.'\'';
                $values = implode( ', ', $v );
                $exec = $this->getExecMode( );
                $this->setSQLExp( preg_replace( '/\$conditions\$/i', $exec->getColumn( ).' IN ( '.$values.' ) $conditions$', $this->getSQLExp( ) ) );
            }
        }// end optionsList
        
        public function prepareSQL( ){
            // the alphabetic sorting {
            $this->alphabeticSort( $this->getID( ).self::CONJUCTION.self::$_inX[ self::_SORT ][ 0 ], self::A_Z );
            $this->alphabeticSort( $this->getID( ).self::CONJUCTION.self::$_inX[ self::_SORT ][ 1 ], self::Z_A );
            // } first part {
            // grouping syntax
            if( $this->groupExp( ) ){ 
                $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', '( $conditions$', $this->getSecondSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$conditions\$/i', '( $conditions$', $this->getSQLExp( ) ) );
            }
            $this->equal( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 0 ] );
            $this->equal( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 1 ], self::OFF );
            $this->isGreaterThan( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 2 ] );
            $this->isGreaterThanOrEqual( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 3 ] );
            $this->isLessThan( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 4 ] );
            $this->isLessThanOrEqual( $this->getID( ).self::CONJUCTION.'1'.self::$_inX[ self::_COND ][ 5 ] );
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
            $this->isGreaterThan( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 2 ] );
            $this->isGreaterThanOrEqual( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 3 ] );
            $this->isLessThan( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 4 ] );
            $this->isLessThanOrEqual( $this->getID( ).self::CONJUCTION.'2'.self::$_inX[ self::_COND ][ 5 ] );
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
                $this->setSecondSQLExp( preg_replace( '/\$conditions\$/i', ') $conditions$', $this->getSecondSQLExp( ) ) );
                $this->setSQLExp( preg_replace( '/\$conditions\$/i', ') $conditions$', $this->getSQLExp( ) ) );
            }	
            // }
        }// end prepareSQL
        
        public function setRatio( $ratio ){
                if( $ratio != 0 ) $this->_ratio = $ratio;
                else throw new Exception( 'Ratio can not equal 0...' );
                return $this;
        }// end setRatio
        
        public function getRatio( ){
                return $this->_ratio;
        }// end getRatio
        
        public function setPrecision( $precision ){
                $this->_precision = $precision;
                return $this;
        }// setPrecision
        
        public function getPrecision( ){
                return $this->_precision;
        }// getPrecision
        
    // }
}