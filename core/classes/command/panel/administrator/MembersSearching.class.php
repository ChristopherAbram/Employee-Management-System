<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.10.2016
 */

namespace core\classes\command\panel\administrator;

class MembersSearching extends Members {
    // vars {
        
       protected $filterList = null;
    
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
            
            protected function _styles($status){
                return array(
                    'panel/list.style.css',
                    'panel/itemlist.style.css',
                    'panel/filelist.style.css',
                    'panel/listbutton.style.css',
                    'panel/switchpage.style.css',
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
               
                $this->filterList = new \core\classes\filter\ListFilters();
                $this->filterList->setTables(array('user'));
                
                $dbFirstname = new \core\classes\filter\exec\Database('firstname', 'user');
                $dbLastname = new \core\classes\filter\exec\Database('lastname', 'user');
                $dbEmail = new \core\classes\filter\exec\Database('email', 'user');
                $dbReg = new \core\classes\filter\exec\Database('cdate', 'user');
                
                $firstnameButton = (new \core\classes\filter\Button($dbFirstname))->setID('firstnameButton')->setName('Firstname')->setSide(0);
                $lastnameButton = (new \core\classes\filter\Button($dbLastname))->setID('lastnameButton')->setName('Lastname')->setSide(0);
                $emailButton = (new \core\classes\filter\Button($dbEmail))->setID('emailButton')->setName('E-mail')->setSide(0);
                $regButton = (new \core\classes\filter\Button($dbReg))->setID('regButton')->setName('Registration')->setSide(0);
                
                $firstnameFilter = new \core\classes\filter\TextFilter($dbFirstname, $firstnameButton->getID());
                $lastnameFilter = new \core\classes\filter\TextFilter($dbLastname, $lastnameButton->getID());
                $emailFilter = new \core\classes\filter\TextFilter($dbEmail, $emailButton->getID());
                $regFilter = new \core\classes\filter\TextFilter($dbReg, $regButton->getID());
                
                $this->filterList->addFilter($firstnameFilter);
                $this->filterList->addFilter($lastnameFilter);
                $this->filterList->addFilter($emailFilter);
                $this->filterList->addFilter($regFilter);
                
                $this->filterList->permuteList();
                
                
                $status =  parent::_execute($request);
                
                $firstnameButton->setSubstituents( array( 'options' => $firstnameFilter->activeFilters()));
                $lastnameButton->setSubstituents( array( 'options' => $lastnameFilter->activeFilters()));
                $emailButton->setSubstituents( array( 'options' => $emailFilter->activeFilters()));
                $regButton->setSubstituents( array( 'options' => $regFilter->activeFilters()));
                
                $this->assignAll(array(
                    'firstname_button' => $firstnameButton->writeButton(),
                    'lastname_button' => $lastnameButton->writeButton(),
                    'email_button' => $emailButton->writeButton(),
                    'reg_button' => $regButton->writeButton(),
                ));
                
                return $status;
            }// end _execute
            
            protected function __count_users(){
                $this->filterList->setPosition(0)
                        ->setLimit(1)
                        ->setExtraConditions('bin=0', 'AND')
                        ->setDefaultListOrder(array('cdate'), 'DESC')
                        ->setColumns(array('COUNT(id) as amount'));
                
                $a = array();
                $a = $this->filterList->perform();
                
                $a = isset( $a[ 0 ][ 'amount' ] ) ? $a[ 0 ][ 'amount' ] : 1 ;
                return $a;
            }// end __count_users
            
            protected function __member_list(){
                $factory = new \core\classes\domain\factory\Plain();
                try {
                    $this->filterList->setPosition(($this->__page - 1) * $this->__countperpage)->setLimit($this->__countperpage)->setColumns( array( 'id' ) );
                    $results = $this->filterList->perform();
                    $set = new \core\classes\domain\collection\set\User($this->_extract($results));
                    
                    $this->_load_user_data($set);
                    
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __page_list
            
            protected function _extract($result){
                $ids = array();
                foreach($result as $val){
                    $ids[] = $val['id'];
                }
                return $ids;
            }
            
        // } private {
            
           
            
        // }
    // }
}