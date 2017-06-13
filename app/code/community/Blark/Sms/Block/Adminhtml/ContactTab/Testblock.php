<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Blark_Sms_Block_Adminhtml_ContactTab_Testblock extends Mage_Core_Block_Template
{
    
    public function _construct()
    {
            $this->setTemplate('test.phtml');
    }
    
    
    
    public function getAllCat()
     {
        //on initialize la variable
        $data='';

        /* we made a request: pick up all the elements of the pfay_films table (thanks to our model pfay_films/film and sort by id_pfay_films */

       $collection = Mage::getModel('blark_sms/sms')
                            ->getCollection()
                            ->addFieldToSelect(["id","group_name"])
                            ->setOrder('id','asc');
   
       
         /* then browse the result of the request and with the getData() function is stored in the variable return (for display in the template) the necessary data */
        
       /* if($collection){
                foreach($collection as $data)
                {
                   $data .= $data->getData('group_name').'<br />';
                 }
            } */
         return $collection;
      }
      
      
      
}

 