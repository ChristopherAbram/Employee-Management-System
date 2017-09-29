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

class OneRow {
    // vars {
            
        private	static	$_oneRowSyntaxes 	= array();
        private static 	$_oneRowInstances 	= array();
        private static 	$_oneRowInstance 	= null;
        private	static	$_oneRowMode 		= false;
            
    // } methods {
        // private {
        
            private function __construct( ){

            } // end __construct
            
        // } protected {
        
        // } public {
           
            public static function setOneRow( ){
                if( !self::inOneRow( ) ){
                    self::$_oneRowMode = true;
                    self::$_oneRowInstance = new OneRow( );
                } else throw new \Exception( 'You have initialized the "oneRow" already.' );
                return self::$_oneRowInstance;
            } // end setOneRow

            public static function addElement( $mode, $element ){
                self::$_oneRowInstances[ $mode ][ ] = $element;
            } // end addSyntax

            public static function getElements( ){
                return self::$_oneRowInstances;
            }// end getElements 

            public static function inOneRow( ){
                return self::$_oneRowMode;
            } // end inOneRow

            public function commit( ){
                self::$_oneRowMode = false; 
                self::$_oneRowInstances = array( );
                return true;
            } // end commit
                
        // }
    // }
}