<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form\field;

abstract class Field {
    // vars {
        
        protected $_request         = null;
        
        protected $_id              = null;
    
        protected $_name            = null;
        
        protected $_value           = ''; //null;
        
        protected $_form            = null;
        
        protected $_required        = null;
        
        protected $_disabled        = null;
        
        protected $_readonly        = null;
        
        protected $_fill            = true;
        
        protected $_expression      = null;
        
        protected $_expr_message    = '';
        
        protected $_callback        = null;
        
        protected $_call_message    = '';
        
        protected $_expr_error      = false;
        
        protected $_call_error      = false;
        
        protected $_display_errors  = true;
        
        protected $_filter_flag     = true;
    
    // } methods {
    
        // public {
        
            public function __construct($name, $fill = true){
                $this->name($name);
                $this->_request = \RequestRegistry::getRequest();
                $this->_fill = $fill;
                $this->_value = $this->_fetchValue($name);
            }// end __construct
            
            public function id($id = null){
                if(!is_null($id)){
                    $this->_id = $id;
                }
                return $this->_id;
            }// end id
            
            public function name($name = null){
                if(!is_null($name)){
                    $this->_name = $name;
                }
                return $this->_name;
            }// end name
            
            public function value($value = null){
                if(!is_null($value)){
                    $this->_value = $value;
                    $this->_setValue($this->_name, $this->_value);
                }
                else {
                    $req_val = $this->_fetchValue($this->_name);
                    if(!is_null($req_val)){
                        $this->_value = $req_val;
                    }
                }
                return $this->_value;
            }// end value
            
            public function displayValue(){
                return ($this->_filter_flag ? \core\functions\filter($this->value()) : $this->value());
            }// end displayValue
            
            public function form($form = null){
                if(!is_null($form)){
                    $this->_form = $form;
                }
                return $this->_form;
            }// end form
            
            public function required($required = null){
                if(!is_null($required)){
                    $this->_required = $required;
                }
                return $this->_required;
            }// end required
            
            public function disabled($disabled = null){
                if(!is_null($disabled)){
                    $this->_disabled = $disabled;
                }
                return $this->_disabled;
            }// end disabled
            
            public function readonly($readonly = null){
                if(!is_null($readonly)){
                    $this->_readonly = $readonly;
                }
                return $this->_readonly;
            }// end readonly
            
            public function fill($fill = null){
                if(!is_null($fill)){
                    $this->_fill = $fill;
                }
                return $this->_fill;
            }// end fill
            
            public function expression($regular_expression = null, $message = null){
                if(!is_null($regular_expression)){
                    $this->_expression = $regular_expression;
                }
                if(!is_null($message)){
                    $this->_expr_message = $message;
                }
                return $this->_expression;
            }// end expression
            
            public function callback($callback = null, $message = null){
                if(!is_null($callback) && is_callable($callback)){
                    $this->_callback = $callback;
                }
                if(!is_null($message)){
                    $this->_call_message = $message;
                }
                return $this->_callback;
            }// end callback
            
            public function validate(){
                $value = $this->value();
                $expression = $this->expression();
                if(!$this->required() && empty($this->value())){
                    return;
                }
                // expression validation:
                if(!is_null($expression)){
                    if(!\preg_match($expression, $value)){
                        $this->_expr_error = true;
                    }
                }
                // function validation:
                $function = $this->callback();
                if(!is_null($function)){
                    if(!\call_user_func($function, $this)){
                        $this->_call_error = true;
                    }
                }
            }// end validate
            
            public function setFilterFlag($flag){
                $this->_filter_flag = $flag ? true : false;
            }// end setFilterFlag
            
            public function error(){
                return ($this->_expr_error || $this->_call_error);
            }// end error
            
            public function setExpressionError($error){
                $this->_expr_error = $error ? true : false;
            }// end setExpressionError
            
            public function setExpressionErrorMessage($msg){
                $this->_expr_message = $msg;
            }// end setExpressionErrorMessage
            
            public function setCallbackError($error){
                $this->_call_error = $error ? true : false;
            }// end setCallbackError
            
            public function setCallbackErrorMessage($msg){
                $this->_call_message = $msg;
            }// end etCallbackErrorMessage
            
            public function displayErrors($flag){
                $this->_display_errors = $flag;
            }// end displayErrors
            
            public function __toString(){
                $str = $this->_toString();
                if($this->_display_errors){
                    if($this->_expr_error){
                        $str .= '<div class="message">'.$this->_expr_message.'</div>';
                    }
                    else if($this->_call_error){
                        $str .= '<div class="message">'.$this->_call_message.'</div>';
                    }
                }
                return $str;
            }// end __toString
            
        // } protected {
            
            protected function _setValue($name, $value){
                $main = \preg_replace('/\[([a-zA-Z0-9_:.,?-]*)\]/i', '', $name);
                if(!empty($main) && isset($this->_request[$main])){
                    $indexes = $this->_parseName($name);
                    if(empty($indexes) && !is_array($this->_request[$main])){
                        $this->_request[$main] = $value;
                    }
                    else {
                        $request = &$this->_request->getReference($main);
                        foreach($indexes as $index){
                            if(isset($request[$index])){
                                $request = &$request[$index];
                            }
                            else {
                                break;
                            }
                        }
                        if(!is_array($request)){
                            $request = $value;
                        }
                    }
                }
            }// end _setValue
            
            protected function _fetchValue($name){
                $main = \preg_replace('/\[([a-zA-Z0-9_:.,?-]*)\]/i', '', $name);
                
                if(!empty($main) && isset($this->_request[$main])){
                    $indexes = $this->_parseName($name);
                    
                    $value = $this->_request[$main];
                    foreach($indexes as $index){
                        if(isset($value[$index])){
                            $value = $value[$index];
                        }
                        else if(empty($index) && \is_array($value)){
                            $value = \current($value);
                        }
                        else {
                            break;
                        }
                    }
                    
                    /*if(isset($_REQUEST['savestep4']) && $main == 'file'){
                    echo '<pre>';
                    print_r($value);
                    echo '</pre>';
                    die();
                    }*/
                    
                    //if(!is_array($value)){
                    return $value;
                    //}
                }
                return null;
            }// end _fetchValue
            
            protected function _parseName($string){
                $matches = array();
                if(\preg_match_all('/\[([a-zA-Z0-9_:.,?-]*)\]/i', $string, $matches) != 0){
                    if(!empty($matches) && isset($matches[1])){
                        return $matches[1];
                    }
                }
                return array();
            }// end _parseName
            
            abstract protected function _toString();
            
        // } private {
            
        // }
    // }
}