<?php
	/**
	* 
	*/
	class Blark_Sms_Block_Adminhtml_Sms_Edit extends Mage_Adminhtml_Block_widget_Form_Container
	{
		
		public function __construct()
		{
			
			$this->_objectId = "tab_id";
			$this->_blockGroup = "blark_sms";
			$this->_controller = "adminhtml_sms";
                        $this->_mode = "edit";            
			Parent::__construct();
                        
                       // $this->_removeButton('back');
                        $this->_updateButton('save',null, array(
                            'label' => Mage::helper('adminhtml')->__('Send message'),
                            'onclick'   => 'editForm.submit();',
                            'class'     => 'save',
                        ),1);
                   
                        
                        
		}
    
		public function getHeaderText(){
			return Mage::helper('blark_sms')->__('Messaging');
		}
	}