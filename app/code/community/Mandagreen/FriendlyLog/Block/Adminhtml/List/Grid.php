<?php 

class Mandagreen_FriendlyLog_Block_Adminhtml_List_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
		parent::__construct();
		$this->setId('mgfriendlylog_list');
		$this->setUseAjax(true);
		$this->setDefaultSort('log_id');
		$this->setDefaultDir('DESC');
		$this->setSaveParametersInSession(true);

        $this->setRowClickCallback('function(grid, event) {
        var tr = Event.findElement(event, "tr"),
            td = tr.getElementsBySelector("td:first-child")[0],
            id = parseInt(td.innerHTML);

        Dialog.info(null, {
            draggable: true,
            resizable: true,
            closable: true,
            className: "magento",
            windowClassName: "popup-window",
            title: "Details",
            top: 160,
            height: 500,
            width: 800,
            zIndex: 100,
            recenterAuto: false,
            hideEffect: Element.hide,
            showEffect: Element.show,
            id: "browser_window",
            url: "' . Mage::helper("adminhtml")->getUrl('adminhtml/friendlylog/ajax') . 'id/" + id

        })
        }');
	}

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getResourceModel('mgfriendlylog/log_collection'));
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
		$this->addColumn('log_id', array(
			'header'=> '#',
			'type'  => 'number',
			'index' => 'log_id',
            'width' => 50,
		));

		$this->addColumn('subject', array(
			'header'=> Mage::helper('mgfriendlylog')->__('Subject'),
			'type'  => 'text',
			'index' => 'subject',
		));

		$this->addColumn('group_name', array(
			'header' => Mage::helper('mgfriendlylog')->__('Group'),
			'index' => 'group_name',
            'type'  => 'options',
            'options' => $this->helper('mgfriendlylog')->getGroups(),
            'show_missing_option_values' => 1,
            'width' => 250,
		));

        $this->addColumn('date_added', array(
            'header' => Mage::helper('mgfriendlylog')->__('Date added'),
            'index' => 'date_added',
            'type' => 'date',
            'format' => 'MMM d, yyyy HH:mm:ss'
        ));

		return parent::_prepareColumns();
	}

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }

    function getRowUrl($row)
    {
        return '#';
    }
}