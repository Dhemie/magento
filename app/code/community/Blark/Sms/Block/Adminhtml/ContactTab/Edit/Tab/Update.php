<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class Blark_Sms_Block_Adminhtml_ContactTab_Edit_Tab_Update extends Mage_Adminhtml_Block_Widget_Form {
     
        protected function _prepareForm() {
     
            if (Mage::registry('sms_contact_data')) {
                $data = Mage::registry('sms_contact_data')->getData();
            } else {
                $data = array();
            }
            
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('sms_contact_sms', array('legend' => Mage::helper('blark_sms')->__('Update contact group')));
     
            $fieldset->addField('textarea', 'textarea', array(
                      'label'     => Mage::helper('blark_sms')->__('Phone numbers'),
                      'class'     => 'required-entry',
                      'required'  => true,
                      'name'      => 'numbers',
                      'value'     => '',
                      'maxlength' => '',
                      'disabled' => false,
                      'after_element_html' => '<br/> <small> Enter phone numbers separated by commas </small> ',
                      'tabindex' => 1
                    ));
     
            $form->setValues($data);
     
            return parent::_prepareForm();
        }
    }
