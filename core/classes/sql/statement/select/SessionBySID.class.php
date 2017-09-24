<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql\statement\select
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.10.2016
 */

namespace core\classes\sql\statement\select;

class SessionBySID extends Statement {
    // vars {
        
        // Select query:
        protected $_query = 'SELECT id FROM session WHERE (sid = :sid OR (sido = :sid AND last + INTERVAL :osduration SECOND >= CURRENT_TIMESTAMP())) AND last + INTERVAL :time SECOND >= CURRENT_TIMESTAMP()';
       
        // Used parameters:
        protected $_requiredParams = array(
            'sid'        => 'sid',
            'time'       => 'last',
            'osduration' => 'old_session_duration'
        );
        
    // } methods {
    
        // public {
            
            
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}