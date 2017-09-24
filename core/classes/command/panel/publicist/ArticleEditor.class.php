<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\publicist;

class ArticleEditor extends \core\classes\command\MultiStepEditor {
    // vars {
        
        protected $_key             = '__articleeditor';
        
        protected static $_step     = 1;
        protected static $_cmd      = 'articleeditor';
        
        protected $_next            = 'ArticleCategory';
        protected $_prev            = null;
        protected $_begin           = 'ArticleEditor';
        protected $_end             = 'ArticleOptions';
        
        // Form:
        
        private $__form             = null;
        private $__title            = null;
        private $__namepath         = null;
        private $__description      = null;
        private $__link             = null;
        private $__next             = null;
        private $__save             = null;
        private $__cancel           = null;
        
        private $__user             = null;


        private $__attributes       = array(
            'title', 'namepath', 'description', 'link', 'user_id', 'page_id', 'cdate', 'hide', 'bin'
        );

    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/pageeditor.style.css'
                );
            }// end _styles
            
            protected function _retrieveId(){
                $id = null;
                $data = $this->_data();
                if(isset($data['id'])){
                    $id = (int)$data['id'];
                }
                return $id;
            }// end _retrieveId
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = $this->_retrieveId();
                    try {
                        $factory = new \core\classes\data\factory\Article();
                        if(!is_null($id)){
                            $article = $factory->getById($id);
                            if(!is_null($article)){
                                $article->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'title', 'namepath', 'description', 'link'
                                )));
                                if($article->read()){
                                    $data = $article->getData();
                                    $this->__title->value(isset($data['title']) ? $data['title'] : '');
                                    $this->__namepath->value(isset($data['namepath']) ? $data['namepath'] : '');
                                    $this->__description->value(isset($data['description']) ? \core\functions\decode_content($data['description']) : '');
                                    $this->__link->value(isset($data['link']) ? $data['link'] : '');
                                    return true;
                                }
                            }
                        }
                        return false;
                    } catch (\core\classes\data\DataException $ex) {
                        $this->error(Error::get('art_read'));
                    }
                }
                return true;
            }// end _read
            
            protected function _update(){
                $id = $this->_retrieveId();
                try {
                    if(!is_null($id)){
                        $factory = new \core\classes\data\factory\Article();
                        $article = $factory->getById($id);
                        if(!is_null($article)){
                            $article->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'title', 'namepath', 'description', 'link',
                                'edate'
                            )));
                            // Setting data:
                            $data = array(
                                'id'            => $article->getID(),
                                'title'         => $this->__title->value(),
                                'namepath'      => !empty($this->__namepath->value()) ? $this->__namepath->value() : $this->__namepath_sure(\core\functions\namepath($this->__title->value())),
                                'description'   => \core\functions\encode_content($this->__description->value()),
                                'link'          => $this->__link->value(),
                                'edate'         => \date(DATETIME)
                            );
                            $article->setData($data);
                            if($article->update()){
                                $this->correct(Correct::get('update'));
                                return true;
                            }
                        }
                    }
                    $this->error(Error::get('update'));
                    return false;
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                try {
                    $article = new \core\classes\data\Article();
                    $article->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->__attributes));
                    // Setting data:
                    $data = array(
                        'title'         => $this->__title->value(),
                        'namepath'      => !empty($this->__namepath->value()) ? $this->__namepath->value() : $this->__namepath_sure(\core\functions\namepath($this->__title->value())),
                        'description'   => \core\functions\encode_content($this->__description->value()),
                        'link'          => $this->__link->value(),
                        'user_id'       => $this->__user->getID(),
                        'page_id'       => 1, // root page
                        'cdate'         => \date(DATETIME),
                        'hide'          => 1,
                        'bin'           => 0
                    );
                    $article->setData($data);
                    // User creation:
                    if($article->create()){
                        $this->correct(Correct::get('art_create'));
                        $this->_open(array(
                            'id'    => $article->getID()
                        ));
                        return true;
                    }
                    else {
                        $this->error(Error::get('art_create'));
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_create'));
                }
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Open article:
                if(isset($request['namepath']) && !empty($request['namepath'])){
                    $Article = $this->_get_article_by_namepath($request['namepath']);
                    if(!is_null($Article)){
                        $this->_open(array(
                            'id'    => $Article->getID()
                        ));
                        $this->_step($this->_end()[self::STEP]);
                        $this->_mode(self::UPDATE);
                        \core\functions\redirect(\core\functions\address().'/panel/'.$this->_begin()[self::CMD]);
                    }
                    else {
                        $this->error(Error::get('article_not_exists'));
                    }
                }
                
                // User instance:
                $this->__user = \PanelRegistry::getCurrentUser();
                // Form:
                $form = new \core\classes\form\Form('articleeditor');
                $this->__form = $form;
                // Title field:
                $title = $this->__title();
                // Namepath field:
                $namepath = $this->__namepath();
                // Link field:
                $link = $this->__link();
                // Description field:
                $description = $this->__description();
                // Save button:
                $save = $this->__save();
                // Next button:
                $next = $this->__next();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Composing form:
                $form->attach($title);
                $form->attach($namepath);
                $form->attach($link);
                $form->attach($description);
                $form->attach($save);
                $form->attach($next);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('art_read'));
                }
                
                // Executing form:
                if($save->submitted() || $next->submitted()){
                    if($form->perform()){
                        if($this->_save()){
                            if($next->submitted()){
                                $status = self::NEXT;
                            }
                        }
                    }
                    else {
                        $this->error(Error::get('form_incomplete'));
                    }
                }
                else if($cancel->submitted()){
                    $this->_cancel();
                }
                
                $this->assignAll(array(
                    'title'     => Text::get('editor'),
                    
                    // form:
                    'tit'       => array(
                        'title'         => Text::get('art_title'),
                        'input'         => $title,
                        'description'   => Text::get('art_title_desc'),
                    ),
                    'namepath'       => array(
                        'title'         => Text::get('art_namepath'),
                        'input'         => $namepath,
                        'description'   => Text::get('art_namepath_desc'),
                    ),
                    'desc'       => array(
                        'title'         => Text::get('art_desc'),
                        'input'         => $description,
                        'description'   => Text::get('art_desc_desc'),
                    ),
                    'link'       => array(
                        'title'         => Text::get('art_link'),
                        'input'         => $link,
                        'description'   => Text::get('art_link_desc'),
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save, $next),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _get_article_by_namepath($namepath){
                try {
                    $factory = new \core\classes\domain\factory\Article();
                    $User = \PanelRegistry::getCurrentUser();
                    if(!is_null($User)){
                        $Article = $factory->getByNamepathAndByUserId($namepath, $User->getID());
                        return $Article;
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end _get_article_by_namepath
            
            protected function _cancel(){
                if($this->_opened()){
                    $this->_close();
                }
                \core\functions\redirect(\core\functions\address().'/panel/article');
            }// end _cancel
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            private function __namepath_sure($namepath){
                $id = $this->_retrieveId();
                $i = 0;
                do {
                    ++$i;
                    $art_id = \core\classes\data\factory\Article::namepathExists($namepath);
                    if(!is_null($art_id) && !is_null($id)){
                        if($art_id == $id){
                            return $namepath;
                        } else {
                            $namepath .= ''.$i;
                        }
                    }
                    else {
                        return $namepath;
                    }
                } while($i <= 1000);
                return $namepath;
            }// end __namepath_sure
            
            private function __title(){
                $f = new \core\classes\form\field\Text('title');
                $f->id('page_title');
                $f->expression('/^'.REGEX_TITLE.'{3,512}$/i', Error::get('invalid'));
                $f->required(true);
                $this->__title = $f;
                return $f;
            }// end __title
            
            private function __namepath(){
                $id = $this->_retrieveId();
                $f = new \core\classes\form\field\Text('namepath_input');
                $f->id('page_namepath');
                $f->expression('/^'.REGEX_NAMEPATH.'{1,128}$/i', Error::get('invalid'));
                $f->callback(function($field) use($id){
                    $art_id = \core\classes\data\factory\Article::namepathExists($field->value());
                    if(!is_null($art_id)){
                        return ($art_id == $id);
                    }
                    return true;
                }, Error::get('namepath_exists'));
                $this->__namepath = $f;
                return $f;
            }// end __namepath
            
            private function __link(){
                $f = new \core\classes\form\field\Text('link');
                $f->id('page_link');
                $f->expression('/^'.REGEX_PATH.'$/i', Error::get('invalid_link'));
                $this->__link = $f;
                return $f;
            }// end __lnik
            
            private function __description(){
                $f = new \core\classes\form\field\Textarea('description');
                $f->id('editor');
                $this->__description = $f;
                return $f;
            }// end __description
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep1');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __next(){
                $f = new \core\classes\form\field\Submit('nextstep1');
                $f->value('Save and next');
                $this->__next = $f;
                return $f;
            }// end __next
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Cancel');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}