<?php

class Mandagreen_FriendlyLog_Model_Cron
{
    public function cleanup()
    {
        $delta = Mage::getStoreConfig('dev/mgfriendlylog/days_to_keep');

        /** @var Mandagreen_FriendlyLog_Model_Resource_Log_Collection $collection */
        $collection = Mage::getResourceModel('mgfriendlylog/log_collection');
        $collection->addFieldToFilter('date_added', array('lteq' => date('Y-m-d H:i:s', time() - $delta * 3600 * 24)));

        $delete = $collection->getSelect()->deleteFromSelect('main_table');

        /** @var Varien_Db_Adapter_Pdo_Mysql $write */
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        $write->query($delete);
    }
}