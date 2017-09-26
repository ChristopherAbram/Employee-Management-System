<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.09.2017
 */

namespace core\classes\command\panel;

abstract class ListCommand extends \core\classes\command\ListCommand {
    // vars {
        
        protected $_command = '';
    
    // } methods {
    
        // public {
        
            public function execute(\core\classes\request\Request $request) {
                parent::execute($request);
                if(isset($request[\core\classes\request\Request::PANEL_CMD]))
                    $this->_command = $request[\core\classes\request\Request::PANEL_CMD];
            }
            
        // } protected {
    
            protected function _modify(\core\classes\data\factory\Factory $factory, $requsted, $column, $value){
                
                // Attribute list:
                $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));
                
                if(isset($this->_request[$requsted])){
                    $item_list = $this->_request[$requsted];
                    
                    foreach($item_list as $id => $val){
                        $item = $factory->getById($id);
                        if(!is_null($item)){
                            $item->setAttributeList($attributes);
                            $data = $item->getData();
                            // Change data:
                            $data[$column] = $value;
                            $item->setData($data);
                        }
                    }
                    
                    $watcher = \core\classes\data\DataWatcher::getInstance();
                    if($watcher->perform()){
                        $this->correct(Correct::get('update'));
                    }
                    else {
                        $this->error(Error::get('update'));
                    }
                }
            }// end _modify
        
            protected function _switch($namepath = ''){
                $all = $this->_pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->_page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/'.$this->_command.'/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->_page.' / '.$all.'</span>';
                
                // Next
                if($this->_page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/'.$this->_command.'/'.(!empty($namepath) ? $namepath.'/' : '').''.($this->_page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // } private {
            
        // }
    // }
}