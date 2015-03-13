<?php 

class Mandagreen_FriendlyLog_Block_Adminhtml_List extends Mage_Adminhtml_Block_Widget_Grid_Container {
	public function __construct() {
		parent::__construct();

		$this->_blockGroup = 'mgfriendlylog';
		$this->_controller = 'adminhtml_list';
		$this->_headerText = Mage::helper('mgfriendlylog')->__('Friendly Log');
		$this->_removeButton('add');
	}
}
	