<?php
	/**
	* 
	*/
	class Blark_Sms_Block_Adminhtml_ContactTab_Edit extends Mage_Adminhtml_Block_widget_Form_Container
	{
		
		public function __construct()
		{
			
			$this->_objectId = "contact_tab_id";
			$this->_blockGroup = "blark_sms";
			$this->_controller = "adminhtml_sms";
                        $this->_mode = "edit";            
			Parent::__construct();                       
		}
    
		public function getHeaderText(){
			return Mage::helper('blark_sms')->__('Message contacts');
		}
	}