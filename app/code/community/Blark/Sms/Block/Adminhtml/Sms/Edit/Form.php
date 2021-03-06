<?php

/**
 * 
 */
class Blark_Sms_Block_Adminhtml_Sms_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    Protected function _prepareForm() {
        
        if (Mage::registry('sms_data')) {
            $data = Mage::registry('sms_data')->getData();
        } else {
            $data = array();
        }

        
        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/gateway/sendsms', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data')
        );
        
        $form->setUseContainer(true);
        $this->setForm($form);
        $form->setValues($data);

        return parent::_prepareForm();
    }

}
