<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\plain;

class Agreements extends \core\classes\command\panel\ListCommand {
    // vars {
        
        // Form fields:
        protected $__form         = null;
        
        protected $_user_id     = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _retrieve_id(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(!is_null($User))
                    $this->_user_id = $User->getID();
            }
    
            protected function _headers($status) {
                if($status == self::CMD_DEFAULT || $status == self::CMD_OK){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(200)
                    );
                }
                else if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/articlelist.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Form:
                $form = new \core\classes\form\Form('agreement');
                $this->__form = $form;
                
                $this->_retrieve_id();
                
                $this->_count_results();
                $this->_requested_page();
                if($this->_pages_count() < $this->_page){
                    return self::CMD_ERROR;
                }

                // Extracting comments list:
                $this->_load_list();

                // Assignments:
                $this->assignAll(array(
                    'title'            => 'Agreements',
                    
                    'agreements'       => &$this->_list,
                    'page_number'      => $this->_page,

                    // Toolbar:
                    'toolbar_left'      => array(),
                    'toolbar_right'     => array($this->_switch()),

                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _count_results() {
                try {
                    $count = \core\classes\data\Agreement::countByUserId($this->_user_id);
                    if(!is_null($count))
                        $this->_count = $count;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }
            
            protected function _load_list() {
                try {
                    $factory = new \core\classes\data\factory\Agreement();
                    $set = $factory->getByUserId($this->_user_id, $this->_page, $this->_countperpage);
                    
                    $list = array();
                    
                    if(!is_null($set)){
                        $set->accept(function($item) use(&$list){
                            if(!$item->read())
                                return false;
                            
                            $data = $item->getData();
                            $list[$item->getID()] = $data;
                            
                            if(isset($data['department_id'])){
                                $Dattributes = new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'namepath', 'name'
                                ));
                                $Dfactory = new \core\classes\data\factory\Department();
                                $department = $Dfactory->getById((int)$data['department_id']);
                                $department->setAttributeList($Dattributes);
                                $department->read();
                                
                                $list[$item->getID()]['department'] = $department->getData();
                            }
                            
                            if(isset($data['responsibility_id'])){
                                $Rattributes = new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name'
                                ));
                                $Rfactory = new \core\classes\data\factory\Responsibility();
                                $responsibility = $Rfactory->getById((int)$data['responsibility_id']);
                                $responsibility->setAttributeList($Rattributes);
                                $responsibility->read();
                                
                                $list[$item->getID()]['responsibility'] = $responsibility->getData();
                            }
                            
                            if(isset($data['working_time_id'])){
                                $Wattributes = new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name'
                                ));
                                $Wfactory = new \core\classes\data\factory\WorkingTime();
                                $working_time = $Wfactory->getById((int)$data['working_time_id']);
                                $working_time->setAttributeList($Wattributes);
                                $working_time->read();
                                
                                $list[$item->getID()]['working_time'] = $working_time->getData();
                            }
                            
                        });
                        
                        $this->_list = &$list;
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                } catch(\Exception $e){
                    // ...
                }
            }
            
        // } private {
            
            
            
        // }
    // }
}