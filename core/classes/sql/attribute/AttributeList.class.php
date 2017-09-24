<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\attribute
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql\attribute;

class AttributeList extends \ArrayObject {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            public function isEmpty(){
                return ($this->count() == 0);
            }// end isEmpty
    
            public function __toString() {
                $str = '';
                $iter = $this->getIterator();
                $iter->rewind();
                if($iter->valid()){
                    $str .= '`'.$iter->current().'`';
                    $iter->next();
                }
                while($iter->valid()){
                    $str .= ', `'.$iter->current().'`';
                    $iter->next();
                }
                return $str;
            }// end __toString
    
        // } protected {
        
        // } private {
            
        // }
    // }
}