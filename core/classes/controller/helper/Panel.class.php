<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\helper
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\controller\helper;

class Panel extends Helper {
    // vars {
        
        // Instance:
        private static $__instance      = null;
        
        // Controller Map instance:
        private $__map                  = null;
        
        // Configuration file pathway:
        private $__control_file_dirpath = '../../../private/panel';
        private $__control_file_name    = 'control.setting.xml';
        
        // Menu configuration:
        private $__menu_dirpath         = '../../../private/panel';
        private $__menu_filename        = 'menu.setting.xml';
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public function init(){
                // init application configurations:
                try {
                    \PanelRegistry::getInstance();
                } catch(\Exception $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('panel_registry'), 0, $ex);
                }
                // init application control flow map:
                try {
                    $control = new \core\classes\control\Control($this->__control_file_dirpath, $this->__control_file_name);
                    $control->parse();
                    $this->__map = $control->getMap();
                    \PanelRegistry::setControllerMap($this->__map);
                } catch(\core\classes\control\ControlException $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('config_init'), 0, $ex);
                }
                // Connection timeout:
                \ConnectionRegistry::setConnectionTimeout(\ApplicationRegistry::getConnectionTimeoutValue());
                // Connect to the database:
                try {
                    \ConnectionRegistry::establishUserConnection();
                } catch (\PDOException $ex) {
                    throw new \core\classes\controller\ControllerException(Error::get('connection_init'), 0, $ex);
                }
                // Start application session:
                $session = \core\classes\session\Session::getInstance();
                $session->setConnection(\ConnectionRegistry::getUserEstablishedConnection());
                
                $session->setLifetime(\ApplicationRegistry::getSessionExpireTime());
                $session->setOldSessionDuration(\ApplicationRegistry::getOldSessionDuration());
                $session->setRegenerationInterval(\ApplicationRegistry::getSessionRegenerationInterval());
                
                $session->start();
                $session->regenerate_id();
                // init logged user instance:
                try {
                    $user = \core\classes\domain\factory\User::getLoggedUser();
                    $this->_load_user_basic_data($user);
                    \PanelRegistry::setCurrentUser($user);
                } catch(\core\classes\domain\DomainException $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('user_init'), 0, $ex);
                }
                // Menu initialization:
                try {
                    $menu = new \core\classes\menu\Menu($this->__menu_dirpath, $this->__menu_filename);
                    $menu->initialize();
                    
                    \PanelRegistry::setMenu($menu);
                } catch (\Exception $ex) {
                    throw new \core\classes\menu\MenuException(Error::get('menu_init'), 0, $ex);
                }
                // perform other useful initializations...
                return true;
            }// end init
            
            public function getMap(){
                return $this->__map;
            }// end getMap
            
        // } protected {
        
            
            
        // } private {
            
            private function __construct(){}
            
        // }
    // }
}