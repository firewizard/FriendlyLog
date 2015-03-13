<?php

class Mandagreen_FriendlyLog_Adminhtml_FriendlylogController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/mgfriendlylog');
    }

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('system/friendlylog');
        $this->_addContent($this->getLayout()->createBlock('mgfriendlylog/adminhtml_list'));
        $this->renderLayout();
    }

    public function ajaxAction()
    {
        $this->loadLayout();

        $id = $this->getRequest()->getParam('id');
        $log = Mage::getModel('mgfriendlylog/log')->load($id);

        if (!$log->getId()) {
            $text = '<em>' . Mage::helper('mgfriendlylog')->__('No data found') . '</em>';
        } else {
            Mage::dispatchEvent('friendlylog_before_display', array('model' => $log));
            $text = nl2br($log->getDetails());
        }

        $block = $this->getLayout()->createBlock('core/text')->setText($text);
        $this->_addContent($block);

        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout(false);
        $this->getResponse()->appendBody(
            $this->getLayout()->createBlock('mgfriendlylog/adminhtml_list_grid')->toHtml()
        );
        $this->renderLayout();
    }
}