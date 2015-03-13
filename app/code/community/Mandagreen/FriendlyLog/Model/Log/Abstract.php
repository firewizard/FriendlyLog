<?php

abstract class Mandagreen_FriendlyLog_Model_Log_Abstract
{
    /** @var Mandagreen_FriendlyLog_Model_Log|null */
    protected $_friendlyLogger;

    public function __construct()
    {
        if (Mage::helper('core')->isModuleEnabled('Mandagreen_FriendlyLog')) {
            $this->_friendlyLogger = Mage::getModel('mgfriendlylog/log');
            $this->_friendlyLogger->setGroupName('abstract');
            $this->_construct();
        }
    }

    protected function _construct()
    {
    }

    public function __destruct()
    {
        if ($this->_friendlyLogger) {
            $this->_friendlyLogger->commit();
        }
    }

    public function log($message)
    {
        if ($this->_friendlyLogger) {
            $this->_friendlyLogger->push($message);
        }

        return $this;
    }
}
