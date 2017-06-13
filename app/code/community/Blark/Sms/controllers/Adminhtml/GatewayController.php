<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GatewayController
 *
 * @author Maryjoe
 */
class Blark_Sms_Adminhtml_GatewayController extends Mage_Adminhtml_Controller_Action
{
    
    /**
     * Return some checking result
     *
     * @return void
     */
    public function checkAction()
    {
        $gatewayCode = $this->getRequest()->getParam('gateway');
        
        if($gatewayCode){
            $model = $this->_getGatewayModel($gatewayCode);
            $balance = $model->checkBalance();
            $this->_addButtonLabel = Mage::helper('blark_sms')->__('Send message');
            Mage::app()->getResponse()->setBody($balance);
        }
    }
    
    public function testAction() {
        $gatewayCode = $this->getRequest()->getParam('gateway');
        
        if($gatewayCode){
            $gateway = $this->_getGatewayModel($gatewayCode);
            $sms = new Blark_Sms();
            $sms->setBody("Test SMS sent.");
            $sms->setCountryCodes(['NG']);
            $sms->setRecipients(['2348094715505']);
            $sms->setSenderId('PayPorte');
            $response = $sms->send($gateway);
            
            Mage::app()->getResponse()->setBody($response);
        }
    }

    public function sendSmsAction() {
        $post    = $this->getRequest()->getPost();
        $config  = Mage::getStoreConfig('trans_sms/ident_general');
        $gateway = Mage::helper('blark_sms')->getActiveGatewayModel();
        
        
        var_dump($post['contact_group']);
        if((int)$post['contact_group'] >= 1){
            $collection = Mage::getModel('blark_sms/sms')->load($post['contact_group']);
            $message_recipients = $collection->getData('phone_numbers');    
            $collection->setData(['last_sent' => date('Y-m-d H:i:s') ]);
        }else{
            $message_recipients = $post['numbers'];
        }
        
        
        
        $sms = new Blark_Sms();
        $sms->setBody($post['message']);
        $sms->setCountryCodes(['NG']);
        $sms->setRecipients((array)$message_recipients);
        $sms->setSenderId($config['sender']);
        //$res = $sms->send($gateway);
        //$res = $this->getResponse()->setBody($sms->send($gateway)); 
        //$res2 = json_decode($res);
        $res2 = "Hoba!!";
        
        
        
        Mage::log($res2,null, "sms.log");
        
        if($res2){
             Mage::getSingleton('core/session')->addSuccess("Messages has been sent!" );
             if(isset($collection)){
                 $collection->setId($post['contact_group'])->save();
             }
        }else{
             Mage::getSingleton('core/session')->addError("An error occured while sending messages");
        }
        
        $this->_redirect('*/sms/index');
        
       
    }
    
    
    
    /**
     * 
     * @param string $gatewayCode
     * @return Blark_Sms_Model_Gateway_Abstract
     */
    private function _getGatewayModel($gatewayCode){
        
        return Mage::helper('blark_sms')->getGatewayModel($gatewayCode);
    }
}