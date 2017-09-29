<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\filter\exec
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2017
 */

namespace core\classes\filter\exec;

class Database extends Exec {
    // vars {

        private 	$_table 		= null;
        private 	$_database 		= null;
        private 	$_column 		= null;
        private static	$_oneRowSyntaxes 	= array();

        private 	$_oneRowInstance 	= null;
        private		$_oneRowDbMode		= null;
        private		$_ID			= NULL;
        private static	$_oneRowMode 		= false;


        protected 		$_SQLs = array( INSERT => array('INSERT INTO $table($columns) VALUES $values;'),
                                                UPDATE => array('UPDATE $table SET $column=$value WHERE id IN($id);',
                                                                                'UPDATE $table SET $column=$value;',
                                                                                'UPDATE $table $settings WHERE id IN($id);'),
                                                DELETE => array('DELETE FROM $table WHERE id IN($id);'),
                                                SELECT => array('SELECT $columns FROM $table WHERE id IN($ids);',
                                                                                'SELECT $columns FROM $table WHERE id=$id;',
                                                                                'SELECT $columns FROM $table;'));

        public static	$lastInsertId		= null;

    // } methods {
        // private {

        // } protected {

            protected function insert( $table, $columns, $values ){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ INSERT ][ 0 ] );
                $sql = preg_replace( '/\$columns/i', $columns, $sql );
                $sql = preg_replace( '/\$values/i', $values, $sql );
                $y = $db->prepare( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ){
                    $info = $db->errorInfo( );
                    $message = 'ERROR '.$info[ 1 ].' ('.$info[ 0 ].'): '.$info[ 2 ];
                    Informer::throwInfo( 'Error occurred... You can not save changes. Error message: '.$message, Informer::INFO );
                    throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                    return false;
                } else {
                    self::$lastInsertId = (int)$db->lastInsertId( );
                }
                return true;
            } // end insert

            protected function update( $table, $column, $value, $id ){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ UPDATE ][ 0 ] );
                $sql = preg_replace( '/\$column/i', $column, $sql );
                $sql = preg_replace( '/\$value/i', $value, $sql );
                $sql = preg_replace( '/\$id/i', $id, $sql );
                $y = $db->prepare( $sql );
                //Functions::debugView( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ){
                    $info = $db->errorInfo( );
                    $message = 'ERROR '.$info[ 1 ].' ('.$info[ 0 ].'): '.$info[ 2 ];
                    Informer::throwInfo( 'Error occurred... You can not save changes. Error message: '.$message, Informer::INFO );
                    throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                    return false;
                } 
                return true;
            } // end insert

            protected function updateInOne( $table, $settings, $id ){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ UPDATE ][ 2 ] );
                $sql = preg_replace( '/\$settings/i', $settings, $sql );
                $sql = preg_replace( '/\$id/i', $id, $sql );
                $y = $db->prepare( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ){
                    $info = $db->errorInfo( );
                    $message = 'ERROR '.$info[ 1 ].' ('.$info[ 0 ].'): '.$info[ 2 ];
                    Informer::throwInfo( 'Error occurred... You can not save changes. Error message: '.$message, Informer::INFO );
                    throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                    return false;
                } 
                return true; 
            } // end insert

            protected function delete( $table, $id ){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ DELETE ][ 0 ] );
                $sql = preg_replace( '/\$id/i', $id, $sql );
                $y = $db->prepare( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ) throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                return true;
            } // end insert

            protected function select($table, $columns, $ids){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ SELECT ][ 0 ] );
                $sql = preg_replace( '/\$columns/i', $columns, $sql );
                $sql = preg_replace( '/\$ids/i', $ids, $sql );
                $y = $db->prepare( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ) throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                return $y;
            } // end insert

            protected function selectAll($table, $columns){
                $db = $this->getDatabase( );
                $sql = preg_replace( '/\$table/i', $table, $this->_SQLs[ SELECT ][ 2 ] );
                $sql = preg_replace( '/\$columns/i', $columns, $sql );
                $y = $db->prepare( $sql );
                if( !$y ) throw new \Exception( 'Something wrong with Your SQL syntax. The query: '.$sql );
                if( !$y->execute( ) ) throw new \Exception( 'Syntax: '.$sql.' can not be executed. Try again.' ); 
                return $y;
            } // end insert

        // public {

            public function recognizeType( $var ){
                $type = $this->getType( );
                $db = $this->getDatabase();
                //$content = $db->quote($this->getValue());
                $content = $this->getValue();
                $string = '';
                switch( $type ){
                    case _STRING:
                    {
                            $string .= '\''.$content.'\'';
                    } break;
                    case _FLOAT: 
                    case _DOUBLE:
                    case _BOOL:
                    case _INT: 
                    {
                            $string .= ( string ) $content;
                    } break;
                    case _ARRAY:
                    {
                            $string .= '\''.implode('|', ( array ) $this->getValue( ) ).'\'';
                    } break;
                }
                return $string;
            } // end recognizeType

            public function __construct( $column_name, $table_name, $db = null ){
                $this->_column = $column_name;
                $this->_table  = $table_name;
            }// end __construct

            public function setID( $id ){
                $this->_ID = $id;
                return $this;
            } // end setID 

            public function getID( ){
                return $this->_ID;
            } // end setID 

            public function setSQLs($sql){
                $this->_SQLs[] = $sql;
                return $this;
            }// end setSQLs

            public function getSQLs(){
                return $this->_SQLs;
            }// end getSQLs

            public function setTable($table){
                $this->_table = $table;
                return $this;
            }// end setTable

            public function setColumn($column){
                $this->_column = $column;
                return $this;
            }// end setColumn

            public function getTable( ){
                return $this->_table;
            }// end getTable

            public function getColumn(){
                return $this->_column;
            }// end getColumn

            public function setDatabase( $database ){
                $this->_database = $database;
                return $this;
            }//end setDatabase

            public function getDatabase( ){
                // SQL executing
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                $pdo = $connection->getPDO();
                
                return $pdo;
            }//end getDatabase

            public function setOneRow( ){
                $this->_oneRowInstance = OneRow::setOneRow( );
                $this->_oneRowDbMode = $this;
                return true;
            }// end setOneRow

            public function inOneRow( ){
                    return OneRow::inOneRow( );
            } // end inOneRow

            public function add( $mode, $element ){
                OneRow::addElement( $mode, $element );
                return true;
            } // end add

            public function commit( ){
                if( !$this->inOneRow( ) ) throw new \Exception( 'You are not in "oneRow" mode. You can not call dbMode::commit() method.' );
                if( $this->_oneRowDbMode != $this ) throw new \Exception( 'You can not commit "oneRow" for this dbMode instance.' );
                $db = $this->getDatabase( );
                $db->beginTransaction();

                $p = 0;

                foreach( $this->_oneRowInstance->getElements( ) as $mode => $execModes ){
                    switch( $mode ){
                        case INSERT:
                        {
                            $table = $this->_table;
                            $columns = array( );
                            $values = array( );
                            foreach( $execModes as $key => $execM ){
                                $columns[ ] = $execM->getColumn( );
                                $values[ ] = $execM->recognizeType( $execM->getValue( ) );
                            }
                            $col = implode( ', ', $columns );
                            $val = '('.implode( ', ', $values ).')';
                            $p = $this->insert( $table, $col, $val );
                            if( !$p ) break;
                        } break;
                        case UPDATE:
                        {
                            $table = $this->_table;
                            $m = 'SET ';
                            foreach( $execModes as $key => $execM ){
                                $m .= $execM->getColumn( ).'=';
                                if( $key == sizeof( $execModes ) - 1 ){
                                    $m .= $execM->recognizeType( $execM->getValue( ) );
                                    break;
                                }
                                $m .= $execM->recognizeType( $execM->getValue( ) ).', ';
                            }
                            $p = $this->updateInOne( $table, $m, $this->getID( ) );
                            if( !$p ) break;
                        } break;
                        case DELETE:
                        {

                        } break;
                        case SELECT:
                        {
                                // empty
                        } break;
                    }
                }
                if( !$db->commit( ) ) {}//Informer::throwInfo( sysI::get( 'SAVE_FAIL' ), Informer::ERROR );

                return ($this->_oneRowInstance->commit( ) && $p);
            } // end commit

            public function execute( $mode ){
                $value = $this->recognizeType( 0 );
                switch( $mode ){
                    case INSERT:
                    {
                        if( !$this->inOneRow( ) ){ 
                                return $this->insert( $this->getTable( ), $this->getColumn( ), $value );
                        } else $this->add( $mode, $this );
                    } break;
                    case UPDATE:
                    {
                        if( !$this->inOneRow( ) ){ 
                                //Functions::debugView( $value );
                                return $this->update( $this->getTable( ), $this->getColumn( ), $value, $this->getID( ) );
                        } else $this->add( $mode, $this );
                    } break;
                    case DELETE:
                    {
                        if( !$this->inOneRow( ) ){ 
                                return $this->delete( $this->getTable( ), $this->getID( ) );
                        } else $this->add( $mode, $this );
                    } break;
                    case SELECT:
                    {
                        if( !$this->inOneRow( ) ){
                                return $this->select( $this->getTable( ), $this->getColumn( ), $this->getID( ) );
                        } else $this->add( $mode, $this );
                    } break;
                    case SELECT_ALL:
                    {
                        if( !$this->inOneRow( ) ){
                                return $this->selectAll( $this->getTable( ), $this->getColumn( ) );
                        } else $this->add( $mode, $this );
                    } break;
                }

                return true;
            } // end execute 
            
        // }
    // }
}