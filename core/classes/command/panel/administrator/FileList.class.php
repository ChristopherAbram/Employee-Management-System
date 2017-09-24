<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	29.09.2016
 */

namespace core\classes\command\panel\administrator;

class FileList extends \core\classes\command\panel\publicist\File {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                if($status == self::CMD_ERROR){
                    return array(
                        'Content-Type: text/html; charset=utf-8',
                        \core\functions\status(404)
                    );
                }
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
        // } private {
            
            protected function __count_files(\core\classes\domain\User $User){
                try {
                    $count = \core\classes\data\FileInfo::countNotRemoved();
                    if(!is_null($count)){
                        $this->__count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __count
            
            protected function __file_list(\core\classes\domain\User $User){
                try {
                    $factory = new \core\classes\domain\factory\File();
                    $set = $factory->getNotRemoved($this->__page, $this->__countperpage);
                    if(!is_null($set)){
                        // Load all necessary data:
                        $set->load(new \core\classes\sql\attribute\AttributeList(array(
                            'id', 'name', 'description', 'mime', 'extension', 'bin', 'hide', 'locked', 'size', 'cdate'
                        )));
                        
                        // Load basic user data:
                        $set->accept(function($File){
                            $User = $File->getUser();
                            if(!is_null($User)){
                                $User->loadUserRole();
                                return $User->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'firstname', 'lastname'
                                )));
                            }
                        });
                        
                        // Extract data:
                        foreach($set as $File){
                            $this->__list[] = $File->getPresentationData();
                        }
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __file_list
            
            protected function __switch(){
                $all = $this->__pages_count();
                $html = '<div class="switch_result_page">';
                // Prev:
                if($this->__page == 1){
                    $html .= '<span class="prev">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="prev" href="'.\core\functions\address().'/panel/files/'.($this->__page - 1).'" title="prev">&nbsp;</a>';
                }
                // Count:
                $html .= '<span class="pages">'.$this->__page.' / '.$all.'</span>';
                
                // Next
                if($this->__page == $all){
                    $html .= '<span class="next">&nbsp;</span>';
                }
                else {
                    $html .= '<a class="next" href="'.\core\functions\address().'/panel/files/'.($this->__page + 1).'" title="next">&nbsp;</a>';
                }
                $html .= '</div>';
                return $html;
            }// end __switch_all
            
        // }
    // }
}