<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blark_Sms_Block_Adminhtml_ContactEditForm_contactForm extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct(){
        $this->_objectId     = 'id';
        $this->_blockGroup   = 'blark_sms';
        $this->_controller   = 'adminhtml_contacteditform';
                                   
        parent::__construct();
        
        $this->_updateButton('save',null, array(
            'label'     => Mage::helper('blark_sms')->__('Save Group'),
            'onclick'   => 'editForm1.submit();',
            'class'     => 'save',
        ),1);     
        
        
        
    }

    public function getHeaderText() {
            
            if(Mage::app()->getRequest()->getParam('id')){
                return $this->__('Edit Contact Group');
            }else{
                return $this->__('New Contact Group');
            }                
    }
}