<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\menu
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2017
 */

namespace core\classes\menu;

class Menu {
    // vars {
        
        // Menu configuration:
        private $__menu_dirpath         = '';
        private $__menu_filename        = '';
        
        protected $_menu                = array();
        
        private $__empty                = array();
        
    // } methods {
    
        // public {
            
            public function __construct($dirname, $filename){
                $this->__menu_dirpath = $dirname;
                $this->__menu_filename = $filename;
            }// end __construct
            
            public function initialize(){
                // Menu initialization:
                $this->_menu = $this->_parseMenu($this->__menu_dirpath, $this->__menu_filename);
                //\PanelRegistry::setMenu($this->_menu);
                return true;
            }
            
            public function filter(\core\classes\domain\AuthorizedUser $user, \core\classes\request\Request $request){
                $this->_menu = $this->_filter_menu($this->_menu, $user, $request);
            }
            
            public function selectActiveOptions(\core\classes\request\Request $request){
                $this->_select_active_option($this->_menu, $request);
            }
            
            public function &extractSubMenu(\core\classes\request\Request $request){
                return $this->_extract_submenu($this->_menu, $request);
            }
            
            public function getMenu(){
                return $this->_menu;
            }
            
        // } protected {
            
            protected function _parseMenu($dirpath, $filename){
                $menu_filename = \realpath(\dirname(__FILE__).'/'.$dirpath.'/'.$filename);
                if(\file_exists($menu_filename)){
                    try {
                        $menu = \simplexml_load_file($menu_filename);
                        if($menu instanceof \SimpleXMLElement){
                            return $this->_perform_reading_xml_file($menu);
                        }
                    } catch (\Exception $ex) {
                        throw new MenuException(\core\functions\replace(
                                Error::get('read_xml_file'),
                                array('$file'   => $filename)
                            ), 0, $ex);
                    }
                } else {
                    throw new MenuException(\core\functions\replace(
                            Error::get('menu_xml_file_not_exists'),
                            array('$file' => $filename)
                        ));
                }
            }// end _parseMenu
            
            protected function _perform_reading_xml_file(\SimpleXMLElement $sxe){
                // Menu array:
                $menu = array();
                $count = 1;
                
                // Fetching options attributes:
                $group_access = array();
                if(isset($sxe->options['access'])){
                    $group_access = self::__filter((string)$sxe->options['access']);
                    // Cleaning:
                    if(\strpos($group_access, ';') || \strpos($group_access, ' ')){
                        $group_access = \preg_replace('/[;\s]/i', '', $group_access);
                    }
                    if(\strpos($group_access, ':')){
                        list($modifier, $value) = explode(':', $group_access);
                        $group_access = array($modifier => $value);
                    }
                    else {
                        $group_access = array($group_access => 'all');
                    }
                }
                
                // Reading options:
                foreach($sxe->options->option as $option){
                    
                    // Fetch id attribute:
                    $id = "option_".$count;
                    if(isset($option['id'])){
                        $id = self::__filter((string)$option['id']);
                    }
                    
                    // Fetch name attribute:
                    $name = "Option_".$count;
                    if(isset($option['name'])){
                        $name = self::__filter((string)$option['name']);
                    }
                    
                    // Fetch href attribute:
                    $href = '';
                    if(isset($option['href'])){
                        $href = self::__filter((string)$option['href']);
                        $href = \core\functions\replace($href, array(
                            '$home'     => \core\functions\address(),
                            '$panel'    => \core\functions\address().'/panel',
                            '$user_id'  => \PanelRegistry::getCurrentUser()->getID(),));
                    }
                    
                    // Fetch access attribute:
                    $access = array();
                    if(isset($option['access'])){
                        $access = self::__filter((string)$option['access']);
                        // Cleaning:
                        if(\strpos($access, ';') || \strpos($access, ' ')){
                            $access = \preg_replace('/[;\s]/i', '', $access);
                        }
                        if(\strpos($access, ':')){
                            list($modifier, $value) = explode(':', $access);
                            $access = array($modifier => $value);
                        }
                        else {
                            $access = array($access => 'all');
                        }
                    }
                    else if(!empty($group_access)){
                        $access = $group_access;
                    }
                    
                    // Fetch command attribute:
                    $command = '';
                    if(isset($option['command'])){
                        $command = self::__filter((string)$option['command']);
                    }
                    
                    // Fetch visibility attribute:
                    $visibility = 'normal';
                    if(isset($option['visibility'])){
                        $visibility = self::__filter((string)$option['visibility']);
                    }
                    
                    // Fetch submenu:
                    $sub = array();
                    if(isset($option->options)){
                        $sub = $this->_perform_reading_xml_file($option);
                    }
                    
                    // Assign attributes:
                    $arr = array(
                        'id'        => $id,
                        'name'      => $name,
                        'href'      => $href,
                        'access'    => $access,
                        'command'   => $command,
                        'visibility'=> $visibility,
                        'menu'      => $sub
                    );
                    
                    // Optional attributes:
                    // Fetch multistep attribute:
                    $multistep = '';
                    if(isset($option['multistep'])){
                        $multistep = self::__filter((string)$option['multistep']);
                        if(!empty($multistep)){
                            $arr['multistep'] = $multistep;
                        }
                    }
                    
                    // Add option to array:
                    $menu[strtolower($id)] = $arr;
                    
                    $count++;
                }
                return $menu;
            }// end _perform_reading_xml_file
            
            protected function _filter_menu(array $menu, \core\classes\domain\AuthorizedUser $user, \core\classes\request\Request $request, $multistep = ''){
                $result = array();
                // Extract multistep options (if available):
                $m = false;
                $step = 1;
                $end = 1;
                
                $request_name = '';
                if(isset($request[\core\classes\request\Request::PANEL_CMD]))
                    $request_name = $request[\core\classes\request\Request::PANEL_CMD];
                
                if(!empty($multistep)){
                    $m = true;
                    $session = \core\classes\session\Session::getInstance();
                    if(isset($session[$multistep]) && isset($session[$multistep]['step'])){
                        $end = (int)$session[$multistep]['step'];
                    }
                }
                
                if($user instanceof \core\classes\domain\Administrator){
                    foreach($menu as $name => $option){
                        $access = $option['access'];
                        
                        if(isset($option['visibility']) && $option['visibility'] == "none")
                            continue;
                        
                        if(isset($option['visibility']) && $option['visibility'] == "command")
                            if($option['command'] != $request_name)
                                continue;
                        
                        if((isset($access[PLAIN]) && $access[PLAIN] != 'only') ||
                           (isset($access[PUBLICIST]) && $access[PUBLICIST] != 'only') ||
                           isset($access[ADMINISTRATOR]) ||
                           empty($access)){
                            $result[$name] = array(
                                'name'      => $option['name'],
                                'href'      => $option['href'],
                                'command'   => $option['command'],
                                'active'    => false,
                                'menu'      => $this->_filter_menu($option['menu'], $user, $request, isset($option['multistep']) ? $option['multistep'] : '')
                            );
                        }
                        if($m && ($step == $end)){
                            break;
                        }
                        ++$step;
                    }
                }
                
                else if($user instanceof \core\classes\domain\Publicist){
                    
                    foreach($menu as $name => $option){
                        $access = $option['access'];
                        
                        if(isset($option['visibility']) && $option['visibility'] == "none")
                            continue;
                        
                        if(isset($option['visibility']) && $option['visibility'] == "command")
                            if($option['command'] != $request_name)
                                continue;
                        
                        if((isset($access[PLAIN]) && $access[PLAIN] != 'only') ||
                           isset($access[PUBLICIST])){
                            $result[$name] = array(
                                'name'      => $option['name'],
                                'href'      => $option['href'],
                                'command'   => $option['command'],
                                'active'    => false,
                                'menu'      => $this->_filter_menu($option['menu'], $user, $request, isset($option['multistep']) ? $option['multistep'] : '')
                            );
                        }
                        if($m && ($step == $end)){
                            break;
                        }
                        ++$step;
                    }
                    
                }
                
                else if($user instanceof \core\classes\domain\Plain){
                    
                    foreach($menu as $name => $option){
                        $access = $option['access'];
                        
                        if(isset($option['visibility']) && $option['visibility'] == "none")
                            continue;
                        
                        if(isset($option['visibility']) && $option['visibility'] == "command")
                            if($option['command'] != $request_name)
                                continue;
                            
                        
                        if(isset($access[PLAIN])){
                            $result[$name] = array(
                                'name'      => $option['name'],
                                'href'      => $option['href'],
                                'command'   => $option['command'],
                                'active'    => false,
                                'menu'      => $this->_filter_menu($option['menu'], $user, $request, isset($option['multistep']) ? $option['multistep'] : '')
                            );
                        }
                        if($m && ($step == $end)){
                            break;
                        }
                        ++$step;
                    }
                    
                }
                return $result;
            }// end _filter_menu
            
            protected function _select_active_option(array &$menu, \core\classes\request\Request $request){
                if(isset($request[\core\classes\request\Request::PANEL_CMD])){
                    $request_name = $request[\core\classes\request\Request::PANEL_CMD];
                    foreach($menu as $name => &$option){
                        if(!empty($option['menu'])){
                            $p = $this->_select_active_option($option['menu'], $request);
                            if($p){
                                $option['active'] = true;
                                return true;
                            }
                        }
                        if($request_name == $option['command']){
                            $option['active'] = true;
                            return true;
                        }
                    }
                }
                return false;
            }// end _select_active_option
            
            protected function &_extract_submenu(array &$menu, \core\classes\request\Request $request){
                if(isset($request[\core\classes\request\Request::PANEL_CMD])){
                    $request_name = $request[\core\classes\request\Request::PANEL_CMD];
                    foreach($menu as &$option){
                        if($this->__find_branch($option['menu'], $request_name)){
                            return $option['menu'];
                        }
                        if($request_name == $option['command']){
                            return $option['menu'];
                        }
                    }
                }
                return $this->__empty;
            }// end _extract_submenu
            
        // } private {
            
            private function __find_branch(array &$menu, $request_name){
                foreach($menu as &$option){
                    if(!empty($option['menu'])){
                        if($this->__find_branch($option['menu'], $request_name)){
                            return true;
                        }
                    }
                    if($request_name == $option['command']){
                        return true;
                    }
                }
                return false;
            }// end __find_branch
            
            private static function __filter($str){
                return \htmlspecialchars(\trim($str));
            }// end __filter
            
        // }
    // }
}