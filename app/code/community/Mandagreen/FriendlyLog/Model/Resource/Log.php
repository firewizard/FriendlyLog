<?php

class Mandagreen_FriendlyLog_Model_Resource_Log extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('mgfriendlylog/friendlylog_queue', 'log_id');
    }
}