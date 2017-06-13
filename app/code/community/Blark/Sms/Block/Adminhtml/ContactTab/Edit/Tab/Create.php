<?php

/**
 * 
 */

class Blark_Sms_Block_Adminhtml_ContactTab_Edit_Tab_Create extends Mage_Adminhtml_Block_Widget_Form {
        protected function _prepareForm() {
     
            if (Mage::registry('sms_contact_data')) {
                $data = Mage::registry('sms_contact_data')->getData();
            } else {
                $data = array();
            }
     
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('sms_contact_sms', array('legend' => Mage::helper('blark_sms')->__('Add new contact group')));
            
            
        $fieldset->addField('text_group_name', 'text', array(
          'label'     => Mage::helper('blark_sms')->__('Group name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'group_name',
          'value'     => '',
          'maxlength' => '',
          'disabled' => false,
          'after_element_html' => ' <br /> <small> Write a new group name </small>',
          'tabindex' => 1
        ));
        
        
        $fieldset->addField('textarea', 'textarea', array(
          'label'     => Mage::helper('blark_sms')->__('Contact List'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'contact',
          'value'     => '',
          'maxlength' => '',
          'disabled' => false,
          'after_element_html' => ' <br /> <small> Write phone numbers here </small>',
          'tabindex' => 1
        ));
        

               
        $fieldset->addField('create_new_contact', 'button', array(
            //'label' => Mage::helper('blark_sms')->__('Create new message contact group '),
            'value' => Mage::helper('blark_sms')->__('Create Group'),
            'name'  => 'create_message_group',
            'class' => 'form-button',
            'onclick' => "setLocation('{$this->getUrl('*/sms/createnewcontactgroup')}')",
        ));
        
       
        

      
        
       
        $form->setValues($data);
 
        return parent::_prepareForm();
    }

}

