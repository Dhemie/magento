<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Blark_Sms_Model_Resource_Sms extends Mage_Core_Model_Resource_Db_Abstract
{
     public function _construct()
     {
         $this->_init('blark_sms/sms', 'id');
     }
}