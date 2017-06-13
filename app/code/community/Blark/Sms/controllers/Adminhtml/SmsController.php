<?php

	/**
	* 
	*/
	class Blark_Sms_Adminhtml_SmsController extends Mage_Adminhtml_Controller_Action
	{
		public function indexAction(){
                                
				$this->loadLayout();
				$this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_sms_edit'))
                                            ->_addLeft($this->getLayout()->createBlock('blark_sms/adminhtml_sms_tabs'));
				$this->renderLayout();  
		}
                


                public function saveAction(){
                    $params = $this->getRequest()->getParams();
                    print_r($params);
                }
                
                
                public function calldbAction(){
				$this->loadLayout();
				$this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_contacttab_edit'))
                                            ->_addLeft($this->getLayout()->createBlock('blark_sms/adminhtml_contacttab_tabs'));
				$this->renderLayout();                     
                    
                    
                   // header('Content-Type: text-xml');
                    //die($this->getLayout()->getNode()->asXml());

                     //print_r($this->getLayout()->getUpdate()->getHandles());                    
                }
                
                
                
                
                public function createNewContactGroupAction(){
                      $postData = $this->getRequest()->getPost();
                      
                      var_dump($postData);

                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
	}