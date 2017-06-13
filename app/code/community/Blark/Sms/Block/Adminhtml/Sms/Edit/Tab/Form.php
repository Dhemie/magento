<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    class Blark_Sms_Block_Adminhtml_Sms_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {
     
        protected function _prepareForm() {
     
            if (Mage::registry('sms_data')) {
                $data = Mage::registry('sms_data')->getData();
            } else {
                $data = array();
            }
            
            
            
            $collection = Mage::getModel('blark_sms/sms')
                     ->getCollection()
                     ->addFieldToSelect(["id","group_name"])
                     ->setOrder('id','asc');
            $tempString = '';
            foreach($collection as $data){
                     $tempString .= $data->getData("id").'-'.$data->getData("group_name").',';
            }           
            $tempString = '0-Use Custom Entry,'.$tempString; //add custom field to array string

            
            $string = substr($tempString,0, strlen($tempString)-1); //remove trailing comma from TempString
            
            $chunks = array_chunk(preg_split('/(-|,)/', $string), 2);
            $selectOption = array_combine(array_column($chunks, 0), array_column($chunks, 1));
            
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('sms_sms', array('legend' => Mage::helper('blark_sms')->__('Recipient')));
            

$fieldset->addField('select', 'select', array(
                  'label'     => Mage::helper('blark_sms')->__('Select Contact Group '),
                  'class'     => 'required-entry',
                  'required'  => false,
                  'name'      => 'contact_group',
                  'onclick'   => "",
                  'onchange'  => "",
                  'values'    => $selectOption,
                  'disabled'  => false,
                  'readonly'  => false,
                  'after_element_html' => '<small>Select a contact group</small>',
                  'tabindex'  => 1
                ));            
            
            $fieldset->addField('numbers', 'textarea', array(
                      'label'     => Mage::helper('blark_sms')->__('Custom phone numbers'),
                      'required'  => false,
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
