<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\response
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\response;

class Response {
    // vars {
        
        protected $_status              = 0;
    
        protected $_headers             = array();
        
        protected $_assignments         = array();
        
        protected $_request             = null;
        
        protected $_template            = null;
        
        protected $_layout              = null;
        
        protected $_messages            = array(
            'error'     => array(),
            'warning'   => array(),
            'correct'   => array()
        );
        
        protected static $_status_code = array(
            // 1xx Informational:
            100     => '100 Continue',
            101     => '101 Switching Protocols',
            102     => '102 Processing',
            
            // 2xx Success:
            200     => '200 OK',
            201     => '201 Created',
            202     => '202 Accepted',
            203     => '203 Non-Authoritative Information',
            204     => '204 No Content',
            205     => '205 Reset Content',
            206     => '206 Partial Content',
            207     => '207 Multi-Status',
            208     => '208 Already Reported',
            226     => '226 IM Used',
            
            // 3xx Redirection:
            300     => '300 Multiple Choices',
            301     => '301 Moved Permanently',
            302     => '302 Found',
            303     => '303 See Other',
            304     => '304 Not Modified',
            305     => '305 Use Proxy',
            306     => '306 Switch Proxy',
            307     => '307 Temporary Redirect',
            308     => '308 Permanent Redirect',
            
            // 4xx Client Error:
            400     => '400 Bad Request',
            401     => '401 Unauthorized',
            402     => '402 Payment Required',
            403     => '403 Forbidden',
            404     => '404 Not Found',
            405     => '405 Method Not Allowed',
            406     => '406 Not Acceptable',
            407     => '407 Proxy Authentication Required',
            408     => '408 Request Timeout',
            409     => '409 Conflict',
            410     => '410 Gone',
            411     => '411 Length Required',
            412     => '412 Precondition Failed',
            413     => '413 Payload Too Large',
            414     => '414 URI Too Long',
            415     => '415 Unsupported Media Type',
            416     => '416 Range Not Satisfiable',
            417     => '417 Expectation Failed',
            418     => '418 I\'m a teapot',
            421     => '421 Misdirected Request',
            422     => '422 Unprocessable Entity',
            423     => '423 Locked',
            424     => '424 Failed Dependency',
            426     => '426 Upgrade Required',
            428     => '428 Precondition Required',
            429     => '429 Too Many Requests',
            431     => '431 Request Header Fields Too Large',
            451     => '451 Unavailable For Legal Reasons',
            
            // 5xx Server Error;
            500     => '500 Internal Server Error',
            501     => '501 Not Implemented',
            502     => '502 Bad Gateway',
            503     => '503 Service Unavailable',
            504     => '504 Gateway Timeout',
            505     => '505 HTTP Version Not Supported',
            506     => '506 Variant Also Negotiates',
            507     => '507 Insufficient Storage',
            508     => '508 Loop Detected',
            510     => '510 Not Extended',
            511     => '511 Network Authentication Required',
            
        );
    
    // } methods {
    
        // public {
            
            public function __construct($layout = null, $template = null, \core\classes\request\Request $request = null){
                $this->_layout = $layout;
                $this->_template = $template;
                $this->_request = $request;
            }// end __construct
            
            public function setHeaders(array $headers){
                $this->_headers = $headers;
            }// end setHeaders
            
            public function &getHeaders(){
                return $this->_headers;
            }// end getHeaders
            
            public function setStatus($status){
                $this->_status = $status;
            }// end setStatus
            
            public function getStatus(){
                return $this->_status;
            }// end getStatus
            
            public function assign($index, $value){
                $this->_assignments[$index] = $value;
            }// end assign
            
            public function assignAll(array $values){
                foreach($values as $index => $value){
                    $this->assign($index, $value);
                }
            }// end assignAll
            
            public function mergeAssignments(array $values){
                $this->_assignments = \array_merge($values, $this->_assignments);
            }// end mergeAssignments
            
            public function setAssignments(array $assignments){
                $this->_assignments = $assignments;
            }// end setAssignments
            
            public function &getAssignments(){
                return $this->_assignments;
            }// end getAssignments
            
            public function setRequest(\core\classes\request\Request $request){
                $this->_request = $request;
            }// end setRequest
            
            public function getRequest(){
                return $this->_request;
            }// end getRequest
            
            public function setTemplateFile($template){
                $this->_template = $template;
            }// end setTemplateFile
            
            public function getTemplateFile(){
                return $this->_template;
            }// end getTemplateFile
            
            public function setLayoutFile($layout){
                $this->_layout = $layout;
            }// end setLayoutFile
            
            public function getLayoutFile(){
                return $this->_layout;
            }// end getLayoutFile
            
            public function error($message = null){
                if(!is_null($message)){
                    $this->_add('error', $message);
                }
                else {
                    return $this->_get('error');
                }
            }// end error
            
            public function warning($message = null){
                if(!is_null($message)){
                    $this->_add('warning', $message);
                }
                else {
                    return $this->_get('warning');
                }
            }// end warning
            
            public function correct($message = null){
                if(!is_null($message)){
                    $this->_add('correct', $message);
                }
                else {
                    return $this->_get('correct');
                }
            }// end correct
            
            public function join(Response $response){
                // Replace headers:
                $this->_headers = $response->_headers;
                // Merge assigments:
                $this->_assignments = \array_merge($this->_assignments, $response->_assignments);
                // Replace request:
                $this->_request = $response->_request;
                // Replace templates:
                $this->_template = $response->_template;
                // Replace layouts:
                $this->_layout = $response->_layout;
                // Merge messages:
                $this->_messages['error'] = \array_merge($this->_messages['error'], $response->_messages['error']);
                $this->_messages['warning'] = \array_merge($this->_messages['warning'], $response->_messages['warning']);
                $this->_messages['correct'] = \array_merge($this->_messages['correct'], $response->_messages['correct']);
            }// end join
            
            public static function status($code){
                if(isset(self::$_status_code[$code])){
                    return self::$_status_code[$code];
                }
                return self::$_status_code[200];
            }// end status
            
        // } protected {
        
            protected function _add($group, $message){
                $this->_messages[$group][] = $message;
            }// end _add
            
            protected function _get($group){
                if(isset($this->_messages[$group]) && is_array($this->_messages[$group])){
                    return array_pop($this->_messages[$group]);
                }
                return null;
            }// end _get
            
        // } private {
            
        // }
    // }
}