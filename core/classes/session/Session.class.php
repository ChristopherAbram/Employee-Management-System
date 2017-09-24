<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\session
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\session;

class Session implements \ArrayAccess {
    // vars {
        
        // Cookie identifier:
        protected $_cookie_id       = '__@#_1SESSIONID2_#@__'; 
        
        // Lifetime of the session cookie, defined in seconds.
        protected $_lifetime        = 600;
        
        // Path on the domain where the cookie will work. Use a single slash ('/') 
        // for all paths on the domain.
        protected $_path            = '/';
        
        // Cookie domain, for example 'www.php.net'. To make cookies visible on 
        // all subdomains then the domain must be prefixed with a dot like '.php.net'.
        protected $_domain          = '';
        
        // If TRUE cookie will only be sent over secure connections.
        protected $_secure          = FALSE;
        
        // If set to TRUE then PHP will attempt to send the httponly flag when 
        // setting the session cookie.
        protected $_httponly        = TRUE;
        
        // Session id:
        protected $_SID             = '';
        
        // Is session closed:
        protected $_closed          = false;
        
        // Instance:
        protected static $_instance = null;
        
        // Started session status:
        protected $_status          = \PHP_SESSION_NONE;
        protected $_started         = FALSE;
        const ENABLED               = TRUE;
        const DISABLED              = FALSE;
        
        // Data connection instance:
        protected $_connection      = null;
        
        // Session parameters:
        protected $_old_session_duration    = 2;
        protected $_regeneration_interval   = 60;
        
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$_instance)){
                    self::$_instance = new Session();
                }
                return self::$_instance;
            }// end getInstance
            
            public function abort(){
                \session_abort();
            }// end abort
            
            public function cache_limiter($cache_limiter = null){
                if(is_null($cache_limiter)){
                    return \session_cache_limiter();
                }
                return \session_cache_limiter($cache_limiter);
            }// end cache_limiter
            
            public function cache_expire($new_cache_expire = null){
                if(is_null($new_cache_expire)){
                    return \session_cache_expire();
                }
                return \session_cache_expire($new_cache_expire);
            }// end cache_expire
            
            public function commit(){
                \session_commit();
            }// end commit
            
            public function decode($data){
                return \json_decode($data, true);
            }// end decode
            
            public function destroy(){
                if($this->status() == \PHP_SESSION_ACTIVE){
                    //$_SESSION = array();
                    \session_unset();
                    $cookie = \core\classes\cookie\Cookie::getInstance();
                    if(isset($cookie[$this->name()])){
                        $cookie->setcookie($this->name(), '', \time() - 60 * 60, $this->_path, $this->_domain, $this->_secure, $this->_httponly);
                    }
                    return \session_destroy();
                }
                return false;
            }// end destroy
            
            public function encode($data){
                return \json_encode($data);
            }// end encode
            
            public function generate_session_id(){
                $time = \microtime();
                if( isset( $_SERVER['HTTP_CLIENT_IP'] ) ){
                $ip = $_SERVER['HTTP_CLIENT_IP'];
                } else if( isset( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ){
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
                $ip = ip2long( $ip );
                $client_ip = $ip;
                $lcg_value = \lcg_value();
                $id = \md5($time.$client_ip.$lcg_value);
                return $id;
            }// end generate_session_id
            
            public function get_cookie_params(){
                return $this->getOptions();
            }// end get_cookie_params
            
            public function id(){
                return \session_id();
            }// end id
            
            public function name($name = null){
                if(!is_null($name))
                    return \session_name ($name);
                return \session_name();
            }
            
            public function regenerate_id(){
                if(isset($this['created']) && (\time() - $this['created']) > $this->_regeneration_interval){
                    \session_regenerate_id(true);
                    $this['created'] = \time();
                }
                return true;
            }// end regenerate_id
            
            public function reset(){
                return false;
            }// end reset
            
            public function save_path($path = null){
                if(!is_null($path))
                    return \session_save_path ($path);
                return \session_save_path();
            }// end save_path
            
            public function set_cookie_params($lifetime, $path, $domain, $secure = false, $httponly = false){
                $this->_lifetime = $lifetime;
                $this->_path = $path;
                $this->_domain = $domain;
                $this->_secure = $secure;
                $this->_httponly = $httponly;
            }// end set_cookie_params
            
            public function start(array $options = array()){
                if($this->status() != \PHP_SESSION_ACTIVE)
                    \session_start();
                
                if(isset($this['last_activity']) && (\time() - $this['last_activity']) > $this->_lifetime){
                    $this->destroy();
                    \session_start();
                    
                }
                $this['last_activity'] = \time();
                
                if(!isset($this['created'])){
                    $this['created'] = \time();
                }
                return true;
            }// end start
            
            public function status(){
                return \session_status();
            }// end status
            
            public function write_close(){
                return \session_write_close();
            }// end write_close
            
            public function getOptions(){
                return array(
                    'lifetime'      => $this->_lifetime,
                    'path'          => $this->_path,
                    'domain'        => $this->_domain,
                    'secure'        => $this->_secure,
                    'httponly'      => $this->_httponly
                );
            }// end getOptions
            
            public function offsetSet($index, $newval) {
                $_SESSION[$index] = $newval;
            }// end offsetSet
            
            public function offsetGet($index) {
                return $_SESSION[$index];
            }// end offsetGet
            
            public function offsetExists($index) {
                return isset($_SESSION[$index]);
            }// end offsetExists
            
            public function offsetUnset($index) {
                unset($_SESSION[$index]);
            }// end offsetUnset
            
            public function setLifetime($lifetime){
                $this->_lifetime = $lifetime;
            }// end setLifetime
            
            public function setOldSessionDuration($session_duration){
                $this->_old_session_duration = $session_duration;
            }// setOldSessionDuration
            
            public function setRegenerationInterval($interval){
                $this->_regeneration_interval = $interval;
            }// setRegenerationInterval
            
            public function setConnection(\core\classes\connection\Connection $connection){
                $this->_connection = $connection;
            }// end setConnection

            public function __destruct(){
                
            }// end __destruct
            
        // } protected {
            
            protected function __construct(){
                $this->name($this->_cookie_id);
                //\session_set_cookie_params($this->_lifetime, $this->_path, $this->_domain, $this->_secure);
            }// end __construct
            
        // } private {
            
        // }
    // }
}