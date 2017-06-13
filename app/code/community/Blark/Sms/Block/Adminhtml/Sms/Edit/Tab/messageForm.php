<?php

/**
 * 
 */

class Blark_Sms_Block_Adminhtml_Sms_Edit_Tab_messageForm extends Mage_Adminhtml_Block_Widget_Form {
        protected function _prepareForm() {
     
            if (Mage::registry('sms_data')) {
                $data = Mage::registry('sms_data')->getData();
            } else {
                $data = array();
            }
     
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('sms_sms', array('legend' => Mage::helper('blark_sms')->__('Message')));

        $fieldset->addField('textarea', 'textarea', array(
          'label'     => Mage::helper('blark_sms')->__('Message'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'message',
          'value'     => '',
          'maxlength' => '',
          'disabled' => false,
          'after_element_html' => ' <br /> <small> Write message here </small>',
          'tabindex' => 1
        ));
        
       
        

      
        
       
        $form->setValues($data);
 
        return parent::_prepareForm();
    }

}
