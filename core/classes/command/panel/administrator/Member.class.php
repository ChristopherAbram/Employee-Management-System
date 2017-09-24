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

class Member extends \core\classes\command\Editor {
    // vars {
        
        // Form fields:
        private $__form         = null;
        
        // Buttons:
        private $__save         = null;
        private $__activate     = null;
        private $__deactivate   = null;
        private $__remove       = null;
        
        private $__firstname    = null;
        private $__lastname     = null;
        private $__description  = null;
        private $__email        = null;
        private $__phone        = null;
        private $__admin        = null;
        private $__publ         = null;
        private $__plain        = null;
        private $__cdate        = null;
        private $__bdate        = null;
        private $__citation     = null;
        private $__isactive     = null;
        
        private $__data         = array();
        private $__category     = array();
        private $__user_page    = array();
        private $__request      = null;
    
    // } methods {
    
        // public {
            
            public function _activate(){
                $this->_modify('isactive', 1);
            }// end _activate
            
            public function _deactivate(){
                $this->_modify('isactive', 0);
            }// end _deactivate
            
            public function _remove(){
                $this->_modify('bin', 1);
            }// end _remove
            
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
                    'panel/switchpage.style.css',
                );
            }// end _styles
            
            protected function _update(){
                try {
                    
                    // If user is not pointed:
                    $user_id = $this->__get_user_id($this->__request);
                    if(is_null($user_id)){
                        return false;
                    }
                    
                    // Get user by its identifier or quit if there is problem:
                    $User = $this->__get_user_by_id($user_id);
                    if(is_null($User)){
                        return false;
                    }
                    
                    // Get data object:
                    $data = $User->getData();
                    if(is_null($data)){
                        return false;
                    }
                    
                    // Extract setting - user role:
                    $d = $data->getData();
                    $d['user_role_id'] = isset($_POST['user_role']) ? (int)$_POST['user_role'] : 3;
                    $data->setData($d);
                    
                    // Extract page list if available:
                    
                    //$connection = \ConnectionRegistry::g
                    
                    \core\classes\data\UserPage::deleteByUserId($User->getID());
                    if(isset($this->__request['page'])){
                        $pages = $this->__request['page'];
                        //\core\classes\data\UserPage::deleteByUserId($User->getID());
                        foreach($pages as $id){
                            $user_page = new \core\classes\data\UserPage();
                            
                            $user_page->setData(array(
                                'user_id'   => $User->getID(),
                                'page_id'   => (int)$id
                            ));
                            if(!$user_page->create()){
                                $this->error(Error::get('update'));
                                return false;
                            }
                        }
                    }
                    
                    // Do update:
                    $data->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'user_role_id')));
                    if($data->update()){
                        $this->correct(Correct::get('update'));
                        return true;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
                $this->error(Error::get('update'));
                return false;
            }// end _update
            
            protected function _read(){
                
                // If user is not pointed:
                $user_id = $this->__get_user_id($this->__request);
                if(is_null($user_id)){
                    return false;
                }
                
                // Get user by its identifier or quit if there is problem:
                $User = $this->__get_user_by_id($user_id);
                if(is_null($User)){
                    return false;
                }
                
                // Do load user data:
                $this->__load_member_data($User);
                $this->__data = &$User->getPresentationData();
                
                // Additionally load category tree (if user is at least publicist):
                if($this->__data['role']['access_level'] <= 1){
                    // Loads page tree structure:
                    $this->__page_list();
                    // Loads user page association table:
                    $this->__load_user_page($User);
                    // Mark prevoiusly selected category as checked:
                    $this->__mark_selected($this->__category);
                }
                
                if(!$this->__form->submitted()){
                    // Load form:
                    $this->__init_form_values();
                    return true;
                }
                return true;
            }// end _read
            
            protected function _create(){ }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                $this->__request = $request;
                
                // If user is not pointed:
                $user_id = $this->__get_user_id($request);
                if(is_null($user_id)){
                    return self::CMD_ERROR;
                }
                
                // Get user by its identifier or quit if there is problem:
                $User = $this->__get_user_by_id($user_id);
                if(is_null($User)){
                    return self::CMD_ERROR;
                }
                
                // Turn mode to UPDATE:
                $this->_mode(self::UPDATE);
                
                // Form:
                $form = new \core\classes\form\Form('member');
                $this->__form = $form;
                
                // Initializing form fields
                $firstname          = $this->__firstname();
                $lastname           = $this->__lastname();
                $description        = $this->__description();
                $email              = $this->__email();
                $phone              = $this->__phone();
                $administrator      = $this->__administrator();
                $publicist          = $this->__publicist();
                $plain              = $this->__plain();
                $cdate              = $this->__cdate();
                $bdate              = $this->__bdate();
                $citation           = $this->__citation();
                $save               = $this->__save();
                $activate           = $this->__activate();
                $deactivate         = $this->__deactivate();
                $remove             = $this->__remove();
                
                // Composing form:
                $form->attach($firstname);
                $form->attach($lastname);
                $form->attach($description);
                $form->attach($email);
                $form->attach($phone);
                $form->attach($administrator);
                $form->attach($publicist);
                $form->attach($plain);
                $form->attach($cdate);
                $form->attach($bdate);
                $form->attach($citation);
                $form->attach($save);
                $form->attach($activate);
                $form->attach($deactivate);
                $form->attach($remove);
                
                

                // Button functions:
                $activate->onsubmit(array($this, '_activate'));
                $deactivate->onsubmit(array($this, '_deactivate'));
                $remove->onsubmit(array($this, '_remove'));
                
                // Performing save operation:
                if($this->__save->submitted()){
                    if($this->_save()){ }
                }
                
                // Read user data:
                if(!$this->_read()){
                    $this->error(Error::get('user_read'));
                }
                
                /*
                echo '<pre>';
                print_r($this->__data);
                print_r($this->__user_page);
                print_r($this->__category);
                print_r($this->__user_page);
                echo '</pre>';
                die();
                */
                
                $this->assignAll(array(
                    
                    'title'             => 'Member',
                    'description'       => '',
                    
                    // User data:
                    'user'              => &$this->__data,
                    
                    'categories'        => $this->__html_list($this->__category),
                    
                    // Form:
                    'firstname'         => array(
                        'title'         => 'Firstname',
                        'input'         => $firstname,
                        'description'   => ''
                    ),
                    
                    'lastname'          => array(
                        'title'         => 'Lastname',
                        'input'         => $lastname,
                        'description'   => ''
                    ),
                    
                    'description_'       => array(
                        'title'         => 'Description',
                        'input'         => $description,
                        'description'   => ''
                    ),
                    
                    'email'             => array(
                        'title'         => 'e-mail',
                        'input'         => $email,
                        'description'   => ''
                    ),
                    
                    'phone'             => array(
                        'title'         => 'Phone',
                        'input'         => $phone,
                        'description'   => ''
                    ),
                    
                    'citation'          => array(
                        'title'         => 'Citation',
                        'input'         => $citation,
                        'description'   => ''
                    ),
                    
                    'cdate'             => array(
                        'title'         => 'Registration date',
                        'input'         => $cdate,
                        'description'   => ''
                    ),
                    
                    'bdate'             => array(
                        'title'         => 'Birth date',
                        'input'         => $bdate,
                        'description'   => ''
                    ),
                    
                    'administrator'     => array(
                        'title'         => 'Administrator',
                        'input'         => $administrator,
                        'description'   => ''
                    ),
                    
                    'publicist'         => array(
                        'title'         => 'Publicist',
                        'input'         => $publicist,
                        'description'   => ''
                    ),
                    
                    'plain'         => array(
                        'title'         => 'Plain',
                        'input'         => $plain,
                        'description'   => ''
                    ),
                    
                    // Toolbar:
                    'toolbar_left'      => array($save, $activate),
                    'toolbar_right'     => array($remove, $deactivate),
                    
                ));
                
                return self::CMD_OK;
            }// end _execute
            
            protected function _modify($column, $value){
                try {
                    // User factory:
                    $factory = new \core\classes\data\factory\User();
                    // Attribute list:
                    $attributes = new \core\classes\sql\attribute\AttributeList(array('id', $column));

                    if(isset($this->__request['user'])){
                        $user_id = (int)$this->__request['user'];
                        
                        $user = $factory->getById($user_id);
                        if(!is_null($user)){
                            $user->setAttributeList($attributes);
                            $data = $user->getData();
                            
                            // Change data:
                            $data[$column] = $value;
                            $user->setData($data);
                            
                            // Do update:
                            if($user->update()){
                                $this->correct(Correct::get('update'));
                            }
                            else {
                                $this->error(Error::get('update'));
                            }
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _modify
            
        // } private {
            
            private function __init_form_values(){
                if(!empty($this->__data)){
                    $this->__firstname->value(isset($this->__data['firstname']) ? $this->__data['firstname'] : '');
                    $this->__lastname->value(isset($this->__data['lastname']) ? $this->__data['lastname'] : '');
                    $this->__email->value(isset($this->__data['email']) ? $this->__data['email'] : '');
                    $this->__citation->value(isset($this->__data['citation']) ? $this->__data['citation'] : '');
                    $this->__description->value(isset($this->__data['description']) ? $this->__data['description'] : '');
                    $this->__bdate->value(isset($this->__data['bdate']) ? $this->__data['bdate'] : '');
                    $this->__cdate->value(isset($this->__data['cdate']) ? \date('Y-m-d', \strtotime($this->__data['cdate'])) : '');
                    $this->__phone->value(isset($this->__data['phone']) ? $this->__data['phone'] : '');
                    if(isset($this->__data['role'], $this->__data['role']['access_level'])){
                        $level = (int)$this->__data['role']['access_level'];
                        if($level == 0){ $this->__admin->checked(true); }
                        else if($level == 1){ $this->__publ->checked(true); }
                        else if($level == 2){ $this->__plain->checked(true); }
                        else { $this->__plain->checked(true); }
                    }
                }
            }// end __init_form_values
            
            private function __get_user_id(\core\classes\request\Request $request){
                if(isset($request['user'])){
                    return (int)$request['user'];
                }
                return null;
            }// end __get_user_id
            
            private function __get_user_by_id($id){
                try {
                    $factory = new \core\classes\domain\factory\Plain();
                    $User = $factory->getById($id);
                    if(!is_null($User->getData()) && !$User->getData()->exists()){
                        return null;
                    }
                    return $User;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end __get_user_by_id
            
            private function __load_member_data(\core\classes\domain\User $User){
                try {
                    $p = $User->load(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'firstname', 'lastname', 'email', 'sex', 'cdate', 'isactive', 'description', 'bdate', 'phone', 'citation'
                    )));
                    if($p){
                        $p = $User->loadUserRole();
                    }
                    if($p){
                        $User->loadCountry();
                    }
                    $Avatar = $User->getAvatar();
                    if(!is_null($Avatar)){
                        $Avatar->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension')));
                    }
                    return $p;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end __load_member_data
            
            private function __page_list(){
                try {
                    $factory = new \core\classes\domain\factory\Page();
                    $Page = $factory->getRoot();
                    if(!is_null($Page)){ 
                        
                        // Build page tree:
                        $Page->availableTree();
                        
                        // Load tree data:
                        $visitor = new \core\classes\visitor\PageLoader();
                        $visitor->attributes(array('id', 'title'));
                        $Page->acceptTree($visitor);
                        
                        // Get multidimensional page data array:
                        $this->__category = &$Page->getPageTreeAsDataArray();
                    }
                } catch(\core\classes\domain\DomainException $ex){
                    $this->error($ex->getMessage());
                }
            }// end __page_list
            
            private function __load_user_page(\core\classes\domain\AuthorizedUser $User){
                try {
                    $factory = new \core\classes\data\factory\UserPage();
                    $set = $factory->getByUserId($User->getID());
                    if(!is_null($set)){
                        $set->accept(function($user_page){
                            if($user_page->read()){
                                $data = $user_page->getData();
                                if(isset($data['page_id'])){
                                    $this->__user_page[$data['page_id']] = $data['page_id'];
                                }
                            }
                        });
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __load_user_page
            
            private function __mark_selected(&$categories){
                if(isset($categories['children'])){
                    foreach($categories['children'] as &$category){
                        $category['checked'] = 0;
                        if(isset($category['id']) && isset($this->__user_page[$category['id']])){
                            $category['checked'] = 1;
                        }
                        $this->__mark_selected($category);
                    }
                }
            }// end __mark_selected
            
            private function __html_list(array &$pages, $level = 0){
                $html = '';
                if(isset($pages['children']) && !empty($pages['children'])){
                    $html = '<div class="list level'.$level.'">';
                    foreach($pages['children'] as &$data){
                        
                        $id = isset($data['id']) ? $data['id'] : '';
                        $title = isset($data['title']) ? $data['title'] : '';
                        $checked = isset($data['checked']) && ($data['checked'] == true);
                        
                        $html .= 
                        '<div class="item">
                            <div class="left"><input type="checkbox" name="page[]" value="'.$id.'" '.($checked ? 'checked="checked"' : '').' /></div>
                            <div class="center">'.$title.'</div>
                            <div class="right"></div>
                        </div>';
                        $html .= $this->__html_list($data, $level + 1);
                    }
                    $html .= '</div>';
                }
                return $html;
            }// end __html_list
            
            private function __activate(){
                $f = new \core\classes\form\field\Submit('activate_button');
                $f->value('Activate');
                $this->__activate = $f;
                return $f;
            }// end __activate
            
            private function __deactivate(){
                $f = new \core\classes\form\field\Submit('deactivate_button');
                $f->value('Deactivate');
                $this->__deactivate = $f;
                return $f;
            }// end __deactivate
            
            private function __remove(){
                $f = new \core\classes\form\field\Submit('remove_button');
                $f->value('Remove');
                $this->__remove = $f;
                return $f;
            }// end __remove
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('save');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __firstname(){
                $f = new \core\classes\form\field\Text('firstname');
                $f->readonly(true);
                $this->__firstname = $f;
                return $f;
            }// end __firstname
            
            private function __lastname(){
                $f = new \core\classes\form\field\Text('lastname');
                $f->readonly(true);
                $this->__lastname = $f;
                return $f;
            }// end __lastname
            
            private function __description(){
                $f = new \core\classes\form\field\Textarea('description');
                $f->readonly(true);
                $this->__description = $f;
                return $f;
            }// end __description
            
            private function __phone(){
                $f = new \core\classes\form\field\Text('phone');
                $f->readonly(true);
                $this->__phone = $f;
                return $f;
            }// end __phone
            
            private function __email(){
                $f = new \core\classes\form\field\Email('email');
                $f->readonly(true);
                $this->__email = $f;
                return $f;
            }// end __email
            
            private function __cdate(){
                $f = new \core\classes\form\field\Date('cdate');
                $f->readonly(true);
                $this->__cdate = $f;
                return $f;
            }// end __cdate
            
            private function __bdate(){
                $f = new \core\classes\form\field\Date('bdate');
                $f->readonly(true);
                $this->__bdate = $f;
                return $f;
            }// end __bdate
            
            private function __citation(){
                $f = new \core\classes\form\field\Text('citation');
                $f->readonly(true);
                $this->__citation = $f;
                return $f;
            }// end __citation
            
            private function __administrator(){
                $f = new \core\classes\form\field\Radio('user_role');
                $f->value(1);
                $this->__admin = $f;
                return $f;
            }// end __administrator
            
            private function __publicist(){
                $f = new \core\classes\form\field\Radio('user_role');
                $f->value(2);
                $this->__publ = $f;
                return $f;
            }// end __publicist
            
            private function __plain(){
                $f = new \core\classes\form\field\Radio('user_role');
                $f->value(3);
                $this->__plain = $f;
                return $f;
            }// end __plain
            
        // }
    // }
}