<?php

	/**
	* 
	*/
	class Blark_Sms_Adminhtml_ContactController extends Mage_Adminhtml_Controller_Action
	{                           
                public function indexAction(){
				$this->loadLayout();
                                $this->_setActiveMenu('sms');
                                $this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_contacttab_testblock'));
                                $this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_contact_grid'));
				$this->renderLayout();                                          
                   // header('Content-Type: text-xml');
                    //die($this->getLayout()->getNode()->asXml());
                     //print_r($this->getLayout()->getUpdate()->getHandles());    
                }

                public function editAction(){
                            $params = $this->getRequest()->getParams();
                            $this->loadLayout();
                            $this->_setActiveMenu('sms');
                            $this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_contacteditform_contactform'));
                            $this->renderLayout();
                }
                
                public function saveAction(){
                                $postData = $this->getRequest()->getPost();
                                $id = $this->getRequest()->getParam('id');
                                

                                if(!$postData['group_name'] || !$postData['phone_numbers'] ){
                                    echo "Please enter correct values";
                                    die();
                                }
                                //count the number entries
                                $numArr = explode(',',$postData['phone_numbers']);
                                
                                //if the id param is not passed then we save a new group
                    if(!is_numeric($id)){
                                                                   
                                $data = [
                                    "group_name"        =>  $postData['group_name'],
                                    "phone_numbers"     =>  $postData['phone_numbers'],
                                    "comments"          =>  $postData['comments'],
                                    "number_count"      =>  sizeof($numArr),
                                    "last_sent"         =>  null,
                                    "created_at"        =>  date('Y-m-d H:i:s'),
                                    "updated_at"        =>  date('Y-m-d H:i:s')
                                ];
                                
                                try{
                                    $contactModel = Mage::getModel('blark_sms/sms');  //load message contact model

                                    $contactModel->addData($data)->save(); //save new contact group
                                    
                                    //ser session message
                                    Mage::getSingleton('core/session')->addSuccess("New contact group has been added" ); 

                                } catch (Exception $ex) {
                                    Mage::log($ex,null, "sms.log");//log the error exception
                                    Mage::getSingleton('core/session')->addError("An error occured, contact group was not added  ");
                                }
                    }else{                                
                                $data = [
                                    "group_name"        =>  $postData['group_name'],
                                    "phone_numbers"     =>  $postData['phone_numbers'],
                                    "comments"          =>  $postData['comments'],
                                    "number_count"      =>  sizeof($numArr),//amount of phone numbers provided
                                    "updated_at"        =>  date('Y-m-d H:i:s')
                                ];
                                
                                try{
                                    $contactModel = Mage::getModel('blark_sms/sms')->load($id);  //load message contact model
                                    $contactModel->addData($data)->save(); //save new contact group
                                    
                                    //ser session message
                                    Mage::getSingleton('core/session')->addSuccess($data["group_name"]." has been updated" ); 

                                } catch (Exception $ex) {
                                    Mage::log($ex,null, "sms.log");//log the error exception
                                    Mage::getSingleton('core/session')->addError("An error occured, contact group was not updated  ");
                                }
                    }            
                                $this->_redirect('*/contact/index');                                
                }

                
                public function deleteAction(){                        
                        if(is_numeric($id = $this->getRequest()->getParam('id'))){
                            $contactModel = Mage::getModel('blark_sms/sms')->load($id);  //load message contact model
                             
                            try{
                                $contactModel->setId($id)->delete(); //delete contact group
                                Mage::getSingleton('core/session')->addSuccess("Contact Group has been deleted ");
                            } catch (Exception $ex) {
                                    Mage::log($ex,null, "sms.log");//log the error exception
                                    Mage::getSingleton('core/session')->addError("An error occured, contact group was not deleted  ");
                            }
                        }
                            $this->_redirect('*/contact/index');
                }

                
                public function newAction(){
                        $this->loadLayout();
                        $this->_setActiveMenu('sms');
                        //$postData = $this->getRequest()->getParams();
                        $this->_addContent($this->getLayout()->createBlock('blark_sms/adminhtml_contacteditform_contactform'));
                        $this->renderLayout(); 
                        
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
	}