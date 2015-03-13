<?php

class Mandagreen_FriendlyLog_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getGroups()
    {
        return $groups = (array)Mage::app()->getConfig()->getNode('friendlylog/groups');
    }
}