<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Blark_Sms_Block_Adminhtml_Sms_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{

     public function __construct()
  {
      parent::__construct();
      $this->setId('tab_id');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('blark_sms')->__('Menu'));
  }
 
  protected function _prepareLayout()
  {
       //parent::_prepareLayout();
      
      $this->addTab('form_section', array(
          'label'     => Mage::helper('blark_sms')->__('Recipients'),
          'title'     => Mage::helper('blark_sms')->__('Recipients'),
          'content'  => $this->getLayout()->createBlock('blark_sms/adminhtml_sms_edit_tab_form')->toHtml(),
      ));
      
      
      
       $this->addTab('form_section1', array(
          'label'     => Mage::helper('blark_sms')->__('Message'),
          'title'     => Mage::helper('blark_sms')->__('Message'),
          'content' => $this->getLayout()->createBlock('blark_sms/adminhtml_sms_edit_tab_messageForm')->toHtml(),
      )); 
      
      return parent::_beforeToHtml();
  }
    
    
    
    
    
}
