<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Button
 *
 * @author Maryjoe
 */
class Blark_Sms_Block_Adminhtml_System_Config_Form_Test_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('blark/system/config/test/button.phtml');
    }
 
    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
 
    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxTestUrl()
    {
        return Mage::helper('adminhtml')->getUrl('adminhtml/gateway/test');
    }
 
    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getGatewayCode()
    {
        return Mage::helper('blark_sms')->getActiveGatewayCode();
    }
 
    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => 'balance_button',
            'label'     => $this->helper('adminhtml')->__('Send Test Sms'),
            'onclick'   => 'javascript:test(); return false;'
        ));
 
        return $button->toHtml();
    }
}