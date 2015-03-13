<?php

class Mandagreen_FriendlyLog_Model_Log extends Mage_Core_Model_Abstract
{
    protected $_queue = array();

    protected function _construct()
    {
        $this->_init('mgfriendlylog/log');
    }

    public function push($message)
    {
        $this->_queue[] = $message;
        return $this;
    }

    public function commit()
    {
        if (!count($this->_queue)) {
            return $this;
        }

        if (!$this->getSubject()) {
            $this->setSubject($this->_queue[0]);
        }

        $this
            ->setDetails(implode("\n", $this->_queue))
            ->save();

        return $this;
    }

    protected function _beforeSave()
    {
        $this->setDateAdded(date('Y-m-d H:i:s'));
    }
}