<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blark_Sms_Block_Adminhtml_Contact_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'blark_sms';
        $this->_controller = 'adminhtml_contact_contactgrid';
        $this->_headerText = Mage::helper('blark_sms')->__('Messaging - Contacts');
       
        parent::__construct();
        

    }
    
    
}