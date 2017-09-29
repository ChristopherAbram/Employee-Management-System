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

class Informer {
    // vars {
    
        private static		$_instance = null;
        private static		$_message = null;
        private static		$_level = 0;
        
        const OK = 1;
        const INFO = 2;
        const ERROR = 3;
        
    // } methods {
        
        private function __construct(){
            
        }// end __construct

        public static function getInstance(){
            if(is_null(self::$_instance)){
                self::$_instance = new Informer();
            }
            return self::$_instance;
        }// end getInstance

        public static function throwInfo($message, $level){
            /* $level
            * OK - when everything went all right
            * INFO - when we want to inform user about sth
            * ERROR - when something went wrong
            * in $massege - coder should put the text message describing encountered situation
            */
            if(!\in_array(self::$_level, array(0, self::OK, self::INFO, self::ERROR)))
                throw new \Exception('Second parameter of the method Informer::throwInfo must have the following values: 1 - if OK, 2 - if INFO, 3 - if ERROR.');
            self::$_message = $message;
            self::$_level = $level;
            return 1;
        }// end throwInfo

        public static function getMessage(){
            return self::$_message;
        }// end getMessage

        public static function getLevel(){
            return self::$_level;
        }// end getLevel

        public static function msgOccurred(){
            if(!\is_null(self::$_message) and \in_array(self::$_level, array(0, self::OK))) return false;
            elseif(!\is_null(self::$_message) and \in_array(self::$_level, array(self::ERROR,self::INFO))) return true;
            else return false;
        }// end msgOccurred 

        public function printInfo(){
            return '<div id="informer">'.self::$_message.'</div>';
        }// end printInfo
    
    // }	
}