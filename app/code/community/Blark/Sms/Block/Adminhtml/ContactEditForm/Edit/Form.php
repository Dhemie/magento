<?php


class Blark_Sms_Block_Adminhtml_ContactEditForm_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

        protected function _prepareForm() {
            
            $form = new Varien_Data_Form(
                       array(
                           'id'         => 'editForm1',
                           'method'     => 'post',
                           'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                       )
                    );
            
            $fieldset = $form->addFieldSet('contact_fieldset',
                        array(
                            'legend' => Mage::helper('blark_sms')->__('Create contact Group'),
                            'class'  => Mage::helper('blark_sms')->__('fieldset-wide')
                        )
                    );
            
            $fieldset->addField('group_name','text', 
                        array(
                            'name'      => 'group_name',
                            'label'     => Mage::helper('blark_sms')->__('Group Name '),
                            'title'     => Mage::helper('blark_sms')->__('Group Name'),
                            'required'  => true,
                        )
                    );
            
            $fieldset->addField('phone_numbers','textarea', 
                        array(
                            'name'      => 'phone_numbers',
                            'label'     => Mage::helper('blark_sms')->__('Phone numbers '),
                            'title'     => Mage::helper('blark_sms')->__('Phone numbers '),
                            'required'  => true,
                            'after_element_html' => '<small> Enter phone numbers separated by commas. Phone numbers should have the country code prefix  </small>',
                        )
                    );

            $fieldset->addField('comments','textarea', 
                        array(
                            'name'      => 'comments',
                            'label'     => Mage::helper('blark_sms')->__('comments'),
                            'title'     => Mage::helper('blark_sms')->__('comments'),
                            'required'  => false,
                            'cols'      => "10",
                            'after_element_html' => '<small> Comments <em>(Optional) </em> </small>',
                        )
                    );
            
            
            
            $form->setUseContainer(true);
            $id = Mage::app()->getRequest()->getParam('id');
            if($id){
                    $model = Mage::getModel('blark_sms/sms')->load($id);
                    $form->setValues($model->getData());  
            }
                      
            $this->setForm($form);
            
            parent::_prepareForm();
        }
}
