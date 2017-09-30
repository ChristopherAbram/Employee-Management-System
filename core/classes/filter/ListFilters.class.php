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

class ListFilters {
    // vars {
    
        private		$_filters = array();

        private		$_position = 0;

        private		$_limit = 20;

        private		$_defaultOrder = '';

        private		$_method = 'ASC';

        private		$_extraCond = '';

        private		$_operator = '';

        private		$_SQL = '';

        private		$_columns = array( );

        private		$_tables = array( );
        // CONST {
        const MAIN_QUERY = 0;
        const LIST_QUERY = 1;
            // }
        
    // } methods {
        
        private function toPermute( ){
            foreach( $_POST as $id => $val ){
                if( preg_match( '/^filter_/i', $id ) ){
                    return true;
                    break;
                }
            }
            return false;
        }// end toPermute

        private function arrayOfId(array $reacting ){
            // $reacting = array('tableName' => handle);
            $id = array();
            //$tables = array();
            //$args = func_num_args();
            //for($i = 0; $i < $args; $i++){
            //	$ar = explode('_', func_get_arg($i));
            //	$tables[$ar[0]] = func_get_arg($i);
            //}
            foreach($reacting as $table => $name){
                $tmpArray = $this->fieldInForm(self::DEAL_OUT, $name);
                if(array_key_exists($name, $tmpArray)){ 
                    $arrayD = $tmpArray[$name];
                    unset($tmpArray);
                    foreach($arrayD as $key => $v){ 
                        $id[$table][] = preg_replace( '/^'.$name.'_/i', '', $key ); // end(explode('_', $key));
                    }
                }
            }
            return $id;
	}// end arrayOfId
        
        private function fieldInForm($doWhat){
            $array = array();
            $args = func_num_args();
            for($i = 1; $i < $args; $i++){
                $array[] = func_get_arg($i);
            }
            if($doWhat == 'count'){
                $j = 0;
                foreach($array as $key => $field){
                    foreach($_POST as $k => $v){
                        $a = explode('_', $k);
                        $b = $a[0];
                        foreach($a as $k1 => $v1){
                            if($field == $b){
                                $j++;
                            }
                            if(array_key_exists($k1 + 1, $a)) $b.='_'.$a[$k1 + 1];
                        }
                    }
                }
                return $j;
            }
            if($doWhat == 'deal_out'){
                $array1 = array();
                foreach($array as $key => $field){
                    foreach($_POST as $k => $v){
                        $a = explode('_', $k);
                        $b = $a[0];
                        foreach($a as $k1 => $v1){
                            if($field == $b){
                                $array1[$field][$k]= $v;
                            }
                            if(array_key_exists($k1 + 1, $a)) $b.='_'.$a[$k1 + 1];
                        }
                    }
                }
                return $array1;
            }
	}// end FieldinForm
        
        private function sessionControl( ){
            // conditional variables {
            $conditional = array ( Filter::_NAME.'1' 	=> null,
                                   Filter::_INPUT.'1' 	=> null,
                                   Filter::_LOGIC		=> null,
                                   Filter::_NAME.'2' 	=> null,
                                   Filter::_INPUT.'2' 	=> null );
            // }				   			   
            foreach( $this->_filters as $key => $filter ){
                $mainINDEX = $filter->getIndexes( );
                // setting sort variable {
                    foreach( $mainINDEX[ Filter::_SORT ] as $inX ){
                        if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.$inX ] ) )
                            $_SESSION[ Filter::_SORT ] = $filter->getID( ).Filter::CONJUCTION.$inX ;
                    }
                // } setting name and input value for conditional filter {
                    $p = 0;
                    // first ( 1 ) {
                    foreach( $mainINDEX[ Filter::_COND ] as $inX ){
                        if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.'1'.Filter::_OPTIONS ] ) && 
                            $_POST[ $filter->getID( ).Filter::CONJUCTION.'1'.Filter::_OPTIONS ] == $filter->getID( ).Filter::CONJUCTION.'1'.$inX ){

                            $_SESSION[ Filter::_COND ][ $filter->getID( ) ] = $conditional; // all variables are adding to session's array
                            $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] = $filter->getID( ).Filter::CONJUCTION.'1'.$inX;
                            $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_INPUT.'1' ] = $_POST[ $filter->getID( ).Filter::CONJUCTION.'1'.Filter::_INPUT ]; 
                            $p = 1;
                        }
                    }
                    // } second ( 2 ) {
                    $j = 0;
                    foreach( $mainINDEX[ Filter::_COND ] as $inX ){
                        if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.'2'.Filter::_OPTIONS ] ) && 
                            $_POST[ $filter->getID( ).Filter::CONJUCTION.'2'.Filter::_OPTIONS ] == $filter->getID( ).Filter::CONJUCTION.'2'.$inX ){ 

                            $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] = $filter->getID( ).Filter::CONJUCTION.'2'.$inX;
                            $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_INPUT.'2' ] = $_POST[ $filter->getID( ).Filter::CONJUCTION.'2'.Filter::_INPUT ] ;
                            $j = 1;
                        }
                    }
                    // }
                // } setting default values for name and input {
                    // first ( 1 ) {
                    if( !$p && isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.'1'.Filter::_SUBMIT ] ) ){
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] = null;
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_INPUT.'1' ] = null; 
                    } 
                    // } second ( 2 ) {
                    if( !$j && isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.'1'.Filter::_SUBMIT ] ) ){
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] = null;
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_INPUT.'2' ] = null; 
                    }
                    // }
                // } adding logic operator {
                foreach( $mainINDEX[ Filter::_LOGIC ] as $inX ){
                    if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.Filter::_LOGIC ] ) && 
                            $_POST[ $filter->getID( ).Filter::CONJUCTION.Filter::_LOGIC ] == $filter->getID( ).Filter::CONJUCTION.$inX ){ 

                                $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_LOGIC ] = $inX;
                    }
                }
                // } options list {
                if( $filter->getExecMode( ) instanceof exec\Database ){
                    $table = $filter->getExecMode( )->getTable( );
                    $column = $filter->getExecMode( )->getColumn( );
                    if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.'2'.Filter::_SUBMIT ] ) ){
                        // getting pointed option {
                            $array1 = $this->arrayOfId( array( $table.Filter::CONJUCTION.$column ) );
                            $array2 = $this->fieldInForm( 'deal_out', $table.Filter::CONJUCTION.$column );
                            //Functions::debugView( $array1 );
                        // }
                        $array = array( );
                        if( isset( $array1[ 0 ] ) ){
                            foreach( $array1[ 0 ] as $k ){
                                $array[ $k ] = $array2[ $table.Filter::CONJUCTION.$column ][ $table.Filter::CONJUCTION.$column.Filter::CONJUCTION.$k ];
                            }
                        } elseif( !isset( $array[ 0 ], $_SESSION[ Filter::_OPTIONS ][ $filter->getID( ) ] ) ){
                            $array[ ] = null;
                        }
                        $_SESSION[ Filter::_OPTIONS ][ $filter->getID( ) ] = $array;
                    }
                }
                // }
            }
            foreach( $this->_filters as $key => $filter ){
                $mainINDEX = $filter->getIndexes( );
                foreach( $mainINDEX[ Filter::_SORT ] as $inX ){
                    // removing from session's array sort variable {
                    if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.$inX.Filter::CONJUCTION.Filter::_REMOVE_SORT ] ) )
                        unset( $_SESSION[ Filter::_SORT ] );
                    // } adding remove button for sort filter {
                    if( isset( $_SESSION[ Filter::_SORT ] ) && $_SESSION[ Filter::_SORT ] == $filter->getID( ).Filter::CONJUCTION.$inX )
                        $filter->setActiveFilters( Filter::_SORT, array( 
                            Filter::_NAME => $filter->getID( ).Filter::CONJUCTION.$inX.
                            Filter::CONJUCTION.Filter::_REMOVE_SORT, 
                            Filter::_CLASS => Filter::_SORT, 
                            Filter::_VALUE => 'Remove sorting' ) 
                        );
                    // }
                }
                $i = 0;
                foreach( $mainINDEX[ Filter::_COND ] as $inX ){
                    // removing from session's array cond variable {
                    if( isset( $_POST[ $filter->getID( ).Filter::CONJUCTION.$inX.Filter::CONJUCTION.Filter::_REMOVE_COND ] ) ) 
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ] = $conditional;
                    // } adding remove button for conditional filter {
                    if( ( isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] ) || 
                        isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] ) ) && 
                        ( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] == $filter->getID( ).Filter::CONJUCTION.'1'.$inX ||
                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] == $filter->getID( ).Filter::CONJUCTION.'2'.$inX ) )

                                $filter->setActiveFilters( $filter->getID( ), 
                                                        array( Filter::_NAME => $filter->getID( ).Filter::CONJUCTION.$inX.Filter::CONJUCTION.Filter::_REMOVE_COND, 
                                                               Filter::_CLASS => Filter::_COND, 
                                                               Filter::_VALUE => 'Remove the conditional filter' ) 
                                                            );
                    // }
                }
            }
            return 1;
        }// end sessionControl
        
        final public function addFilter( Filter $filter ){
            $this->_filters[ ] = $filter;
            return $this;
        }// end addFilter

        final public function getFilters( ){
            return $this->_filters;
        }// end getFilters

        final public function setPosition( $position ){
            $this->_position = $position;
            return $this;
        }// end setPosition

        final public function getPosition( ){
            return $this->_position;
        }// end getPosition

        final public function setLimit( $limit ){
            $this->_limit = $limit;
            return $this;
        }// end setLimit

        final public function getLimit( ){
            return $this->_limit;
        }// end getLimit

        final public function setDefaultListOrder( array $columns, $method ){
            $this->_defaultOrder = implode( ', ', $columns );
            $this->_method = $method;
            return $this;
        }// end setDefaultListOrder

        final public function setExtraConditions( $string, $operator ){
            $this->_extraCond = $string;
            $this->_operator = $operator;
            return $this;
        }// end setExtraConditions

        final public function getExtraConditions( ){
            return $this->_extraCond;
        }// end getExtraConditions

        final public function setColumns( array $columns ){
            $this->_columns = $columns;
            return $this;
        }// end setColumns

        final public function getColumns( ){
            return $this->_columns;
        }// end getColumns

        final public function setTables( array $tables ){
            $this->_tables = $tables;
            return $this;
        }// end setTables

        final public function getTables( ){
            return $this->_tables;
        }// end getTables
        
        protected function _getPdo(){
            $connection = \ConnectionRegistry::getUserEstablishedConnection();
            $pdo = $connection->getPDO();

            return $pdo;
        }
        
        protected function _createAssocTable($data, $id_column = false){
            $_dataarray = array();
            while($array = $data->fetch(\PDO::FETCH_ASSOC)){
                if($id_column == FALSE) $_dataarray[] = $array;
                else $_dataarray[$array[$id_column]] = $array;
            }
            return $_dataarray;
        }

        public function permuteList( ){

                $db = $this->_getPdo();

                if( sizeof( $this->_filters ) > 0 ){
                        // main SQL query setting {
                                $SQLs = $this->_filters[ 0 ]->getSQLs( );
                                $SQL = $SQLs[ self::MAIN_QUERY ];

                        // clearing session array of unnecessary elements {
                                $this->sessionControl( );

                        // } main procedure : preparation final SQL query {
                                $this->_filters[ 0 ]->setSQLExp( $SQL );
                                $p = 0;

                                foreach( $this->_filters as $id => $filter ){

                                        $SQL1 = $SQLs[ self::LIST_QUERY ];
                                        $filter->setSecondSQLExp( $SQL1 );

                                        // setting list query {
                                                if( $filter->getExecMode( ) instanceof exec\Database ){
                                                        $SQL1 = preg_replace( '/\$tables\$/i', implode( ', ', $this->_tables ), $SQL1 );
                                                        $SQL1 = preg_replace( '/\$column\$/i', $filter->getExecMode( )->getColumn( ), $SQL1 );
                                                        $filter->setSecondSQLExp( $SQL1 );
                                                }

                                        // } grouping conditions {
                                                $filter->setGroupExp( false );
                                                if( ( isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] ) ||
                                                        isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] ) ) && 
                                                        ( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] != '' ||
                                                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] != '' ) ){
                                                        $filter->setGroupExp( true );
                                                }

                                        // } prepare SQL expression {
                                                $filter->prepareSQL( );
                                                $SQL = $filter->getSQLExp( );
                                                $SQL1 = $filter->getSecondSQLExp( );

                                        // } logical operator between two filters {

                                                if( (( isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] ) ||
                                                        isset( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] ) ) && 
                                                        ( $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'1' ] != '' ||
                                                        $_SESSION[ Filter::_COND ][ $filter->getID( ) ][ Filter::_NAME.'2' ] != '' )) ||
                                                        isset( $_SESSION[ Filter::_OPTIONS ][ $filter->getID( ) ] ) ){
                                                        for( $i = $id + 1; $i < sizeof( $this->_filters ); $i++ ){

                                                                if( (( isset( $_SESSION[ Filter::_COND ][ $this->_filters[ $i ]->getID( ) ][ Filter::_NAME.'1' ] ) ||
                                                                        isset( $_SESSION[ Filter::_COND ][ $this->_filters[ $i ]->getID( ) ][ Filter::_NAME.'2' ] ) ) && 
                                                                        ( $_SESSION[ Filter::_COND ][ $this->_filters[ $i ]->getID( ) ][ Filter::_NAME.'1' ] != '' ||
                                                                        $_SESSION[ Filter::_COND ][ $this->_filters[ $i ]->getID( ) ][ Filter::_NAME.'2' ] != '' )) ||
                                                                        isset( $_SESSION[ Filter::_OPTIONS ][ $this->_filters[ $i ]->getID( ) ] ) ){

                                                                                $SQL = preg_replace( '/\$conditions\$/i', ' AND $conditions$', $filter->getSQLExp( ) ); 
                                                                                $SQL1 = preg_replace( '/\$conditions\$/i', ' AND $conditions$', $filter->getSecondSQLExp( ) );
                                                                                break;
                                                                }
                                                        }
                                                }

                                                if( isset( $this->_filters[ $id + 1 ] ) ){
                                                        $this->_filters[ $id + 1 ]->setSQLExp( $SQL );
                                                        $this->_filters[ $id + 1 ]->setSecondSQLExp( $SQL1 );
                                                }
                                        // } getting options list {
                                        if( $filter->distinct( ) ){
                                                if( $filter instanceof \core\classes\filter\DateFilter ){
                                                        $SQL1 = $filter->getSecondSQLExp( );

                                                        // if there is no conditions {
                                                                if( $this->_extraCond == '' ){
                                                                        $SQL1 = preg_replace( '/WHERE \$conditions\$/i', '', $SQL1 );
                                                                }			
                                                                if( preg_match( '/WHERE\s*\$conditions\$\s*ORDER\s*BY/i', $SQL1 ) ) 
                                                                        $SQL1 = preg_replace( '/\$conditions\$/i', $this->_extraCond, $SQL1 );
                                                                else $SQL1 = preg_replace( '/\$conditions\$/i', $this->_operator.' '.$this->_extraCond, $SQL1 );

                                                        // } option list amount {
                                                                $SQL1 = preg_replace( '/\$amount\$/i', $filter->optionsListAmount( ), $SQL1 );

                                                        // } creating array of data {

                                                                $restofSQL1 = substr( $SQL1, strpos( $SQL1, 'WHERE' ) );
                                                                $m = 'SELECT DISTINCT YEAR('.$filter->getExecMode( )->getColumn( ).') AS value FROM '.
                                                                         implode( ', ', $this->_tables ).' '.$restofSQL1;
                                                                //Functions::debugView( $m );
                                                                $q = $db->prepare( $m );
                                                                $q->execute( );
                                                                $results = $this->_createAssocTable( $q );
                                                                $filter->setOptionsList( $results );
                                                                unset( $results );

                                                        // }
                                                } else {
                                                        $SQL1 = $filter->getSecondSQLExp( );
                                                        // if there is no conditions {
                                                                if( $this->_extraCond == '' ){
                                                                        $SQL1 = preg_replace( '/WHERE \$conditions\$/i', '', $SQL1 );
                                                                }			
                                                                if( preg_match( '/WHERE\s*\$conditions\$\s*ORDER\s*BY/i', $SQL1 ) ) 
                                                                        $SQL1 = preg_replace( '/\$conditions\$/i', $this->_extraCond, $SQL1 );
                                                                else $SQL1 = preg_replace( '/\$conditions\$/i', $this->_operator.' '.$this->_extraCond, $SQL1 );

                                                        // } option list amount {
                                                                $SQL1 = preg_replace( '/\$amount\$/i', $filter->optionsListAmount( ), $SQL1 );

                                                        // } creating array of data {
                                                                $q = $db->prepare( $SQL1 );
                                                                $q->execute( );
                                                                $results = $this->_createAssocTable( $q );
                                                                $filter->setOptionsList( $results );
                                                                unset( $results );

                                                        // }
                                                }
                                        // }
                                        }
                                }
                        // } getting sql query {
                                $this->_SQL = $SQL;

                                return true;
                        // }
                }

                return false;

                //}
        }// end permute

        public final function perform( ){

                $db = $this->_getPdo();

                if( $this->_SQL === '' ){
                        $SQLs = $this->_filters[ 0 ]->getSQLs( );
                        $SQL = $SQLs[ 0 ];
                } else {
                        $SQL = $this->_SQL;
                }

                // getting columns and tables {
                        $columns = implode( ', ', $this->_columns );
                        $tables = implode( ', ', $this->_tables );

                // } position and limit settings {
                        $SQL = preg_replace( '/\$position\$/i', $this->_position, $SQL );
                        $SQL = preg_replace( '/\$amount\$/i', $this->_limit, $SQL );

                // } columns and tables settings {
                        $SQL = preg_replace( '/\$columns\$/', $columns, $SQL );
                        $SQL = preg_replace( '/\$tables\$/i', $tables, $SQL );

                // if there is no conditions {
                        if( $this->_extraCond == '' ){
                                $SQL = preg_replace( '/WHERE \$conditions\$/i', '', $SQL );
                        }
                        if( preg_match( '/WHERE\s*\$conditions\$\s*ORDER\s*BY/i', $SQL ) ) 
                                $SQL = preg_replace( '/\$conditions\$/i', $this->_extraCond, $SQL );
                        else $SQL = preg_replace( '/\$conditions\$/i', $this->_operator.' '.$this->_extraCond, $SQL );

                // } default order setting {
                        if( $this->_defaultOrder == '' ){
                                $SQL = preg_replace( '/ORDER BY \$column\$ \$how\$/i', '', $SQL );
                        } else {
                                $SQL = preg_replace( '/\$column\$/i', $this->_defaultOrder, $SQL );
                                $SQL = preg_replace( '/\$how\$/i', $this->_method, $SQL );
                        }

                // }
                //Functions::debugView( $SQL );

                /*echo '<pre>';
                print_r($SQL);
                echo '</pre>';*/
                        
                $q = $db->prepare( $SQL );
                $q->execute( );
                $results = $this->_createAssocTable( $q );

                return $results;

        } 
        
        
        
    // }
}