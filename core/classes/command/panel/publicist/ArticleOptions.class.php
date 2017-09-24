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

class ArticleOptions extends ArticleEditor {
    // vars {
        
        protected static $_step     = 5;
        protected static $_cmd      = 'articleoptions';
        
        protected $_next            = null;
        protected $_prev            = 'ArticlePicture';
    
        // Form fields:
        private $__form             = null;
        private $__keywords         = null;
        private $__ord              = null;
        private $__hide             = null;
        private $__mark             = null;
        private $__save             = null;
        private $__saveandfinish    = null;
        private $__cancel           = null;
    
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
        
            protected function _read(){
                if($this->_opened() && !$this->__form->submitted() && ($this->_mode() == self::UPDATE)){
                    $id = $this->_retrieveId();
                    try {
                        $factory = new \core\classes\data\factory\Article();
                        if(!is_null($id)){
                            $article = $factory->getById($id);
                            if(!is_null($article)){
                                $article->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'keywords', 'ord', 'hide', 'mark'
                                )));
                                if($article->read()){
                                    $data = $article->getData();
                                    $this->__keywords->value(isset($data['keywords']) ? $data['keywords'] : '');
                                    $this->__ord->value(isset($data['ord']) ? $data['ord'] : '');
                                    if(isset($data['hide']) && ($data['hide'] == 1)){
                                        $this->__hide->checked(true);
                                    }
                                    if(isset($data['mark']) && ($data['mark'] == 1)){
                                        $this->__mark->checked(true);
                                    }
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
                if(is_null($id)){
                    $this->error(Error::get('update'));
                    return false;
                }
                try {
                    $factory = new \core\classes\domain\factory\Article();
                    $Article = $factory->getById($id);
                    
                    if(is_null($Article)){
                        $this->error(Error::get('update'));
                        return false;
                    }
                    $article = $Article->getData();
                    if(is_null($article)){
                        $this->error(Error::get('update'));
                        return false;
                    }
                    
                    $hide = $this->__hide->checked() ? 1 : 0;
                    
                    $article->setAttributeList(new \core\classes\sql\attribute\AttributeList(array(
                        'id', 'keywords', 'ord', 'mark', 'edate'
                    )));
                    // Setting data:
                    $data = array(
                        'id'            => $article->getID(),
                        'keywords'      => $this->__keywords->value(),
                        'ord'           => $this->__ord->value(),
                        //'hide'          => $this->__hide->checked() ? 1 : 0,
                        'mark'          => $this->__mark->checked() ? 1 : 0,
                        'edate'         => \date(DATETIME)
                    );
                    $article->setData($data);
                    $p = false;
                    $q = false;
                    if($hide && $article->hide()){
                        $p = true;
                    }
                    else if(!$hide){
                        $p = $article->show();
                    }
                    
                    if($article->update()){
                        $this->correct(Correct::get('update'));
                        $q = true;
                    }
                    
                    if($p && $q){
                        return true;
                    }
                    
                    $this->error(Error::get('update'));
                    return false;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error(Error::get('art_update'));
                } catch (\core\classes\data\DataException $ex) {
                    $this->error(Error::get('art_update'));
                }
                return false;
            }// end _update
            
            protected function _create(){
                return false;
            }// end _create
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = self::CMD_OK;
                
                // Form:
                $form = new \core\classes\form\Form('articleoptions');
                $this->__form = $form;
                // Keyword field:
                $keywords = $this->__keywords();
                // Order field:
                $ord = $this->__ord();
                // Hide field:
                $hide = $this->__hide();
                // Mark field:
                $mark = $this->__mark();
                // Save button:
                $save = $this->__save();
                // Save and finish button:
                $saveandfinish = $this->__saveandfinish();
                // Cancel button:
                $cancel = $this->__cancel();
                
                // Compose form:
                $form->attach($keywords);
                $form->attach($ord);
                $form->attach($hide);
                $form->attach($mark);
                $form->attach($save);
                $form->attach($saveandfinish);
                $form->attach($cancel);
                
                // Reading data:
                if(!$this->_read()){
                    $this->error(Error::get('art_read'));
                }
                
                // Execute form:
                if($save->submitted() or $saveandfinish->submitted()){
                    if($form->perform()){
                        if($this->_save()){
                            $status = self::NEXT;
                        }
                        if($saveandfinish->submitted()){
                            $this->_cancel();
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
                    'title'         => Text::get('artoptions'),
                    'description'   => Text::get('art_options_desc'),
                    
                    // Form:
                    'keywords_'       => array(
                        'title'         => Text::get('art_keywords'),
                        'input'         => $keywords,
                        'description'   => Text::get('art_keywords_desc'),
                    ),
                    'ord'       => array(
                        'title'         => Text::get('art_ord'),
                        'input'         => $ord,
                        'description'   => Text::get('art_ord_desc'),
                    ),
                    'hide'       => array(
                        'title'         => Text::get('art_hide'),
                        'input'         => $hide,
                        'description'   => Text::get('art_hide_desc'),
                    ),
                    'mark'       => array(
                        'title'         => Text::get('art_mark'),
                        'input'         => $mark,
                        'description'   => Text::get('art_mark_desc'),
                    ),
                    
                    // Toolbar:
                    'toolbar_left'  => array($save, $saveandfinish),
                    'toolbar_right' => array($cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            private function __keywords(){
                $f = new \core\classes\form\field\Textarea('keywords');
                $f->id('page_keywords');
                $f->expression('/^'.REGEX_ALPHANUMERIC_PUNCTUATION.'{3,512}$/i', Error::get('invalid'));
                $this->__keywords = $f;
                return $f;
            }// end __keywords
            
            private function __ord(){
                $f = new \core\classes\form\field\Number('ord');
                $f->id('page_ord');
                $f->expression('/^'.REGEX_INT.'$/i', Error::get('invalid_ord'));
                $f->min(-999);
                $f->max(999);
                $this->__ord = $f;
                return $f;
            }// end __ord
            
            private function __hide(){
                $f = new \core\classes\form\field\Checkbox('hide');
                $f->id('page_hide');
                $f->checked(false);
                $this->__hide = $f;
                return $f;
            }// end __hide
            
            private function __mark(){
                $f = new \core\classes\form\field\Checkbox('mark');
                $f->id('page_mark');
                $f->checked(false);
                $this->__mark = $f;
                return $f;
            }// end __mark
            
            private function __saveandfinish(){
                $f = new \core\classes\form\field\Submit('saveandfinish');
                $f->value('Save and finish');
                $this->__saveandfinish = $f;
                return $f;
            }// end __saveandfinish
            
            private function __save(){
                $f = new \core\classes\form\field\Submit('savestep5');
                $f->value('Save');
                $this->__save = $f;
                return $f;
            }// end __save
            
            private function __cancel(){
                $f = new \core\classes\form\field\Submit('cancel');
                $f->value('Cancel');
                $this->__cancel = $f;
                return $f;
            }// end __cancel
            
        // }
    // }
}