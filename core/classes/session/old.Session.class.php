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
        protected $_cookie_id       = '__@#SESSIONID#@__'; 
        
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
                    self::$_instance = new self();
                }
                return self::$_instance;
            }// end getInstance
            
            public function abort(){
                //\session_abort();
            }// end abort
            
            public function cache_limiter($cache_limiter = null){
                /*if(is_null($cache_limiter)){
                    return \session_cache_limiter();
                }
                return \session_cache_limiter($cache_limiter);*/
            }// end cache_limiter
            
            public function cache_expire($new_cache_expire = null){
                /*if(is_null($new_cache_expire)){
                    return \session_cache_expire();
                }
                return \session_cache_expire($new_cache_expire);*/
            }// end cache_expire
            
            public function commit(){
                //\session_commit();
            }// end commit
            
            public function decode($data){
                return \json_decode($data, true);
            }// end decode
            
            public function destroy(){
                if($this->_status == \PHP_SESSION_NONE || empty($this->_SID) || $this->_closed){
                    return false;
                }
                try {
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo)) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP() FOR UPDATE');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                
                                $stmt1 = $pdo->prepare('SELECT `id` FROM `session_value` WHERE `session_id` = :id FOR UPDATE');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id));
                                    if($e){
                                        
                                        $stmt2 = $pdo->prepare('DELETE FROM `session` WHERE `id` = :id');
                                        if($stmt2){
                                            $e = $stmt2->execute(array(':id' => $id));
                                            if($e && $pdo->commit()){
                                                return true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch (\Exception $ex) {
                    throw new SessionException('Unable to destroy session', 0, $ex);
                }
                $cookie = \core\classes\cookie\Cookie::getInstance();
                $cookie->setcookie($this->_cookie_id, $this->_SID, \time() - 60 * 60, $this->_path, $this->_domain, $this->_secure, $this->_httponly);
                return true;
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
                return $this->_SID;
            }// end id
            
            public function regenerate_id(){
                
                if(empty($this->_SID) || $this->_closed || $this->_status == \PHP_SESSION_NONE) return false;
                
                // Generate session id:
                $old_sid = $this->_SID;
                $sid = $this->generate_session_id();
                
                try {
                    // Start transaction:
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo)) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND (last + INTERVAL :osduration SECOND) >= CURRENT_TIMESTAMP())) AND ((last + INTERVAL :time SECOND) >= CURRENT_TIMESTAMP()) AND ((last + INTERVAL :i SECOND) <= CURRENT_TIMESTAMP())');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime, ':i' => $this->_regeneration_interval));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                $stmt1 = $pdo->prepare('UPDATE `session` SET `sid`=:sid, `sido`=:sido WHERE `id`=:id');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id, ':sid' => $sid, ':sido' => $old_sid));
                                    if($e && $pdo->commit()){
                                        $this->_SID = $sid;
                                        $cookie = \core\classes\cookie\Cookie::getInstance();
                                        $cookie->setcookie($this->_cookie_id, $this->_SID, \time() + $this->_lifetime, $this->_path, $this->_domain, $this->_secure, $this->_httponly);
                                        return true;
                                    }
                                }
                            }
                            else {
                                return $pdo->commit();
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch(\Exception $ex){
                    throw new SessionException('Unable to regenerate session id', 0, $ex);
                }
                return false;
            }// end regenerate_id
            
            public function reset(){
                return false;
            }// end reset
            
            public function save_path($path = null){
                /*if(is_null($path)){
                    $this->_path = \session_save_path();
                }
                else {
                    $this->_path = \session_save_path($path);
                }*/
            }// end save_path
            
            public function set_cookie_params($lifetime, $path, $domain, $secure = false, $httponly = false){
                $this->_lifetime = $lifetime;
                $this->_path = $path;
                $this->_domain = $domain;
                $this->_secure = $secure;
                $this->_httponly = $httponly;
            }// end set_cookie_params
            
            public function start(array $options = array()){
                
                if($this->status() == \PHP_SESSION_ACTIVE){
                    $this->_closed = false;
                } 
                else {
                    // Generate session id:
                    $sid = $this->generate_session_id();
                    
                    // Create new session:
                    try {
                        
                        $pdo = $this->_connection->getPDO();
                        if(!$pdo) return false;
                        $stmt = $pdo->prepare('INSERT INTO session(sid, sido) VALUES(:sid, :sido)');
                        if(!$stmt) return false;
                        
                        $e = $stmt->execute(array(':sid' => $sid, ':sido' => $sid));
                        if($e){
                            $this->_SID = $sid;
                            $this->_status = \PHP_SESSION_ACTIVE;
                            // Set cookie for session id:
                            $cookie = \core\classes\cookie\Cookie::getInstance();
                            $cookie->setcookie($this->_cookie_id, $this->_SID, \time() + $this->_lifetime, $this->_path, $this->_domain, $this->_secure, $this->_httponly);
                            
                            $this->_closed = false;
                            return true;
                        }
                    } catch(\Exception $ex){
                        throw new SessionException('Unable to start session', 0, $ex);
                    }
                }
                return false;
            }// end start
            
            public function status(){
                try {
                    $this->_status = \PHP_SESSION_NONE;
                    
                    //if($this->_closed) return $this->_status;
                    
                    $pdo = $this->_connection->getPDO();
                    if(!$pdo) return $this->_status;
                    
                    $cookie = \core\classes\cookie\Cookie::getInstance();
                    $cookie_sid = isset($cookie[$this->_cookie_id]) ? $cookie[$this->_cookie_id] : '';
                    
                    $stmt = $pdo->prepare('SELECT `id`, `sid`, `sido` FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP()');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $cookie_sid, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(empty($set)) return $this->_status;

                            if(isset($set[0]) && isset($set[0]['sid'], $set[0]['sido'])){
                                $sid = $set[0]['sid'];
                                if(!empty($cookie_sid)){
                                    $this->_status = \PHP_SESSION_ACTIVE;
                                    $this->_SID = $sid;
                                    return $this->_status;
                                }
                            }
                        }
                    }
                } catch(\Exception $ex){
                    throw new SessionException('Unable to check session status', 0, $ex);
                }
                return \PHP_SESSION_NONE;
            }// end status
            
            public function write_close(){
                if($this->_status == \PHP_SESSION_ACTIVE && !$this->_closed){
                    $this->_closed = true;
                }
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
                try {
                    
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo) || empty($this->_SID) || $this->_closed) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP() LOCK IN SHARE MODE');
                    if($stmt){
                        
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                
                                $stmt1 = $pdo->prepare('SELECT `id` FROM `session_value` WHERE `session_id` = :id AND `key` = :key FOR UPDATE');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id, ':key' => $index));
                                    if($e){
                                        $value = $this->encode($newval);
                                        
                                        $result = $stmt1->fetchAll(\PDO::FETCH_ASSOC);
                                        if(!empty($result) && isset($result[0]['id'])){
                                            $value_id = $result[0]['id'];
                                            
                                            $stmt2 = $pdo->prepare('UPDATE `session_value` SET `value` = :val WHERE `id` = :id');
                                            if($stmt2){
                                                $e = $stmt2->execute(array(':val' => $value, ':id' => $value_id));
                                                if($e && $pdo->commit()){
                                                    //return true;
                                                }
                                            }
                                        }
                                        else {
                                            $stmt2 = $pdo->prepare('INSERT INTO `session_value`(`session_id`, `key`, `value`) VALUES(:sid, :k, :v)');
                                            if($stmt2){
                                                $e = $stmt2->execute(array(':sid' => $id, ':v' => $value, ':k' => $index));
                                                if($e && $pdo->commit()){
                                                    //return true;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch (\Exception $ex) {
                    throw new SessionException('Unable to set session \''.$index.'\' value', 0, $ex);
                }
            }// end offsetSet
            
            public function offsetGet($index) {
                try {
                    // Start transaction:
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo) || empty($this->_SID) || $this->_closed) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP() LOCK IN SHARE MODE');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                
                                $stmt1 = $pdo->prepare('SELECT `value` FROM `session_value` WHERE `session_id` = :id AND `key` = :key LOCK IN SHARE MODE');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id, ':key' => $index));
                                    if($e){
                                        $result = $stmt1->fetchAll(\PDO::FETCH_ASSOC);
                                        if(!empty($result) && isset($result[0]['value'])){
                                            
                                            $value = $this->decode($result[0]['value']);
                                            if($pdo->commit()){
                                                return $value;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch (\Exception $ex) {
                    throw new SessionException('Unable to get session \''.$index.'\ value', 0, $ex);
                }
                return null;
            }// end offsetGet
            
            public function offsetExists($index) {
                try {
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo) || empty($this->_SID) || $this->_closed) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP() LOCK IN SHARE MODE');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                
                                $stmt1 = $pdo->prepare('SELECT `value` FROM `session_value` WHERE `session_id` = :id AND `key` = :key LOCK IN SHARE MODE');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id, ':key' => $index));
                                    if($e){
                                        $result = $stmt1->fetchAll(\PDO::FETCH_ASSOC);
                                        if(!empty($result) && isset($result[0]['value'])){
                                            if($pdo->commit()){
                                                return true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch (\Exception $ex) {
                    throw new SessionException('Unable to check session index \''.$index.'\'', 0, $ex);
                }
                return false;
            }// end offsetExists
            
            public function offsetUnset($index) {
                try {
                    // Start transaction:
                    $pdo = $this->_connection->getPDO();
                    if(is_null($pdo) || empty($this->_SID) || $this->_closed) throw new \Exception('');
                    
                    $pdo->setTransactionIsolationLevel(READ_COMMITED);
                    if(!$pdo->startTransaction()) throw new \Exception('');
                    
                    $stmt = $pdo->prepare('SELECT id FROM `session` WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP() LOCK IN SHARE MODE');
                    if($stmt){
                        $e = $stmt->execute(array(':sid' => $this->_SID, ':osduration' => $this->_old_session_duration, ':time' => $this->_lifetime));
                        if($e){
                            $session_set = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                            if(!empty($session_set) && isset($session_set[0]['id'])){
                                $id = $session_set[0]['id'];
                                
                                $stmt1 = $pdo->prepare('SELECT `id` FROM `session_value` WHERE `session_id` = :id AND `key` = :key FOR UPDATE');
                                if($stmt1){
                                    $e = $stmt1->execute(array(':id' => $id, ':key' => $index));
                                    if($e){
                                        $result = $stmt1->fetchAll(\PDO::FETCH_ASSOC);
                                        if(!empty($result) && isset($result[0]['id'])){
                                            $value_id = $result[0]['id'];
                                            
                                            $stmt2 = $pdo->prepare('DELETE FROM `session_value` WHERE `id` = :id');
                                            if($stmt2){
                                                $e = $stmt2->execute(array(':id' => $value_id));
                                                if($e){
                                                    $pdo->commit();
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $pdo->rollBack();
                } catch (\Exception $ex) {
                    throw new SessionException('Unable to unset session index \''.$index.'\'', 0, $ex);
                }
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
                if($this->_status == \PHP_SESSION_ACTIVE && !$this->_closed){
                    
                }
            }// end __destruct
            
        // } protected {
            
            public function __construct(){
                
            }// end __construct
            
        // } private {
            
        // }
    // }
}