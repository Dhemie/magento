<?php

class Blark_Sms_Block_Adminhtml_Contact_Contactgrid_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('contactGrid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(false);       
   } 
   

   protected function _prepareCollection()
   {
      $collection = Mage::getModel('blark_sms/sms')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }

   protected function _prepareColumns()
   {
       $this->addColumn('id',
             array(
                    'header' => 'ID',
                    'type'  => 'text',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id',
               ));
       
           $this->addColumn('group_name',
             array(
                    'header' => 'Group Name',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'group_name',
                    'type'  => 'text'
               ));

           $this->addColumn('number_count',
             array(
                    'header' => 'Entries',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'number_count',
                    'type'  => 'text'
               ));
           
           
          $this->addColumn('created_at',
             array(
                    'header' => 'Creation date',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'created_at',
                    'type'  => 'date'
               ));
          
         $this->addColumn('updated_at',
             array(
                    'header' => 'Last Updated',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'updated_at',
                    'type'  => 'date'
               ));

                  $this->addColumn('last_sent',
             array(
                    'header' => 'Last Sent',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'last_sent',
                    'type'  => 'date'
               )); 



         return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
         return $this->getUrl('*/contact/edit', array('id' => $row->getId()));
    }
    
}