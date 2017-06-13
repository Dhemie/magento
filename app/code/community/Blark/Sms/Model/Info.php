<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Core
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Email information model
 * Email message may contain addresses in any of these three fields:
 *  -To:  Primary recipients
 *  -Cc:  Carbon copy to secondary recipients and other interested parties
 *  -Bcc: Blind carbon copy to tertiary recipients who receive the message
 *        without anyone else (including the To, Cc, and Bcc recipients) seeing who the tertiary recipients are
 *
 * @category    Mage
 * @package     Mage_Core
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Blark_Sms_Model_Info extends Varien_Object
{
    /**
     * Name list of "To" recipients
     *
     * @var array
     */
    protected $_toNumberCountries = array();

    /**
     * Email list of "To" recipients
     *
     * @var array
     */
    protected $_toNumbers = array();

    /**
     * Add new "To" recipient to current email
     *
     * @param string $number
     * @param string|null $country
     * @return Mage_Core_Model_Email_Info
     */
    public function addTo($number, $country = null)
    {
        array_push($this->_toNumberCountries, $country);
        array_push($this->_toNumbers, $number);
        return $this;
    }

    /**
     * Get the name list of "To" recipients
     *
     * @return array
     */
    public function getToNumberCountries()
    {
        return $this->_toNumberCountries;
    }

    /**
     * Get the email list of "To" recipients
     *
     * @return array
     */
    public function getToNumbers()
    {
        return $this->_toNumbers;
    }
}
