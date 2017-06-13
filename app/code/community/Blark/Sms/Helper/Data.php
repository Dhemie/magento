<?php
/**
 * Magento - Unicenta Opos Integrator by Asulpunto
 *
 * NOTICE OF LICENSE
 *  This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, Version 3 of the License. You can view
 *   the license here http://opensource.org/licenses/GPL-3.0

 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 * @category    Asulpunto
 * @package     Asulpunto_Unicentaopos
 * @copyright   Copyright (c) 2013 Asulpunto (http://www.asulpunto.com)
 * @license     http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 *
 */



class Blark_Sms_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getGatewayModel($code){
        $config = Mage::getConfig()->getNode('global/sms/gateway/'.$code)->asArray();
        return Mage::getModel($config['model']);
    }
    
    public function getActiveGatewayModel(){
        $code = $this->getActiveGatewayCode();
        
        return $this->getGatewayModel($code);
    }
    
    public function getActiveGatewayCode(){
        return Mage::getStoreConfig('system/sms/gateway');  
    }
}