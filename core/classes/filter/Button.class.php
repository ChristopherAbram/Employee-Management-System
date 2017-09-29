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

class Button {
    // vars {
    
        static private $_instance 			= 0;
			
        private		$_form 					= null;

        private 	$_name 					= null;

        private  	$_type 					= null;

        private 	$_value 				= '';

        private 	$_defaultValue 			= '';

        private 	$_description 			= null;

        private		$_class 				= null;

        private		$_id 					= null;

        private	 	$_amoutofsetValue 		= 0;

        private 	$_destination 			= null;

        private		$_subs 					= array();

        private		$_communique 			= null;

        private		$_execMode 				= null;

        private		$_key 					= null;

        private		$_expression 			= null;

        private		$_call 					= array( );

        protected	$_options 				= array( );

        private		$_saveable 				= true;

        private		$_setValueCalled 		= false;

        private		$_methodValue 			= '';

        private		$_error 				= array( 'class' 	=> '', 
                                                                                                 'message' 	=> '' );
// } protected {
        protected 	$_info 					= array( );

        protected 	$_tmp 					= null;

        static protected $_submits 			= array( );
    
    
    
        private	$_optionList = array( );
        protected $_params = array();
	protected $_side = 0;
        
        
        const TEXT 				= 'text';
        const TEXTAREA 			= 'textarea';
        const CHECKBOX 			= 'checkbox';
        const PASSWORD		 	= 'password';
        const DATE 				= 'date';
        const TIME 				= 'time';
        const DATETIME_LOCAL	= 'datetime-local';
        const EMAIL				= 'email';
        const FILE				= 'file';
        const MONTH				= 'month';
        const WEEK 				= 'week';
        const NUMBER			= 'number';
        const RADIO 			= 'radio';
        const SELECT 			= 'select';
        const HIDDEN 			= 'hidden';
        const CAPTCHA			= 'captcha';
        const SUBMIT 			= 'submit';
        const RESET 			= 'reset';
        const BUTTON_SUBMIT 	= 'button_submit';
        const BUTTON_RESET 		= 'button_reset';
        const BUTTON 			= 'button';
        // options
        const REQUIRED			= 'required';
        const NOT_REQUIRED		= 'not_required';
        const ERR_ON 			= 'err_on';
        const ERR_OFF			= 'err_off';
        const VALIDATE_BY_PATTERN 		= 'validate_by_pattern';
        const DONT_VALIDATE_BY_PATTERN 	= 'dont_validate_by_pattern';
        const CHECKED 			= 'checked';
        const READONLY 			= 'readonly';
        const DISABLED 			= 'disabled';
        const TAGS_ON 			= 'tags_on';
        const TAGS_OFF 			= 'tags_off';
        const USE_CALLBACKS		= 'use_callbacks';
        const DONT_USE_CALLBACKS= 'dont_use_callbacks';
        const ENCODE			= 'encode';
        const NOT_ENCODE		= 'not_encode';
        
                
    // } methods {
        // private {

        // } protected {

            protected function Err($message, formElement $element){
                $size = $this->getSize();
                $this->setError('Err', '<div class="msg_err" style="width: '.$size['width'].'">'.$message.'</div>');
            }// end Err
        
        // } public {
            
            public function __get($var){
                    $method = "get{$var}";
                    if(method_exists($this, $method)) return $this->$method();
            }// end __get
            public function __isset($var){
                    $method = "get{$var}";
                    return (method_exists($this, $method));
            }// end __isset
            public function __set($var, $value){
                    $method = "set{$var}";
                    if(method_exists($this, $method)) return $this->$method($value); 
            }// end __set
            public function __unset($var){
                    $method = "set{$var}";
                    if(method_exists($this, $method)) return $this->$method(NULL);
            }// end __unset
            public function __clone(){
                    $this->_name = null;
                    $this->_info = array();
            }
            public function __construct( $execMode ){
                    //$this->_value = isset( $_POST[ $this->_name ] ) ? $_POST[ $this->_name ] : '';
                    $this->_execMode = $execMode;
            }// end __construct
                        
            public function setExpression( $expression ){
                    $this->_expression = $expression;
                    return $this;
            }// end setExpression

            public function setCallbacks( array $callbacks ){
                    $this->_call = $callbacks;
                    return $this;
            }// end setCallbacks

            public function getCallbacks( ){
                    return $this->_call;
            }// end getCallbacks

            public function setExecMode($execMode){
                    $this->_execMode = $execMode;
                    return $this;
            }// end setExecMode

            public function getExecMode(){
                    return $this->_execMode;
            }// end setExecMode

            public function setTemplate($tmpfile){
                    $this->_tmp = $tmpfile;
                    return $this;
            }// end setTemplate

            public function getTemplate(){
                    return $this->_tmp;
            }// getTemplate

            public function setForm($form){
                    $this->_form = $form;
                    return $this;
            }// end Form 

            public function getForm(){
                    return $this->_form;
            }// end getForm

            public function setType($type){
                    $this->_type = $type;
                    return $this;
            }// end setType

            public function getType(){
                    return $this->_type;
            }// end getType

            public function setClass($class){
                    $this->_class = $class;
                    return $this;
            }// end setClass

            public function getClass(){
                    return $this->_class;
            }// end getClass

            public function setID($id){
                    $this->_id = $id;
                    return $this;
            }// end setID

            public function getID(){
                    return $this->_id;
            }// end getID

            public function setKey( $key ){
                    $this->_key = $key;
                    return $this;
            }// end setID

            public function getKey( ){
                    return $this->_key;
            }// end getID

            public function setSubstituents( array $substituents ){
                    $this->_subs = array_merge( $this->_subs, $substituents );
                    return $this;
            }// end setSubstituents

            public function getSubstituents(){
                    return $this->_subs;
            }// end getSubstituents

            public function setName($name){
                    $this->_name = $name;
                    if( isset( $_POST[ $this->_name ] ) ){
                            $this->_methodValue = $_POST[ $this->_name ];
                            $this->_value = $_POST[ $this->_name ];
                    }
                    return $this;
            }// end setName

            public function getName(){
                    return $this->_name;
            }// end getName

            public function saveable( $save ){
                    $this->_saveable = $save;
                    return $this;
            }// end saveable

            public function isSaveable( ){
                    return $this->_saveable;
            }// end isSaveable

            public function setValue( $value ){
                    $this->_setValueCalled = true;
                    $this->_value = $value;
                    //if( !is_null( $this->_execMode ) ) $this->_execMode->setValue( $value );
                    return $this;
            }// end setValue

            public function getValue(){
                //if($this->_amoutofsetValue == 0) return $this->_defaultValue;
                if( !$this->_setValueCalled ){
                        $this->_value = $this->_methodValue;
                }

                if( is_array( $this->getOptions( ) ) && in_array( self::ENCODE, $this->getOptions( ) ) and !in_array( self::NOT_ENCODE, $this->getOptions( ) ) ) 
                        $this->_value = base64_encode( $this->_value );

                return $this->_value;
            }// end getValue

            public function setMethodValue( $value ){
                    $this->_methodValue = $value;
                    return $this;
            }// end setMethodValue

            public function getMethodValue( ){
                    if( isset( $_POST[ $this->getName( ) ] ) ){
                            $this->setMethodValue( $_POST[ $this->getName( ) ] );
                    }
                    return $this->_methodValue;
            }// end getMethodValue

            public function getDefaultValue(){
                    return $this->_defaultValue;
            }// end getDefaultValue

            public function setDefaultValue($value){
                    $this->_defaultValue = $value;
                    return $this;
            }// end setDefaultValue

            public function setDescription($description){
                    $this->_description = $description;
                    return $this;
            }// end setDescription

            public function getDescription(){
                    return $this->_description;
            }// end getDescription

            public function getInfo(){
                    $this->_info = array('name' 	=> $this->getName(),
                                         'description' 	=> $this->getDescription(),
                                         'type' 	=> $this->getType(),
                                         'value' 	=> htmlspecialchars($this->getMethodValue()),
                                         'defaultValue' => htmlspecialchars($this->getDefaultValue()),
                                         'destination' 	=> $this->getDestination());
                    return $this->_info;
            }// end getInfo

            final public function setDestination($destination){
                    $this->_destination = $destination;
                    return $this;
            }//end setDestination

            final public function getDestination(){
                    return $this->_destination;
            }//end setDestination

            public function setCommunique($communique){
                    $this->_communique = $communique;
                    return $this;
            }// end setCommunique

            public function getCommunique(){
                    return $this->_communique;
            }// end getCommunique

            public function setError($class, $message){
                    $this->_error = array('class' => $class, 'message' => $message);
                    return $this;
            }// end setError

            public function getError( $strip_tags = false ){
                    if( $strip_tags === true ){ 
                            $this->_error[ 'message' ] = strip_tags( $this->_error[ 'message' ] );
                    }
                    return $this->_error;
            }// end getError

            public function setErrorMsg( $message ){
                    $this->_error[ 'message' ] = $message;
                    return $this;
            }// end setError

            public function getErrorMsg( ){
                    return $this->_error[ 'message' ];
            }// end getError
        
            public function optionsList( array $list ){
                $this->_optionList = $list;
            }// end optionsList

            public function writeButton( ){
                global $MONTHS;
                return \array_merge( 
                    array( 'side' 	=> $this->_side == 0 ? 'left' : 'right',
                            'id' 	=> $this->getID( ),
                            'name'      => $this->getName(),
                            'options' 	=> array( ),
                            'list'	=> $this->_optionList,
                            'table'	=> $this->getExecMode( )->getTable( ),
                            'column'	=> $this->getExecMode( )->getColumn( ), 
                            'form' 	=> $this->getForm( ),
                            'MONTHS'	=> $MONTHS,
                    ), $this->getSubstituents( ));
            }// end writeButton

            public function setOptions( ){

            }// end extraParameters

            public function getOptions(){

            }// end getParams
            
            public function extraParameters( ){
                $num = \func_num_args( );
                
                for( $i = 0; $i < $num; $i++ ){
                    $this->_params[ ] = \func_get_arg( $i );
                }
                return $this;
            }// end extraParameters

            public function getParams(){
                return $this->_params;
            }// end getParams

            public function setSide( $side ){
                $this->_side = $side;
                return $this;
            }// end setSite

            public function getSide( ){
                return $this->_side;
            }// end setSite
            
        // }
    // }
} 